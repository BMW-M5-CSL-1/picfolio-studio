@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
<h4 class="fw-bold py-3 mb-4 "><span
    class="text-muted fw-light">
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'permissions.edit') }}</span></h4>
@endsection

@section('title', 'Edit Role')

@section('page-vendor')
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css"> --}}
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('page-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 ">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                {{-- <h2 class="content-header-title float-start mb-0">Edit Role</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('permissions.edit') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('permissions.update', ['id' => $permission->id]) }}" method="POST">

            <div class="card-header">
            </div>

            <div class="card-body">

                @csrf
                @method('PUT')

                {{ view('app.permissions.form-fields', ['permission' => $permission]) }}

            </div>

            <div class="card-footer d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-outline-success waves-effect waves-float waves-light buttonToBlockUI me-1">
                    <i data-feather='save'></i>
                    Update Permission
                </button>
                <a href="{{ route('permissions.index') }}"
                    class="btn btn-outline-danger waves-effect waves-float waves-light">
                    <i data-feather='x'></i>
                    {{ __('lang.commons.cancel') }}
                </a>
            </div>

        </form>
    </div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
@endsection
