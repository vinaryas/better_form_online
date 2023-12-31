<?php

namespace App\Http\Controllers;

use App\Services\Support\ApprovalPenghapusanService;
use App\Services\Support\ApprovalService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormPembuatanService;
use App\Services\Support\FormPenghapusanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPenghapusanController extends Controller
{
    public function index(){
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        if(Auth::user()->all_store == 'y'){
            $forms = formHeadService::getApprovePenghapusanFilter($roleUsers->role_id)->get();
        }else{
            $forms = formHeadService::getApprovePenghapusanFilterByStore($roleUsers->role_id, UserService::authStoreArray())->get();
        }

        return view('ApprovalPenghapusan.index', compact('forms'));
    }

    public function detail($id){
        $forms = FormPenghapusanService::getById($id)->first();

        return view('ApprovalPenghapusan.create', compact('forms'));
    }

    public function approve(Request $request){
    	DB::beginTransaction();
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();
        $nextApp = ApprovalService::getNextApp($roleUsers->role_id, Auth::user()->region_id);
        $owns = FormHeadService::getByUserIdActive($request->user_id)->get();

        if (isset($_POST["approve"]))
        {
            try{
                $data = [
                    'form_penghapusan_id' => $request->form_penghapusan_id,
                    'approved_by' => Auth::user()->id,
                    'approver_nik'=>Auth::user()->nik,
                    'approver_name'=>Auth::user()->name,
                    'approver_role_id' => $roleUsers->role_id,
                    'approver_region_id'=> Auth::user()->region_id,
                    'status' => 'Approved'
                ];
                $storeApprove = ApprovalPenghapusanService::store($data);

                $roleNextApp = [
                    'role_last_app' => $roleUsers->role_id,
                    'role_next_app' => $nextApp,
                    'status'=> config('setting_app.status_approval.approve'),
                ];
                $updateStatus = FormHeadService::update($roleNextApp, $storeApprove->form_penghapusan_id);

                foreach ($owns as $own){
                    $status = ['status'=>'0'];
                    $updateStatusId = FormPembuatanService::update($status, $own->id);
                }

                DB::commit();

                Alert::success('Approved', 'form has been approved');
                return redirect()->route('approval_penghapusan.index');
            } catch (\Throwable $th) {
                DB::rollback();

                dd($th->getMessage());
                Alert::error('Error!!',);
                return redirect()->route('approval_penghapusan.index');
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
                $storeApprove = ApprovalPenghapusanService::store($data);

                $roleNextApp = [
                    'role_last_app' => Auth::user()->role_id,
                    'role_next_app' => 0,
                    'status'=> config('setting_app.status_approval.disapprove'),
                ];
                $updateStatus = FormHeadService::update($roleNextApp, $storeApprove->form_penghapusan_id);

                DB::commit();

                Alert::warning('Disapproved', 'form has been disapproved');
                return redirect()->route('approval_penghapusan.index');
            }catch (\Throwable $th) {
                DB::rollback();

                dd($th->getMessage());
                Alert::error('Error!!',);
                return redirect()->route('approval_penghapusan.index');
            }
        }
    }
}
