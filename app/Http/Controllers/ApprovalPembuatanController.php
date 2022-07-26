<?php

namespace App\Http\Controllers;

use App\Services\Support\ApprovalPembuatanService;
use App\Services\Support\ApprovalService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormPembuatanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\UserService;
use App\Services\Support\UserStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPembuatanController extends Controller
{
    public function index(){
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        if(Auth::user()->all_store == 'y'){
            $forms = formHeadService::getApprovePembuatanFilter($roleUsers->role_id)->get();
        }else{
            $forms = formHeadService::getApprovePembuatanFilterByStore($roleUsers->role_id, UserService::authStoreArray())->get();
        }


        return view('ApprovalPembuatan.index', compact('forms'));
    }

    public function create($id){
        $forms = FormHeadService::getById($id)->first();
        $apps = formPembuatanService::getByFormHeadId($forms->id)->get();

        return view('ApprovalPembuatan.create', compact('forms', 'apps'));
    }

    public function approve(Request $request){
        DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $apps = formPembuatanService::getByFormHeadId($request->form_head_id)->get();

        if (isset($_POST["approve"])){
            $nextApp = ApprovalService::getNextApp($roleUsers->role_id, Auth::user()->region_id);
            try{
                $data = [
                    'form_head_id' => $request->form_head_id,
                    'approved_by' => Auth::user()->id,
                    'approver_nik'=>Auth::user()->nik ,
                    'approver_name'=>Auth::user()->name,
                    'approver_role_id' =>  $roleUsers->role_id,
                    'approver_region_id'=> Auth::user()->region_id,
                    'status' => 'Approved'
                ];
                $storeApprove = approvalService::store($data);

                $roleNextApp = [
                    'role_last_app' => $roleUsers->role_id,
                    'role_next_app' => $nextApp,
                    'status'=> config('setting_app.status_approval.approve'),
                ];
                $updateStatus = FormHeadService::update($roleNextApp, $storeApprove->form_head_id);
                // $updateroleNextApp = formPembuatanService::update($roleNextApp, $storeApprove->form_pembuatan_id);

                $apps = formPembuatanService::getByFormHeadId($request->form_head_id)->get();
                foreach($apps as $app){
                    $appStatus = [
                        'status'=> config('setting_app.status_approval.approve'),
                    ];
                    $updateroleNextApp = formPembuatanService::update($appStatus, $app->id);
                }

                $storeUser = [
                    'store_id' => $request->store_id,
                ];
                $updateStoreUser = UserStoreService::update($storeUser, $request->user_id, $request->store_id);

                DB::commit();

                Alert::success('Approved', 'form has been approved');
                return redirect()->route('approval_pembuatan.index');
            }catch(\Throwable $th){
                DB::rollback();
                dd($th->getMessage());
                Alert::error('Error!!',);
                return redirect()->route('approval_pembuatan.index');
            }
        }elseif (isset($_POST["disapprove"])){
            try{
                $data = [
                    'form_pembuatan_id' => $request->form_pembuatan_id,
                    'approved_by' => Auth::user()->id,
                    'approver_nik'=>Auth::user()->nik ,
                    'approver_name'=>Auth::user()->name,
                    'approver_role_id' =>  $roleUsers->role_id,
                    'approver_region_id'=> Auth::user()->region_id,
                    'status' => 'Disapproved'
                ];
                $storeApprove = approvalService::store($data);

                $roleNextApp = [
                    'role_last_app' => $roleUsers->role_id,
                    'role_next_app' => 0,
                    'status'=> config('setting_app.status_approval.disapprove'),
                ];
                $updateStatus = FormHeadService::update($roleNextApp, $storeApprove->form_pembuatan_id);
                // $updateStatus = formPembuatanService::update($dataUpdate, $storeApprove->form_pembuatan_id);

                DB::commit();

                Alert::warning('Disapproved', 'form has been disapproved');
                return redirect()->route('approval_pembuatan.index');
            }catch (\Throwable $th) {
                DB::rollback();
                dd($th->getMessage());
                Alert::error('Error!!',);
                return redirect()->route('approval_pembuatan.index');
            }
        }
    }
}
