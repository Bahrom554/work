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
        <li>
            <a href="{{ route('group.index') }}">
                <div class="parent-icon"><i class="bi bi-people"></i>
                </div>
                <div class="menu-title">Group</div>
            </a>
        </li>
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-person"></i>
                </div>
                <div class="menu-title">User</div>
            </a>
        </li>
        @can('admin')
            <li>
                <a href="">
                    <div class="parent-icon"><i class="bi bi-car-front"></i>
                    </div>
                    <div class="menu-title">Xisobot</div>
                </a>
            </li>
        @endcan
    </ul>
    <!--end navigation-->
</aside>
