@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="card-body">
    @if ($roleUsers->role_id == config('setting_app.role_id.aux'))
    <div class="row">
        <div class="col-lg-12 col-6">
            <a href="{{ route('approval_pembuatan.index') }}">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3> {{ $countApprovalPembuatan }} </h3>
                    <p> <b> Approval Pembuatan </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-6">
            <a href="{{ route('approval_penghapusan.index') }}">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3> {{ $countApprovalPenghapusan }} </h3>
                    <p> <b> Approval Penghapusan </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
            </a>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12 col-6">
            <a href="{{ route('form_pembuatan.index') }}">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3> {{ $countForm }} </h3>
                    <p> <b> Form </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner text-center">
                    <h3> {{ $countActive }} </h3>
                    <p> <b> Active </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-danger">
                <div class="inner text-center">
                    <h3> {{ $countInactive }} </h3>
                    <p> <b> Inactive </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-contract" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop
