<?php

namespace App\Http\Controllers;

use App\Services\Support\ApprovalPembuatanService;
use App\Services\Support\FormHeadService;
use App\Services\Support\FormPembuatanService;
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
        $countApproval = 0;
        $countForm = 0;
        $countApproved = 0;
        $countDisapproved = 0;
        $thisMonth = Carbon::now()->month;

        $countApproval = FormPembuatanService::countForm(Auth::user()->id, $thisMonth)->get()->count();
        $countForm = FormHeadService::countForm(Auth::user()->id, $thisMonth)->get()->count();
        $countApprovedPembuatan = ApprovalPembuatanService::countApproved(Auth::user()->id, $thisMonth)->get()->count();
        $countDisapprovedPembuatan = ApprovalPembuatanService::countDisapproved(Auth::user()->id, $thisMonth)->get()->count();
        $countApprovedPenghapusan = ApprovalPembuatanService::countApproved(Auth::user()->id, $thisMonth)->get()->count();
        $countDisapprovedPenghapusan = ApprovalPembuatanService::countDisapproved(Auth::user()->id, $thisMonth)->get()->count();

        $countApproved =  $countApprovedPembuatan + $countApprovedPenghapusan;
        $countDisapproved = $countDisapprovedPembuatan + $countDisapprovedPenghapusan;

        return view('home', compact('countApproval', 'countForm', 'countApproved', 'countDisapproved'));
    }
}
