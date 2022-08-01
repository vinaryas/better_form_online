@extends('adminlte::page')

@section('title', 'ID Management')

@section('content_header')
@stop

@section('content')
<form class="card" action="{{ route('approval_pembuatan.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <input type="hidden" value="{{ $forms->created_by }}" name="user_id">
        <input type="hidden" value="{{ $forms->id }}" name="form_head_id">
        <input type="hidden" value="{{ $forms->role_last_app }}" name="role_last_app">
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
                <select  name="store_id" class="form-control" readonly>
                    <option value="{{ $forms->store_id }}">{{ $forms->store->name }}</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th> Aplikasi </th>
                        <th> ID </th>
                        <th> Password </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apps as $app)
                        <tr>
                            <td>{{ $app->aplikasi->name }}</td>
                            <td>{{ $app->user_id_aplikasi }}</td>
                            <td>{{ $app->pass }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

@section('js')
    <script>
        $(document).ready(function () {
            console.log('teast');
            $('#table').DataTable();
        });
    </script>
@stop

