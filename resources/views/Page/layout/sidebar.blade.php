<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>





        <li class="nav-item">
            <a class="nav-link {{ request()->is('telnet') ? '' : 'collapsed' }}" href="{{route('telnet')}}">
                <i class="bi   bi-person-vcard-fill"></i>
                <span>Telnet İstifadəçilər</span>
            </a>
        </li>

     {{--   <li class="nav-item">
            <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Maliyyə</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html" class="active">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li>--}}




        <li class="nav-item">
            <a class="nav-link {{ in_array(request()->path(), ['ixa', 'dp', 'hm', 'ml', 'mld']) ? '' : 'collapsed' }}"
               data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-pie-chart-fill"></i><span>Analiz</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse {{ in_array(request()->path(), ['ixa', 'dp', 'hm', 'ml', 'mld']) ? 'show' : '' }} " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('ixa')}}" class="{{ request()->is('ixa') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>İnternet xidməti analizi</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dp')}}" class="{{ request()->is('dp') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Digər provayder</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('hm')}}" class="{{ request()->is('hm') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Hesablanmış məbləğ</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('ml')}}" class="{{ request()->is('ml') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>MHM ilə LKŞ fərqlər</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mld')}}" class="{{ request()->is('mld') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>MHM ilə LKŞ Dovruyye cedveli</span>
                    </a>
                </li>

            </ul>
        </li>





        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li>


        <!-- End Blank Page Nav -->

    </ul>

</aside>
!-- End Sidebar-->
