@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
<h4 class="fw-bold py-3 mb-4 "><span
    class="text-muted fw-light">
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'roles.create') }}</span></h4>
@endsection

@section('title', 'Create Role')

@section('page-vendor')

@endsection

@section('page-css')
@endsection

@section('page-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                {{-- <h2 class="content-header-title float-start mb-0">Create Role</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('roles.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('roles.store') }}" method="post">

            <div class="card-header">
            </div>

            <div class="card-body">

                @csrf

                {{ view('app.roles.form-fields') }}

            </div>

            <div class="card-footer d-flex align-items-center justify-content-end">
                @can('roles.store')
                    <button type="submit"
                        class="btn btn-outline-success waves-effect waves-float waves-light buttonToBlockUI me-2">
                        <i data-feather='save'></i>
                        Submit
                    </button>
                @endcan

                <a href="{{ route('roles.index') }}" class="btn btn-outline-danger waves-effect waves-float waves-light">
                    <i data-feather='x'></i>
                    Cancel
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
    <script>
        $(document).ready(function() {
            var t = $("#roles");
            t.wrap('<div class="position-relative"></div>');
            t.select2({})
        });
    </script>

@endsection

<!-- Include Select2 -->
