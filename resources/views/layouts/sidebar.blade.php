<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="menu-title">  <span>Main </span>
        </li>
        <li class="{{ Request::is('home*') ? 'active':''}}">
            <a href="{{ route('home') }}"><i class="feather-home"></i><span class="shape1"></span><span class="shape2"></span><span>Bosh Sahifa </span></a>
        </li>
        @can('filial-index')
        <li class="submenu {{ Request::is('filial*') ? 'active':''}}">
            <a href="#" class="{{ Request::is('filial*') ? 'subdrop':''}}"><i class="feather-git-branch"></i>  <span>Filial</span>  <span class="menu-arrow"></span></a>
            <ul style="display: {{ Request::is('filial*') ? 'block':'none'}}">
                <li><a href="{{ route('filial.create') }}">Filial Qo'shish </a></li>
                <li><a href="{{ route('filial.index') }}">Filial Ro'yxati </a></li>
            </ul>
        </li>
        @endcan
        @can('texnika-index')
            <li class="submenu {{ Request::is('texnika*') ? 'active':''}}">
                <a href="#" class="{{ Request::is('texnika*') ? 'subdrop':''}}"><i class="feather-play"></i>  <span>Texnika</span>  <span class="menu-arrow"></span></a>
                <ul style="display: {{ Request::is('texnika*') ? 'block':'none'}}">
                    <li><a href="{{ route('texnika.create') }}">Texnika Qo'shish </a></li>
                    <li><a href="{{ route('texnika.index') }}">Texnika Ro'yxati </a></li>
                </ul>
            </li>
        @endcan
        @can('departament-index')
        <li class="submenu">
            <a href="#"><i class="feather-package"></i><span>Departament</span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a href="{{ route('departament.create') }}">Departament Qo'shish </a></li>
                <li><a href="{{ route('departament.index') }}">Departament Ro'yxati </a></li>
                <li><a href="{{ route('dep.texnika') }}">Texnikalar Taqsimoti </a></li>
            </ul>
        </li>
        @endcan
        @can('bolim-index')
        <li class="submenu">
            <a href="#"><i class="feather-package"></i><span>Bo'lim</span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a href="{{ route('bolim.create') }}">Bo'lim Qo'shish </a></li>
                <li><a href="{{ route('bolim.index') }}">Bo'lim Ro'yxati </a></li>
            </ul>
        </li>
        @endcan
        @can('user-index')
        <li class="submenu {{ Request::is('user*') || Request::is('role*') || Request::is('permission*') ? 'active':''}}">
            <a href="#" class="{{ Request::is('user*') || Request::is('role*') || Request::is('permission*') ? 'subdrop':''}}"><i class="feather-user"></i><span>Administrator</span>  <span class="menu-arrow"></span></a>
            <ul style="display: {{ Request::is('user*') || Request::is('role*') || Request::is('permission*') ? 'block':'none'}};">
                <li><a href="{{ route("user.index") }}">Foydalanuvchi</a></li>
                <li><a href="{{ route("role.index") }}">Vazifasi</a></li>
                <li><a href="{{ route("permission.index") }}">Ruxsati</a></li>
            </ul>
        </li>
        @endcan
        <li>
            <a href="{{ route('logout') }}" class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Chiqish
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
</div>

