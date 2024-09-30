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
        </ul>
    </li>
@endcan

@can('reports.index')
    <li class="menu-item {{ request()->routeIs('reports.index') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('reports.index') }}">
            {{-- <i class="menu-icon tf-icons ti ti-smart-home"></i> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon icon-tabler icon-tabler-checkup-list"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
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

{{-- @canany(['location.index', 'route.index', 'paper-type.index', 'paper-quality.index', 'design.index', 'orders.index', 'orders.create', 'orders.show', 'printing-press.index', 'distributor.index', 'vehicle-media.index']) --}}
<li class="menu-header">
    <span data-i18n="Marketplace">Marketplace</span>
</li>
{{-- @endcanany --}}

@can('event.index')
    <li class="menu-item
    {{ request()->routeIs('event.*') ? 'active' : null }}
        ">
        <a class="menu-link" href="{{ route('event.index') }}">
            <i class="icon menu-icon ti ti-calendar-event"></i>
            <span class="menu-title text-truncate">Event
            </span>
        </a>
    </li>
@endcan

{{-- @canany(['orders.index', 'orders.create', 'orders.show', 'orders.edit']) --}}
{{-- <li class="menu-item
    {{ request()->routeIs('booking.*') ? 'active' : null }}
        ">
    <a class="menu-link" href="{{ route('booking.index') }}">
        <i class="icon menu-icon ti ti-shopping-cart"></i>
        <span class="menu-title text-truncate">Booking
        </span>
    </a>
</li> --}}
{{-- @endcanany --}}

<li class="menu-item
    {{ request()->routeIs('gallery.*') ? 'active' : null }}
        ">
    <a class="menu-link" href="{{ route('gallery.index') }}">
        <i class="icon menu-icon ti ti-photo">
        </i>
        <span class="menu-title text-truncate">Gallery
        </span>
    </a>
</li>


{{-- Chat --}}
@canany(['chat.index', 'profile.index', 'profile.edit'])
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
    <li
        class="menu-item {{ request()->routeIs('profile.index') || request()->routeIs('profile.edit') ? 'active' : null }}">
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


{{-- END Navigation --}}
