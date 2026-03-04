<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="admin-wrapper">

        {{-- Sidebar --}}
        <nav class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
                    <i class="bi bi-speedometer2"></i>
                    <span>Admin</span>
                </a>
                <button class="admin-sidebar-close d-md-none" id="sidebarClose">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <ul class="admin-sidebar-nav">
                <li class="admin-sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="admin-sidebar-footer">
                <a href="{{ route('logout') }}" class="admin-sidebar-link"
                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
                <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        {{-- Overlay per mobile --}}
        <div class="admin-overlay d-md-none" id="adminOverlay"></div>

        {{-- Contenuto principale --}}
        <div class="admin-content">

            {{-- Header --}}
            <header class="admin-header">
                <button class="admin-header-toggle d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a class="btn btn-link text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/') }}"><i class="bi bi-globe me-2"></i>Vai al sito</a></li>
                            <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="bi bi-person me-2"></i>Profilo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    <i class="bi bi-box-arrow-left me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            {{-- Main --}}
            <main class="admin-main">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('adminOverlay');
        const toggle = document.getElementById('sidebarToggle');
        const close = document.getElementById('sidebarClose');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('open');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }

        if (toggle) toggle.addEventListener('click', openSidebar);
        if (close) close.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
    </script>
</body>

</html>
