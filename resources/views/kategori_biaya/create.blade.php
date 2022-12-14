@php ($nav = 'kategori-biaya')   
@extends('layouts.app',[
'title1' => 'Tambah Kategori Biaya',
'sidebar_toggle' => '', //sb-sidenav-toggled
])

@section('sidebar')
@include('layouts.sidebar')
@stop

@section('content')
<main>
    <div class="container-fluid px-4">
        <ol class="breadcrumb form-control mt-4">
            @if (Session::get('akses_id') == '1')
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ route('kategori-biaya.index') }}">Kategori Biaya</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>

        @if ($alert = Session::get('msgbox'))
        <div class="alert {{ ($typebox = Session::get('typebox')) ? $typebox : '' }}">
            {{ $alert }}
        </div>
        @endif
        
        <div class="card mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-table me-1"></i>
                Tambah Kategori Biaya
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('kategori-biaya.store') }}">
                @csrf
                <div class="card-body pb-5">
                    <div>
                        <label>Nama Kategori Biaya</label>
                        <input name="txt_nama_kategori_biaya" type="" placeholder="" value="{{ old('txt_nama_kategori_biaya') }}" 
                        class="form-control @error('txt_nama_kategori_biaya') is-invalid @enderror">
                        @error('txt_nama_kategori_biaya')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>Deskripsi</label>
                        <textarea name="txt_deskripsi" type="" placeholder=""
                        class="form-control  @error('txt_deskripsi') is-invalid @enderror" rows="7">{{ old('txt_deskripsi', '') }}</textarea>
                        @error('txt_deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer pt-2" style="text-align: right">
                    <button type="submit" name="btnAction" value ="1" class="button-3 py-1 btn-green">Simpan</button>
                    <button type="submit" name="btnAction" value ="2" class="button-3 py-1">Batal</button>
                </div>
            </form>
        </div>
    </div>
</main>
@stop

@section("libraries")
<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/simple-datatables@latest.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@stop