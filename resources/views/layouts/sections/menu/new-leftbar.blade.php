<li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : null }}">
    <a class="menu-link" href="{{ route('dashboard') }}">
        {{-- <i class="menu-icon tf-icons ti ti-smart-home"></i> --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-layout-dashboard"
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 4h6v8h-6z"></path>
            <path d="M4 16h6v4h-6z"></path>
            <path d="M14 12h6v8h-6z"></path>
            <path d="M14 4h6v4h-6z"></path>
        </svg>

        <span class="menu-title text-truncate">Dashboard
        </span>
    </a>
</li>

@if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
    <li class="menu-header">
        <span class="menu-header-text">Administration</span>

    </li>

    @if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
        <li
            class="menu-item {{ request()->routeIs('roles.index') ||
            request()->routeIs('roles.create') ||
            request()->routeIs('permissions.index')
                ? 'active open'
                : null }}">
            <a class="menu-link menu-toggle " href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-shield-lock"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3">
                    </path>
                    <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                    <path d="M12 12l0 2.5"></path>
                </svg>
                <span class="menu-title text-truncate">Roles & Permissions
                </span>
            </a>
            <ul class="menu-sub">
                @can('roles.index')
                    <li
                        class="menu-item {{ request()->routeIs('roles.index') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')
                            ? 'active'
                            : null }}">
                        <a class="menu-link" href="{{ route('roles.index') }}">
                            <span class="menu-title text-truncate">Roles
                            </span>
                        </a>
                    </li>
                @endcan

                @can('permissions.index')
                    <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
                        <a class="menu-link" href="{{ route('permissions.index') }}">
                            <span class="menu-title text-truncate">Permissions
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif
@endif

@can('stakeholders.index')
    <li class="menu-item {{ request()->routeIs('stakeholders.index') ? 'active open' : null }}">
        <a class="menu-link menu-toggle " href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-users-group"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
            </svg>
            <span class="menu-title text-truncate">User Management
            </span>
        </a>
        <ul class="menu-sub">
            @can('stakeholders.index')
                <li class="menu-item  {{ request()->routeIs('stakeholders.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('stakeholders.index') }}">
                        <span class="menu-title text-truncate">List</span>
                    </a>
                </li>
            @endcan

            {{-- @can('stakeholders.index') --}}
            <!--  <li class="menu-item ">
                                                                                                                                    <a class="menu-link menu-toggle" href="javascript:void(0)">
                                                                                                                                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                                                            aria-hidden="true" role="img" tag="i"
                                                                                                                                            class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em"
                                                                                                                                            height="1em" viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
                                                                                                                                            <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor"
                                                                                                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                                                                                                        </svg>
                                                                                                                                        <span class="menu-title text-truncate">View</span>
                                                                                                                                    </a>
                                                                                                                                    <ul class="menu-sub">
                                                                                                                                        {{-- @can('sites.file-managements.customers') --}}
                                                                                                                                        <li class="menu-item ">
                                                                                                                                            <a class="menu-link" href="#">
                                                                                                                                                <span class="menu-title text-truncate">Account
                                                                                                                                                </span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                        {{-- @endcan --}}

                                                                                                                                        {{-- @can('sites.file-managements.view-files') --}}
                                                                                                                                        <li class="menu-item ">
                                                                                                                                            <a class="menu-link" href="#">
                                                                                                                                                <span class="menu-title text-truncate">Security
                                                                                                                                                </span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                        {{-- @endcan --}}

                                                                                                                                        {{-- @can('sites.file-managements.view-files') --}}
                                                                                                                                        <li class="menu-item ">
                                                                                                                                            <a class="menu-link" href="#">
                                                                                                                                                <span class="menu-title text-truncate">Billing & Plans
                                                                                                                                                </span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                        {{-- @endcan --}}

                                                                                                                                        {{-- @can('sites.file-managements.view-files') --}}
                                                                                                                                        <li class="menu-item ">
                                                                                                                                            <a class="menu-link" href="#">
                                                                                                                                                <span class="menu-title text-truncate">Notifications
                                                                                                                                                </span>
                                                                                                                                            </a>
                                                                                                                                        </li>
                                                                                                                                        {{-- @endcan --}}
                                                                                                                                    </ul>
                                                                                                                                </li> -->
            {{-- @endcan --}}
        </ul>
    </li>
@endcan

@can('reports.index')
    <li class="menu-item {{ request()->routeIs('reports.index') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('reports.index') }}">
            {{-- <i class="menu-icon tf-icons ti ti-smart-home"></i> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-checkup-list"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                <path d="M9 14h.01" />
                <path d="M9 17h.01" />
                <path d="M12 16l1 1l3 -3" />
            </svg>
            <span class="menu-title text-truncate">Reports
            </span>
        </a>
    </li>
@endcan
{{-- @endcanany --}}


{{-- @if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
    <li class="menu-header">
      <span class="menu-header-text">Payments</span>
    </li>
@endif

@canany([])
<li class="menu-item ">
    <a class="menu-link menu-toggle " href="javascript:void(0)">
        <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-file-dollar"
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
            <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
            <path d="M12 17v1m0 -8v1"></path>
        </svg>
        <span class="menu-title text-truncate">Invoices
        </span>
    </a>
    <ul class="menu-sub">
        @can('roles.index')
            <li class="menu-item ">
                <a class="menu-link" href="#">
                    <span class="menu-title text-truncate">List</span>
                </a>
            </li>
        @endcan

        @can('permissions.index')
            <li class="menu-item ">
                <a class="menu-link" href="#">
                    <span class="menu-title text-truncate">View</span>
                </a>
            </li>
        @endcan
        @can('roles.index')
            <li class="menu-item ">
                <a class="menu-link" href="#">
                    <span class="menu-title text-truncate">Add</span>
                </a>
            </li>
        @endcan

        @can('permissions.index')
            <li class="menu-item ">
                <a class="menu-link" href="#">
                    <span class="menu-title text-truncate">Edit</span>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany --}}

{{-- @canany(['sites.settings.communication-channels.index']) --}}
{{-- <li class="menu-header">
    <span data-i18n="Others">Communication Channels</span>
</li> --}}
{{-- @endcanany --}}

{{-- @can('roles.index') --}}
{{-- <li class="menu-item ">
    <a class="menu-link" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-mail" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
            <path d="M3 7l9 6l9 -6"></path>
        </svg>
        <span class="menu-title text-truncate">Email
        </span>
    </a>
</li> --}}
{{-- @endcan --}}

{{-- @can('roles.index') --}}
{{-- <li class="menu-item ">
    <a class="menu-link" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-messages"
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10"></path>
            <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
        </svg>
        <span class="menu-title text-truncate">Chat
        </span>
    </a>
</li> --}}
{{-- @endcan --}}

@canany(['location.index', 'route.index', 'paper-type.index', 'paper-quality.index', 'design.index', 'orders.index',
    'orders.create', 'orders.show', 'printing-press.index', 'distributor.index', 'vehicle-media.index'])
    <li class="menu-header">
        <span data-i18n="Marketing">Marketing</span>
    </li>
@endcanany

@canany(['location.index', 'route.index'])
    <li
        class="menu-item {{ request()->routeIs('location.index') || request()->routeIs('route.index') ? 'active open' : null }}">
        <a class="menu-link menu-toggle" href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-map-pin" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
            </svg>
            <span class="menu-title text-truncate">Location
            </span>
        </a>
        <ul class="menu-sub">
            @can('location.index')
                <li class="menu-item {{ request()->routeIs('location.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('location.index') }}">Location</a>
                </li>
            @endcan
            @can('route.index')
                <li class="menu-item {{ request()->routeIs('route.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('route.index') }}">Route</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@canany(['paper-type.index', 'paper-quality.index'])
    <li
        class="menu-item  {{ request()->routeIs('paper-type.index') || request()->routeIs('paper-quality.index') ? 'active open' : null }}">
        <a class="menu-link menu-toggle " href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-file-description"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <path d="M9 17h6"></path>
                <path d="M9 13h6"></path>
            </svg>
            <span class="menu-title text-truncate">Paper
            </span>
        </a>
        <ul class="menu-sub">
            @can('paper-quality.index')
                <li class="menu-item {{ request()->routeIs('paper-quality.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('paper-quality.index') }}">Paper Quality</a>
                </li>
            @endcan
            @can('paper-type.index')
                <li class="menu-item {{ request()->routeIs('paper-type.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('paper-type.index') }}">Paper Types</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@can('design.index')
    <li class="menu-item {{ request()->routeIs('design.index') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('design.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-article" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                <path d="M7 8h10"></path>
                <path d="M7 12h10"></path>
                <path d="M7 16h10"></path>
            </svg>
            <span class="menu-title text-truncate">Design
            </span>
        </a>
    </li>
@endcanany

@canany(['orders.index', 'orders.create', 'orders.show', 'orders.edit'])
    <li
        class="menu-item {{ request()->routeIs('orders.index') ||
        request()->routeIs('orders.create') ||
        request()->routeIs('orders.show') ||
        request()->routeIs('orders.edit')
            ? 'active'
            : null }}">
        <a class="menu-link" href="{{ route('orders.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-shopping-cart"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M17 17h-11v-14h-2"></path>
                <path d="M6 5l14 1l-1 7h-13"></path>
            </svg>
            <span class="menu-title text-truncate">Orders
            </span>
        </a>
    </li>
