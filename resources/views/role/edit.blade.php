@php ($nav = 'role')   
@extends('layouts.app',[
'title1' => 'Ubah Role',
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
            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>

        @if ($alert = Session::get('msgbox'))
        <div class="alert {{ ($typebox = Session::get('typebox')) ? $typebox : '' }}">
            {{ $alert }}
        </div>
        @endif
        
        <form method="POST" enctype="multipart/form-data" action="{{ route('role.update',$data->id) }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header fw-bold">
                            <i class="fas fa-table me-1"></i>
                            Ubah Data Role
                        </div>
                        <div class="card-body">
                            <div>
                                <label>Role</label>
                                <input name="txt_role" type="" placeholder="" value="{{ old('txt_role', $data->role) }}" 
                                class="form-control @error('txt_role') is-invalid @enderror">
                                @error('txt_role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label>Deskripsi</label>
                                <textarea name="txt_deskripsi" type="" placeholder=""
                                class="form-control  @error('txt_deskripsi') is-invalid @enderror" rows="7">{{ old('txt_deskripsi', $data->deskripsi) }}</textarea>
                                @error('txt_deskripsi')
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
                            Ubah Akses Role Pada Kategori Biaya
                        </div>
                        <div class="card-body">
                            @foreach ($fitur as $fitur)
                                <div class="row">
                                    <input type="hidden" name="chk_akses[{{ $fitur->fitur }}]" value="0"/>
                                    <div class="col-lg-6">
                                        <input class="form-check-input" type="checkbox" name="chk_akses[{{ $fitur->fitur }}]" value="{{ $fitur->fitur }}" class="cek-akses" 
                                        @foreach ($akses as $ak){{ $ak->akses === $fitur->fitur ? 'checked' : '' }}@endforeach>
                                        <b class="text-uppercase">{{ $fitur->fitur }}</b>

                                        <input type="hidden" name="chk_all[{{ $fitur->fitur }}]" value="0"/>
                                        <div class="float-end">
                                            <input class="form-check-input" type="checkbox" name="chk_all[{{ $fitur->fitur }}]" value="1"
                                            @foreach ($akses as $ak){{ $ak->akses === $fitur->fitur && $ak->semua == '1' ? 'checked' : '' }}@endforeach
                                            > Akses All
                                        </div>
                                    </div>
                                </div>
                            @endforeach                        
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