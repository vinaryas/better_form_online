@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-lg-12 col-6">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3> {{ $countApproval }} </h3>
                    <p> <b> Aplikasi </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-6">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3> {{ $countForm }} </h3>
                    <p> <b> Form </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner text-center">
                    <h3> {{ $countApproved }} </h3>
                    <p> <b> Approved </b> </p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature" style="color: rgba(255, 255, 255, 0.5);"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-danger">
                <div class="inner text-center">
                    <h3> {{ $countDisapproved }} </h3>
                    <p> <b> Disapproved </b> </p>
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
