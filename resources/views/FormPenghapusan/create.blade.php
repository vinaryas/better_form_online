@extends('adminlte::page')

@section('title', 'ID Management')

@section('content_header')
@stop

@section('content')
<form class="card" action="{{ route('form_penghapusan.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <div class="form-group row">
            <input type="hidden" name="user_id" id="user_id" value="{{ $userStores->user_id }}">
            <div class="col-md-6">
                <label>Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $userStores->user->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label>NIK</label>
                <input type="text" id="nik" name="nik" class="form-control" value="{{ $userStores->user->nik }}" readonly>
            </div>
            <div class="col-md-6">
                <label>Store</label>
                <select name="store_id" id="store_id" class="form-control" readonly>
                    <option value="{{ $userStores->store_id }}">{{ $userStores->stores->name }}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Reason</label>
                <select name="reason" id="reason" class="select2 form-control" required>
                    <option > </option>
                    @foreach ($reasons as $reason)
                    <option value="{{ $reason->name }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @foreach ( $apps as $app)
                <input type="hidden" value="{{ $app->id }}" name="aplikasi_id[]">
                @endforeach
            </div>
        </div>
    </div>
    <div  class="card-body">
        <div class="float-left">
            <a href="{{ route('form_penghapusan.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Batal </a>
        </div>
        <div class="float-right">
            <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';">
                <i class="fas fa-save"></i> Ajukan Penghapusan
            </button>
        </div>
    </div>
</form>

@stop