@endcanany

{{-- Printing --}}
@can('printing-press.index')
    <li class="menu-item {{ request()->routeIs('printing-press.*') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('printing-press.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-printer" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
            </svg>
            <span class="menu-title text-truncate">Printing Press</span>
        </a>
    </li>
@endcan

{{-- Distribution --}}
@can('distributor.index')
    <li class="menu-item {{ request()->routeIs('distributor.index') ? 'active' : '' }}">
        <a class="menu-link" href="{{ route('distributor.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-affiliate"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275"></path>
                <path d="M11.683 12.317l5.759 -5.759"></path>
                <path d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                <path d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                <path d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                <path d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0"></path>
            </svg>
            <span class="menu-title text-truncate">Distribution</span>
        </a>
    </li>
@endcan

{{-- Vehicle Media  --}}
@can('vehicle-media.index')
    <li class="menu-item {{ request()->routeIs('vehicle-media.index') ? 'active' : '' }}">
        <a class="menu-link" href="{{ route('vehicle-media.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-car" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
            </svg>
            <span class="menu-title text-truncate">Vehicle Media</span>
        </a>
    </li>
@endcan

{{-- Trash --}}
@canany(['orders.trash'])
    <li class="menu-item {{ request()->routeIs('orders.trash') ? 'active open' : null }}">
        <a class="menu-link menu-toggle " href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-trash" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 7l16 0" />
                <path d="M10 11l0 6" />
                <path d="M14 11l0 6" />
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
            <span class="menu-title text-truncate">Trash
            </span>
        </a>
        <ul class="menu-sub">
            @can('orders.trash')
                <li class="menu-item {{ request()->routeIs('orders.trash') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('orders.trash') }}">
                        <span class="menu-title text-truncate">Orders
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

{{-- Pages --}}
{{-- Chat --}}
@canany(['chat.index', 'profile.index'])
    <li class="menu-header">
        <span class="menu-header-text">Pages</span>
    </li>
@endcanany

@can('chat.index')
    <li class="menu-item {{ request()->routeIs('chat.index') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('chat.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-message" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 9h8" />
                <path d="M8 13h6" />
                <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
            </svg>
            <span class="menu-title text-truncate">Chat
            </span>
        </a>
    </li>
@endcan


@can('profile.index')
    <li class="menu-item {{ request()->routeIs('profile.index') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('profile.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-user-circle"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
            </svg>
            <span class="menu-title text-truncate">Profile
            </span>
        </a>
    </li>
@endcan


{{-- END B2Door Navigation --}}
