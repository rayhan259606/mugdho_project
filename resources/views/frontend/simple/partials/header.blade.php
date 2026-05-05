<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset($systemSetting->logo ?? 'default/logo.svg') }}" alt="Logo" style="height: 45px;">
                <span class="ms-2 fw-bold text-primary fs-20">{{ $systemSetting->name ?? env('APP_NAME') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex mx-auto my-3 my-lg-0 search-form" action="{{ route('home') }}" method="GET">
                    <input class="form-control me-2 rounded-pill border-light px-4 shadow-none" type="search" name="search" placeholder="Search products..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-primary rounded-pill px-4" type="submit"><i class="fe fe-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-500" href="{{ route('module.msm') }}">MSM Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-500" href="{{ route('module.gadgets') }}">Gadgets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-500" href="{{ route('module.digital') }}">Digital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-500" href="{{ route('module.antique') }}">Antique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-500" href="{{ route('module.services') }}">Services</a>
                    </li>
                    @auth
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-primary rounded-pill px-4" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar { transition: all 0.3s ease; }
    .nav-link { 
        color: #1e293b !important; 
        transition: color 0.3s ease;
        padding: 0.5rem 1rem !important;
    }
    .nav-link:hover { color: #4e73df !important; }
    .fw-500 { font-weight: 500; }
    .fs-20 { font-size: 20px; }

    @media (min-width: 992px) {
        .search-form { width: 50%; }
    }
    @media (max-width: 991px) {
        .search-form { width: 100%; }
        .navbar-nav { padding-top: 10px; }
        .nav-item { width: 100%; text-align: center; }
        .nav-item .btn { width: 100%; margin-top: 10px; }
    }
</style>