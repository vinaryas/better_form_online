@extends('adminlte::page')

@section('title', 'Detail')

@section('content_header')
<h1 class="m-0 text-dark">Detail</h1>
@stop

@section('content')
<form class="card" action="{{ route('approval_penghapusan.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <input type="hidden" value="{{ $forms->created_by }}" name="user_id">
        <input type="hidden" value="{{ $forms->id }}" name="form_penghapusan_id">
        <div class="row">
            <div class="col-md-6">
                <label> NIK </label>
                <input type="text" value="{{ $forms->user->nik }}" name="nik" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label> Name </label>
                <input type="text" value="{{ $forms->user->name }}" name="name" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label> Store </label>
                <input type="text" value="{{ $forms->store->name }}" name="store" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label> Aplikasi </label>
                <select  name="aplikasi_id" class="form-control" readonly>
                    <option value="{{ $forms->aplikasi_id }}">{{ $forms->aplikasi->name }}</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="float-left">
                <button type="submit" class="btn btn-danger" name="disapprove" id="disapprove" value="disapprove">
                    <i class="fas fa-times"></i> DisApprove
                </button>
            </div>
            <div class="float-right">
                <button type="submit" class="btn btn-success" name="approve" id="approve" value="approve" >
                    <i class="fas fa-save"></i> Approve
                </button>
            </div>
        </div>
    </div>
</form>

@stop

