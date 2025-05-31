<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.index') }}">
            <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="40" alt="Logo web Dặt lịch khám">
        </a>


        <ul class="sidebar-nav">
            @php
                $user = Auth::user();
            @endphp

            @if ($user && $user->role == 'admin')
                <li class="sidebar-header text-primary">
                    <b>
                        HỆ THỐNG
                    </b>

                </li>

                <li class="sidebar-item {{ request()->routeIs('nhanvien.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('nhanvien.index') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">
                            Quản lý nhân viên
                        </span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('lichsu.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('lichsu.index') }}">
                        <i class="align-middle" data-feather="clock"></i>
                        <span class="align-middle">
                            Lịch sử tác vụ
                        </span>
                    </a>
                </li>
            @endif

            @if ($user && in_array($user->role, ['manage', 'hospital']))
                <li class="sidebar-header text-primary">
                    <b>
                       DANH MỤC
                    </b>
                </li>
            @endif
            @if ($user && in_array($user->role, ['manage']))
                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qlcoso') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('coso.index') }}">
                        <i class="align-middle" data-feather="home"></i>
                        <span class="align-middle">Quản lý cơ sở</span>
                    </a>
                </li>
            @endif
            @if ($user && in_array($user->role, ['manage', 'hospital']))
                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qlchuyenkhoa') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('chuyenkhoa.index') }}">
                        <i class="align-middle" data-feather="layers"></i>
                        <span class="align-middle">Quản lý chuyên khoa</span>
                    </a>
                </li>

                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qlbacsi') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('bacsi.index') }}">
                        <i class="align-middle" data-feather="user-check"></i>
                        <span class="align-middle">Quản lý bác sĩ</span>
                    </a>
                </li>

                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qllichkham') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('lichkham.index') }}">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span class="align-middle">Quản lý lịch khám</span>
                    </a>
                </li>

                <li class="sidebar-header text-primary">
                    <b>
                       NGHIỆP VỤ
                    </b>
                </li>

                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qlbenhnhan') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('taikhoanbenhnhan.index') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">Quản lý bệnh nhân</span>
                    </a>
                </li>

                <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qllichhen') !== false) active @endif">
                    <a class="sidebar-link" href="{{ route('lichhen.index') }}">
                        <i class="align-middle" data-feather="package"></i>
                        <span class="align-middle">Quản lý lịch hẹn</span>
                    </a>
                </li>
                @if ($user && $user->role == 'manage')
                    <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'qltintuc') !== false) active @endif">
                        <a class="sidebar-link" href="{{ route('qltintuc.index') }}">
                            <i class="align-middle" data-feather="file-text"></i>
                            <span class="align-middle">Quản lý tin tức</span>
                        </a>
                    </li>
                    @elseif($user && $user->role == 'hospital')
                    <li class="sidebar-item @if (strpos($_SERVER['REQUEST_URI'], 'thongke') !== false) active @endif">
                        <a class="sidebar-link" href="{{ route('thongkecoso.index') }}">
                            <i class="align-middle" data-feather="activity"></i>
                            <span class="align-middle">Thống kê</span>
                        </a>
                    </li>
                @endif
            @endif

            @if ($user && $user->role == 'news')
                <li class="sidebar-item {{ request()->routeIs('dstintuc.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dstintuc.index') }}">
                        <i class="align-middle" data-feather="file-text"></i>
                        <span class="align-middle">Danh sách tin tức</span>
                    </a>
                </li>
            @endif
        </ul>

    </div>
</nav>
