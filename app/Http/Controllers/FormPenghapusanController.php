<?php

namespace App\Http\Controllers;

use App\Services\support\AplikasiService;
use App\Services\Support\ApprovalPenghapusanService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormLogService;
use App\Services\Support\FormPenghapusanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\UserService;
use App\Services\Support\UserStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FormPenghapusanController extends Controller
{
    public function index(){
        $forms = FormPenghapusanService::getByUserId(Auth::user()->id)->get();
        $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();

        return view('formPenghapusan.index', compact('forms', 'userStores'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $apps = AplikasiService::all()->get();

        try{
            $index = 0;
            $form = [
                'created_by' =>  Auth::user()->id,
                'nik' => Auth::user()->username,
                'region_id'=>Auth::user()->region_id,
            ];
            $storeForm = FormHeadService::store($form);

            foreach ($apps as $app){

                $user_id_aplikasi = ($app == config('setting_app.aplikasi_id.vega')) ? $request->id_app[$index] : null;
                $pass = ($app == config('setting_app.aplikasi_id.vega') or $app == config('setting_app.aplikasi_id.rjserver')) ? $request->pass[$index] : null;
                $nextApp = ApprovalPenghapusanService::getNextApp($request->aplikasi_id[0], $roleUsers->role_id, $storeForm->region_id);
                $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();

                foreach ($userStores as $userStore){
                    $dataApp = [
                        'aplikasi_id' => $app->id,
                        'form_head_id' => $storeForm->id,
                        'user_id_aplikasi'=> $user_id_aplikasi,
                        'pass'=> $pass,
                        'store_id' => $userStore->store_id,
                        'role_last_app' => $roleUsers->role_id,
                        'role_next_app' => $nextApp,
                        'status' => config('setting_app.status_approval.panding'),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storeFormApp = formPenghapusanService::store($dataApp);

                    $logForm = [
                        'nik' => Auth::user()->nik,
                        'name' => Auth::user()->name,
                        'aplikasi_id' => $app->id,
                        'proses' => 'pembuatan',
                        'store_id' =>  $userStore->store_id,
                        'reason' => 'pembuatan baru',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storelog = FormLogService::store($logForm);
                }


                $index++;
            }

            $dataUser = ['store_id' => null,];
            $updateDataUser = userService::update($dataUser, $request->user_id);

            DB::commit();

            Alert::success('succes', 'form berhasil disimpan');
            return redirect()->route('form_penghapusan.index');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error!!',);
            return redirect()->route('form_penghapusan.index');
        }
    }
}
