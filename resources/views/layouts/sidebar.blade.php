<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('admin/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a style="text-decoration: none" href="{{route('home')}}">
                <h4 class="logo-text"></h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('building.index') }}">
                <div class="parent-icon"><i class="bi bi-building"></i>
                </div>
                <div class="menu-title">Building</div>
            </a>
        </li>
        @hasanyrole('manager|admin')
        <li>
            <a href="{{ route('team.index') }}">
                <div class="parent-icon"><i class="bi bi-people"></i>
                </div>
                <div class="menu-title">Team</div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}">
                <div class="parent-icon"><i class="bi bi-person"></i>
                </div>
                <div class="menu-title">User</div>
            </a>
        </li>
        <li>
            <a href="{{ route('part.index') }}">
                <div class="parent-icon"><i class="bi bi-pie-chart-fill"></i>
                </div>
                <div class="menu-title">Part</div>
            </a>
        </li>
        @endhasanyrole
    </ul>
    <!--end navigation-->
</aside>
