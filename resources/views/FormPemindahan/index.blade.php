@extends('adminlte::page')

@section('title', 'ID Management')

@section('content_header')
@stop

@section('content')
<form class="card" action="{{ route('form_pemindahan.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-12">
                <label>Store</label>
                <select name="store_id" id="store_id" class="select2 form-control" required>
                    @foreach ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @foreach ( $apps as $app)
                <input type="hidden" value="{{ $app->id }}" name="aplikasi_id[]">
                @endforeach
            </div>
        </div>
        <div class="float-left">
            <a href="{{ route('form_pemindahan.index') }}" class="btn btn-danger"><i class="fas fa-times"></i> Batal </a>
        </div>
        <div class="float-right">
            <button type="submit" class="btn btn-success" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="table" style="width: 100%;">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Aplikasi </th>
                    <th> ID </th>
                    <th> Password </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($owns as $own)
                    <tr>
                        <td>{{ $own->id }}</td>
                        <td>{{ $own->aplikasi->name }}</td>
                        <td>{{ $own->user_id_aplikasi }}</td>
                        <td>{{ $own->pass }}</td>
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
                    <th> From Store </th>
                    <th> To Store </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->user->name }}</td>
                        <td>{{ $form->store1->name }}</td>
                        <td>{{ $form->store2->name }}</td>
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
