<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> Home
    </a>
</li>



<li class="c-sidebar-nav-item {{ request()->routeIs('devices.list') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('devices.list') }}">
        <i class="c-sidebar-nav-icon bi bi-hdd-rack" style="line-height: 1;"></i> Devices
    </a>
</li>



<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="/reports">
        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Test Reports
    </a>
</li>

<ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}" href="{{ route('settings.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> System Settings
                </a>
            </li>
        </ul>
