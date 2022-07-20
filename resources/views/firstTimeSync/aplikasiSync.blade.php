@extends('adminlte::page')

@section('title', 'ID Management')

@section('content_header')
<h1 class="m-0 text-dark">Aplikasi Sync</h1>
@stop

@section('content')
<div class="card" >
    <form action="{{ route('aplikasiSync.sync') }}" method="POST">
        {{ csrf_field() }}
            <button type="submit" class="btn btn-success col-md-12">
                <i class="fas fa-save"></i> synchronize
            </button>
    </form>
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
