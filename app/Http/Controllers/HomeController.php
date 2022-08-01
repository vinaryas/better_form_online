<?php

namespace App\Http\Controllers;

use App\Services\Support\ApprovalPembuatanService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormPembuatanService;
use App\Services\Support\RoleUserService;
use App\Services\Support\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roleUsers = RoleUserService::getRoleFromUserId(Auth::user()->id)->first();

        $countApproval = 0;
        $countForm = 0;
        $countActive = 0;
        $countInactive = 0;
        $thisMonth = Carbon::now()->month;

        $countApprovalPembuatan = FormHeadService::getApprovePembuatanFilterByStore($roleUsers->role_id, UserService::authStoreArray(), $thisMonth)->get()->count();
        $countApprovalPenghapusan = FormHeadService::getApprovePenghapusanFilterByStore($roleUsers->role_id, UserService::authStoreArray(), $thisMonth)->get()->count();
        $countForm = FormHeadService::countForm(Auth::user()->id, $thisMonth)->get()->count();
        $countActive = FormHeadService::getByUserIdActive(Auth::user()->id, $thisMonth)->get()->count();
        $countInactive = FormHeadService::getByUserIdInctive(Auth::user()->id, $thisMonth)->get()->count();

        return view('home', compact('countApprovalPembuatan', 'countApprovalPenghapusan', 'countForm', 'countActive', 'countInactive', 'roleUsers'));
    }
}
