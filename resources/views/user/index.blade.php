@php ($nav = 'user')   
@extends('layouts.app',[
'title1' => 'User',
'sidebar_toggle' => '', //sb-sidenav-toggled
])

@section('sidebar')
@include('layouts.sidebar')
@stop

@section('content')
<main>
    <div class="container-fluid px-4">
        <ol class="breadcrumb form-control mt-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>

        @if ($alert = Session::get('msgbox'))
        <div class="alert {{ ($typebox = Session::get('typebox')) ? $typebox : '' }}">
            {{ $alert }}
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-table me-1"></i>
                Data User
            </div>
            <div class="card-body">
                <a href="{{ route('user.create') }}">
                    <button type="submit" name="btnTambah" class="button-3 px-3 py-1 btn-green">
                        <i class="fa fa-add"></i>
                        Tambah
                    </button>
                </a>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th class="center" >#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $data)
                        <tr>
                            <td style="width:2%;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $data->username }}
                            </td>
                            <td>
                                {{ $data->email }}
                            </td>
                            <td>
                                {{ $data->role }}
                            </td>
                            <td style="width:21%">
                                <div class="pt-1 ps-1 float-start">
                                    <a href="{{ route('user.edit', $data->id) }}">
                                        <button type="submit" name="btnEdit" class="button-3 px-3 py-1 btn-oldblue"
                                            style="width:90px;">
                                            <i class="fas fa-edit"></i>
                                            Ubah
                                        </button>
                                    </a>
                                </div>
                                <div class="pt-1 ps-1 float-start">
                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="btnHapus" class="button-3 px-3 py-1 btn-red" 
                                        onclick="return confirm('Apakah anda yakin ingin menghapus {{ $data->username }}?')"
                                        >
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>                                            
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@stop

@section("libraries")
<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/simple-datatables@latest.js') }}"></script>
<script src="{{ asset('js/sweetalert-2.1.2.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@stop