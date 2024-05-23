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
