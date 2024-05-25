@php
    $configData = Helper::appClasses();
    $isMenu = false;
    $navbarHideToggle = false;
    $isNavbar = false;
    $customizerHidden = true;
@endphp
@extends('layouts/layoutMaster')

@section('content')
    <div class="content-body">
        <!-- Error page-->
        <div class="misc-wrapper"><a class="brand-logo" href="{{ route('dashboard') }}">

                <h2 class="brand-text text-primary ms-1">{{ env('APP_NAME') }}</h2>
            </a>
            <div class="misc-inner p-2 p-sm-3">
                <div class="w-100 text-center">
                    {{-- <h1 class="mb-1">@yield('code') 😖</h1> --}}
                    <h2 class="mb-1 text-primary">@yield('message') 🕵🏻‍♀️</h2>
                    {{-- <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p> --}}
                    <a class="btn btn-primary mb-2 btn-sm-block" href="{{ route('dashboard') }}">Back to
                        Dashboard</a>
                        <br><img class="img-fluid" src="{{ asset('assets') }}/img/error/error.svg"
                        alt="Error page" />
                </div>
            </div>
        </div>
        <!-- / Error page-->
    </div>
@endsection
