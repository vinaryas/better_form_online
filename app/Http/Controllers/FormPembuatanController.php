<?php

namespace App\Http\Controllers;

use App\Services\Support\AplikasiService;
use App\Services\Support\ApprovalPembuatanService;
use App\Services\Support\ApprovalService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormLogService;
use App\Services\Support\FormPembuatanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\UserService;
use App\Services\Support\UserStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FormPembuatanController extends Controller
{
    public function index(){
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $apps = AplikasiService::all()->get();
        if($roleUsers->role_id == config('setting_app.role_id.admin')){
            $forms = FormPembuatanService::all()->get();
        }else{
            $forms = FormPembuatanService::getByUserId(Auth::user()->id)->get();
        }

        return view('FormPembuatan.index', compact('forms', 'apps'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $nextApp = ApprovalService::getNextApp($roleUsers->role_id, Auth::user()->region_id);
        $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();

        try {
            $index = 0;
            foreach ($userStores as $userStore){
                $form = [
                    'created_by'=>Auth::user()->id,
                    'nik' =>Auth::user()->nik,
                    'region_id'=>Auth::user()->region_id,
                    'store_id' => $userStore->store_id,
                    'role_last_app' => $roleUsers->role_id,
                    'role_next_app' => $nextApp,
                    'status' => config('setting_app.status_approval.panding'),
                    'type' => 'pembuatan',
                ];
                $storeForm = FormHeadService::store($form);
            }

            foreach ($request->aplikasi_id as $aplikasi_id){
                $user_id_aplikasi = ($aplikasi_id == config('setting_app.aplikasi_id.vega')) ? $request->id_app[$index] : null;
                $pass = ($aplikasi_id == config('setting_app.aplikasi_id.vega') or $aplikasi_id == config('setting_app.aplikasi_id.rjserver')) ? $request->pass[$index] : null;

                foreach ($userStores as $userStore){
                    $dataApp = [
                        'aplikasi_id' => $aplikasi_id,
                        'form_head_id' => $storeForm->id,
                        'user_id_aplikasi'=> $user_id_aplikasi,
                        'pass'=> $pass,
                        'store_id' => $userStore->store_id,
                        'status' => config('setting_app.status_approval.panding'),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storeFormApp = formPembuatanService::store($dataApp);

                    $logForm = [
                        'nik' => Auth::user()->nik,
                        'name' => Auth::user()->name,
                        'aplikasi_id' => $aplikasi_id,
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

            DB::commit();

            Alert::success('succes', 'form berhasil disimpan');
            return redirect()->route('form_pembuatan.index');
        }catch (\Throwable $th){
            dd($th);
            Alert::error('Error!!',);
            return redirect()->route('form_pembuatan.index');
        }
    }
}
