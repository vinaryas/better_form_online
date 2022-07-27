<?php

namespace App\Http\Controllers;

use App\Services\support\AplikasiService;
use App\Services\Support\ApprovalPembuatanService;
use App\Services\Support\ApprovalPenghapusanService;
use App\Services\Support\ApprovalService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormLogService;
use App\Services\Support\FormPembuatanService;
use App\Services\Support\FormPemindahanService;
use App\Services\Support\FormPenghapusanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\StoreService;
use App\Services\Support\UserService;
use App\Services\Support\UserStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FormPemindahanController extends Controller
{
    public function index(){
        $owns = FormHeadService::getByUserIdActive(Auth::user()->id)->get();
        $forms = FormPemindahanService::getByUserId(Auth::user()->id)->get();
        $stores = StoreService::all()->get();
        $apps = AplikasiService::all()->get();

        return view('FormPemindahan.index', compact('forms', 'owns', 'stores', 'apps'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $owns = FormHeadService::getByUserIdActive(Auth::user()->id)->get();
        $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();
        $nextApp = ApprovalService::getNextApp($roleUsers->role_id, Auth::user()->region_id);

        try {
            $index = 0;
            $form = [
                'created_by'=>Auth::user()->id,
                'nik' =>Auth::user()->nik,
                'region_id'=>Auth::user()->region_id,
                'store_id' => $request->store_id,
                'role_last_app' => $roleUsers->role_id,
                'role_next_app' => $nextApp,
                'status' => config('setting_app.status_approval.panding'),
                'type' => 'pemindahan',
            ];
            $storeForm = FormHeadService::store($form);

            foreach($userStores as $userStore){
                $dataPemindahan = [
                    'form_head_id' => $storeForm->id,
                    'created_by'=>Auth::user()->id,
                    'nik' =>Auth::user()->nik,
                    'region_id'=>Auth::user()->region_id,
                    'from_store' => $userStore->store_id,
                    'to_store' => $request->store_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $storeDataPemindahan = FormPemindahanService::store($dataPemindahan);
            }

            foreach ($owns as $own){
                $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();

                foreach ($userStores as $userStore){
                    $data2 = [
                        'aplikasi_id' => $own->aplikasi_id,
                        'form_head_id' => $storeForm->id,
                        'store_id' => $own->store_id,
                        'deleted_user' => Auth::user()->id,
                        'status' => config('setting_app.status_approval.panding'),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storeData = FormPenghapusanService::store($data2);

                    $logForm2 = [
                        'nik' => Auth::user()->nik,
                        'name' => Auth::user()->name,
                        'aplikasi_id' => $own->aplikasi_id,
                        'proses' => 'penghapusan',
                        'store_id' =>  $userStore->store_id,
                        'reason' => 'pemindahan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storelog = FormLogService::store($logForm2);
                }

                $index++;
            }

            foreach ($owns as $own){

                $userStores = UserStoreService::getStoreByUserId(Auth::user()->id, UserService::authStoreArray())->get();

                foreach ($userStores as $userStore){
                    $data1 = [
                        'aplikasi_id' => $own->aplikasi_id,
                        'form_head_id' => $storeForm->id,
                        'user_id_aplikasi'=> $own->user_id_aplikasi,
                        'pass'=> $own->pass,
                        'store_id' => $request->store_id,
                        'status' => config('setting_app.status_approval.panding'),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storeData = FormPembuatanService::store($data1);

                    $logForm1 = [
                        'nik' => Auth::user()->nik,
                        'name' => Auth::user()->name,
                        'aplikasi_id' => $own->aplikasi_id,
                        'proses' => 'pembuatan',
                        'store_id' =>  $userStore->store_id,
                        'reason' => 'pemindahan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $storelog = FormLogService::store($logForm1);
                }
                $index++;

                $status = ['status' => 0];
                $updateStatus = FormPembuatanService::update($status, $own->id);
            }

            DB::commit();

            Alert::success('succes', 'form berhasil disimpan');
            return redirect()->route('form_pemindahan.index');
        }catch (\Throwable $th){
            dd($th);
            Alert::error('Error!!',);
            return redirect()->route('form_pemindahan.index');
        }
    }
}
