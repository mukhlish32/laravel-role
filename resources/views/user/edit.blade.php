@php ($nav = 'user')   
@extends('layouts.app',[
'title1' => 'Ubah User',
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
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>

        @if ($alert = Session::get('msgbox'))
        <div class="alert {{ ($typebox = Session::get('typebox')) ? $typebox : '' }}">
            {{ $alert }}
        </div>
        @endif
        
        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update',$data->id) }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header fw-bold">
                            <i class="fas fa-table me-1"></i>
                            Ubah Data User
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="username">Username</label>
                                <input value="{{ old('txt_username',$data->username ?? '')}}" name="txt_username"
                                    type="" class="form-control @error('txt_username') is-invalid @enderror">
                                @error('txt_username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input value="{{ old('txt_email',$data->email ?? '') }}" name="txt_email" type=""
                                class="form-control @error('txt_email') is-invalid @enderror">
                                @error('txt_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label>Role</label>
                                <select required="" name="cmb_role" value="{{ old('cmb_role') }}"
                                class="form-control  @error('cmb_role') is-invalid @enderror">
                                    <option selected="" disabled="">- Pilih Role -</option>
                                    @foreach($role as $role)
                                        <option value="{{ $role->id }}"
                                        {{ old('cmb_role', $data->role_id ?? '') == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                @error('cmb_role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer pt-2" style="text-align: right">
                            <button type="submit" name="btnAction" value="1"
                                class="button-3 py-1 btn-green">Simpan</button>
                            <button type="submit" name="btnAction" value="0" class="button-3 py-1">Batal</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header fw-bold">
                            <i class="fas fa-table me-1"></i>
                            Ubah Password
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="password1">Password</label>
                                <input value="{{ old('txt_password1' ?? '') }}" name="txt_password1" type="password" placeholder="Masukkan password" class="form-control @error('txt_password1') is-invalid @enderror">
                                @error('txt_password1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password2">Password Konfirmasi</label>
                                <input value="{{ old('txt_password2' ?? '') }}" name="txt_password2" type="password" placeholder="Masukkan password konfirmasi" class="form-control @error('txt_password2') is-invalid @enderror">
                                @error('txt_password2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer pt-2" style="text-align: right">
                            <button type="submit" name="btnAction" value="2"
                                class="button-3 py-1 btn-green">Simpan</button>
                            <button type="submit" name="btnAction" value="0" class="button-3 py-1">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@stop

@section("libraries")
<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/simple-datatables@latest.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@stop