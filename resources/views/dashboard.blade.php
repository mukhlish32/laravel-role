@php ($nav = 'dashboard')   
@extends('layouts.app',[
'title1' => 'Dashboard',
'sidebar_toggle' => '', //sb-sidenav-toggled
])

@section('sidebar')
@include('layouts.sidebar')
@stop

@section('content')
<main>
    <div class="container-fluid px-4">
        {{-- <img class="logo" width="25%" alt=""
            src="{{ asset('images/logo2.png') }}"> --}}
        <h1 class="mt-4">Dashboard</h1>
    </div>
</main>
@stop

@section("libraries")
<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libraries/Chart.js/Chart.min.js') }}"></script>

{{-- <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/simple-datatables@latest.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script> --}}

@stop