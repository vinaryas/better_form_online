@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<form class="card" action="{{ route('form_penghapusan.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th> Nama </th>
                        <th >NIK</th>
                        <th> Store </th>
                        <th> Ajukan Penghapusan </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userStores as $userStore)
                        <tr>
                            <td>{{ $userStore->user->name }}</td>
                            <td>{{ $userStore->user->nik }}</td>
                            <td>{{ $userStore->stores->name }}</td>
                            <td> <a href="{{ route('form_penghapusan.create', $userStore->id) }}" class="btn btn-info">
                                <i class="fas fa-file"></i> Buat Form </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="table" style="width: 100%;">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Name </th>
                    <th> Store </th>
                    <th> Aplikasi </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->created_by }}</td>
                        <td>{{ $form->store_id }}</td>
                        <td>{{ $form->aplikasi_id }}</td>
                        <td>{{ $form->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    {{-- <script>
        $(document).ready(function(){
            $('.js-select2').select2();
        });
    </script> --}}
@stop
