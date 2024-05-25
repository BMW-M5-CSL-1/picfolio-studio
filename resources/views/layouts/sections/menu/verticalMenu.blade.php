@php
    $configData = Helper::appClasses();
@endphp

<style>
    .custom_side_icon {
        display: none;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if (!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{ route('dashboard') }}" class="app-brand-link">
                <span class="brand-logo">
                    <img class="img-fluid justicon" src="{{ asset('assets/img/branding/pic_logo.jpg') }}" width="50" />
                </span>
                {{-- <h5 class="brand-text mt-3 ms-2">{{ env('APP_NAME') }}</h5> --}}
                <img class="img-fluid custom_side_icon" src="{{ asset('assets/img/branding/pic_logo.jpg') }}"
                    width="25" />
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </div>
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps ps--active-y">
        @include('layouts.sections.menu.new-leftbar')

        {{-- <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : null }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Dashboards</div>
            </a>
        </li>

        @canany(['permissions.index'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Aminstration</span>
            </li>

            <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle ">
                    <i class="menu-icon tf-icons ti ti-file-dollar ti-layout-sidebar"></i>

                    <span class="menu-title text-truncate "
                        data-i18n="{{ __('lang.leftbar.roles_and_permissions') }}">{{ __('lang.leftbar.roles_and_permissions') }}</span>

                </a>

                <ul class="menu-sub">
                    @can('roles.index')
                        <li
                            class="menu-item {{ request()->routeIs('roles.index') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')
                                ? 'active open'
                                : null }}">
                            <a href="{{ route('roles.index') }}" class="menu-link">
                                <span class="menu-title text-truncate" data-i18n="Email">{{ __('lang.leftbar.roles') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('permissions.index')
                        <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active open' : null }}">
                            <a class="menu-link" href="{{ route('permissions.index') }}">

                                <span class="menu-title text-truncate"
                                    data-i18n="Email">{{ __('lang.leftbar.permissions') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany --}}

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 489px; right: 4px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 191px;"></div>
        </div>

    </ul>

</aside>
