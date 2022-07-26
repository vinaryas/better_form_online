<?php

namespace App\Http\Controllers;

use App\Services\support\AplikasiService;
use App\Services\Support\ApprovalPenghapusanService;
use App\Services\Support\ApprovalService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormLogService;
use App\Services\Support\FormPenghapusanService;
use App\Services\Support\ReasonService;
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
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $userStores = UserStoreService::getUserStoreNotAuth(UserService::authStoreArray(), Auth::user()->id)->get();
        if($roleUsers->role_id == config('setting_app.role_id.admin')){
            $forms = FormPenghapusanService::all()->get();
        }else{
            $forms = FormPenghapusanService::getByUserId(Auth::user()->id)->get();
        }

        return view('formPenghapusan.index', compact('forms', 'userStores'));
    }

    public function create($id){
        $userStores = UserStoreService::getById($id)->first();
        $reasons = ReasonService::all()->get();
        $apps = AplikasiService::all()->get();

        return view('FormPenghapusan.create', compact('userStores', 'reasons', 'apps'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $nextApp = ApprovalService::getNextApp($roleUsers->role_id, Auth::user()->region_id);
        $userStores = UserStoreService::getStoreByUserId($request->user_id, UserService::authStoreArray())->get();

        try{
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
                    'type' => 'penghapusan',
                ];
                $storeForm = FormHeadService::store($form);
            }

            foreach ($request->aplikasi_id as $aplikasi_id){
                $userStores = UserStoreService::getStoreByUserId($request->user_id, UserService::authStoreArray())->get();

                foreach ($userStores as $userStore){
                    $dataApp = [
                        'aplikasi_id' => $aplikasi_id,
                        'form_head_id' => $storeForm->id,
                        'deleted_user' => $request->user_id,
                        'store_id' => $userStore->store_id,
                        'status' => config('setting_app.status_approval.panding'),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storeFormApp = formPenghapusanService::store($dataApp);

                    $logForm = [
                        'nik' => $request->nik,
                        'name' => $request->name,
                        'aplikasi_id' => $aplikasi_id,
                        'proses' => 'penghapusan',
                        'store_id' =>  $userStore->store_id,
                        'reason' => $request->reason,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storelog = FormLogService::store($logForm);
                }

                $index++;
            }

            $store = ['store_id' => '0'];
            $updateUserStore = UserStoreService::update($store, $request->user_id, $userStore->store_id);

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
