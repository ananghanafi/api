@extends('header')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3>Selamat datang di laman Kelola Peran dan Hak akses</h3>        
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-xs-6 text-right">
                        <a type="button" class="btn btn-sm btn-primary btn-create" href="">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-hover table-outline mb-0">
                <!-- <table class="table table-striped table-bordered table-list"> -->
                    <thead class="thead-default">
                    <tr>
                        <th class="hidden-xs">ID</th>
                        <th>Nama</th>
                        <th>Display</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                        <th>Hak Akses</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td class="hidden-xs">{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->display_name }}</td>
                            <td>{{ $group->description }}</td>
                            <td>
                                <a href="{{ route('rolepermission.addperan', ['id' => $group->id])}}" class="btn btn-primary"><em class="fa fa-pencil"></em></a>                            
                                <a disabled="" class="btn btn-danger"><em class="fa fa-trash"></em></a>                                
                            </td>                            
                            <td>
                                <a href="{{ route('rolepermission.editperan', ['id_group' => $group->id])}}" class="btn btn-warning"><em class="fa fa-pencil"></em></a>                            
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col col-xs-6">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

