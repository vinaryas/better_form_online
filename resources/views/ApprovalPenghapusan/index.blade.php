@extends('adminlte::page')

@section('title', 'ID Management')

@section('content_header')
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <br>
        <table class="table table-bordered table-striped" id="table" style="width: 100%;">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> NIK </th>
                    <th> Created By </th>
                    <th> Store </th>
                    <th> Aplikasi </th>
                    <th> Approve </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->user->nik }}</td>
                        <td>{{ $form->user->name }}</td>
                        <td>{{ $form->store->name }}</td>
                        <td>{{ $form->aplikasi->name }}</td>
                        <td><a href="{{ route('approval_penghapusan.create', $form->id) }}"
                            class="btn btn-info btn-sm"> Detail <i class="fas fa-angle-right"></i>
                        </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            console.log('teast');
            $('#table').DataTable();
        });
    </script>
@stop
