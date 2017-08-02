@extends('layouts.app')

@section('content')

@if(Auth::user()->hasRole(PMW\User::SUPER_ADMIN))

    {{ PMW\User::SUPER_ADMIN }}

@endif

@if(Auth::user()->hasRole(PMW\User::ADMIN_UNIVERSITAS))

    {{ PMW\User::ADMIN_UNIVERSITAS }}

    @include('admin.univ.dashboard')

@endif

@if(Auth::user()->hasRole(PMW\User::ADMIN_FAKULTAS))

    {{ PMW\User::ADMIN_FAKULTAS }}

@endif

@if(Auth::user()->hasRole(PMW\User::REVIEWER))

    {{ PMW\User::REVIEWER }}

@endif

@if(Auth::user()->hasRole(PMW\User::DOSEN_PEMBIMBING))

    {{ PMW\User::DOSEN_PEMBIMBING }}

@endif

@if(Auth::user()->hasRole(PMW\User::KETUA_TIM))

    {{ PMW\User::KETUA_TIM }}

@endif

@if(Auth::user()->hasRole(PMW\User::ANGGOTA))

    {{ PMW\User::ANGGOTA }}

@endif

@endsection