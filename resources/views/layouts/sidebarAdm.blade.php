<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<aside class="sidebar">
    <div class="brand-area">
        <img src="{{ asset('images/Logo-Sigap.png') }}" alt="Logo" class="logo-img">
        <h2>SIGAP</h2>
    </div>
    
    <div class="role-badge">Admin</div>

    <nav class="nav-menu">
        <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
            <i class="fa-solid fa-house-user"></i> Dashboard
        </a>

        <a href="/admin/aspirasi" class="nav-link {{ request()->is('admin/aspirasi*') ? 'active' : '' }}">
            <i class="fa-solid fa-inbox"></i> Data Aspirasi
        </a>

        <a href="/admin/kategori" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i> Kategori
        </a>

        <a href="/admin/siswa/register" class="nav-link {{ request()->is('admin/siswa/register*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-graduate"></i> Data Siswa
        </a>

        <div class="dropdown-wrapper">
            <a href="javascript:void(0)" class="nav-link" onclick="this.classList.toggle('open')">
                <i class="fa-solid fa-gear"></i> 
                <span>Settings</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/profile" class="sub-link">
                        <i class="fa-regular fa-circle-user" style="margin-right: 8px;"></i> Profile
                    </a>
                </li>
                <li>
                    <a href="/logout" class="sub-link" style="color: var(--brand-red);">
                        <i class="fa-solid fa-power-off" style="margin-right: 8px;"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="{{ asset('js/sidebar.js') }}"></script>