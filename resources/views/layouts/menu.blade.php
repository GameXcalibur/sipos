<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> Home
    </a>
</li>

<li class="c-sidebar-nav-item {{ request()->routeIs('network.list') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('network.list') }}">
        <i class="c-sidebar-nav-icon bi bi-hdd-network" style="line-height: 1;"></i> Network Status
    </a>
</li>


<li class="c-sidebar-nav-item {{ request()->routeIs('devices.list') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('devices.list') }}">
        <i class="c-sidebar-nav-icon bi bi-hdd-rack" style="line-height: 1;"></i> Devices
    </a>
</li>

<li class="c-sidebar-nav-item {{ request()->routeIs('devices.reports') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('devices.reports') }}">
        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Devices Test Report

    </a>
</li>

<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="/reports">
        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Test Reports
    </a>
</li>

<li class="c-sidebar-nav-item {{ request()->routeIs('schedules') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('schedules') }}">
        <i class="c-sidebar-nav-icon bi bi-calendar-check" style="line-height: 1;"></i> Schedules
    </a>
</li>

<li class="c-sidebar-nav-item {{ request()->routeIs('notifications') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('notifications') }}">
        <i class="c-sidebar-nav-icon bi bi-bell" style="line-height: 1;"></i> Notifications
    </a>
</li>
<li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}" href="{{ route('settings.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> System Settings
                </a>
            </li>
            @if(auth()->user()->email == 'wayne@siluxcontrol.com')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('vcm*') ? 'c-active' : '' }}" href="{{ route('vcm') }}">
                    <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> VCM
                </a>
            </li>
            @endif