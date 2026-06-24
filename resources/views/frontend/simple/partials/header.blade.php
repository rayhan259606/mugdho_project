<header class="header-container">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="mainNavbar">
        <div class="container">

            <!-- Logo & Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset($systemSetting->logo ?? 'default/logo.svg') }}" alt="Logo" class="logo-img">

            </a>

            <!-- Search Bar (Desktop: Visible, Mobile: Hidden) -->
            <form class="search-form d-none d-lg-block mx-auto" action="{{ route('home') }}" method="GET">
                <div class="input-group-premium">
                    <span class="input-group-text-premium">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon-svg">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input class="form-control-premium" type="search" name="search"
                        placeholder="Search premium products..." value="{{ request('search') }}">
                    <span class="search-shortcut">Ctrl K</span>
                </div>
            </form>

            <!-- Desktop Navigation Links & Action Buttons -->
            <div class="collapse navbar-collapse d-none d-lg-block flex-grow-0" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('module.msm') ? 'active' : '' }}"
                            href="{{ route('module.msm') }}">
                            <span>MSM Course</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('module.gadgets') ? 'active' : '' }}"
                            href="{{ route('module.gadgets') }}">
                            <span>Gadgets</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('module.digital') ? 'active' : '' }}"
                            href="{{ route('module.digital') }}">
                            <span>Digital</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('module.antique') ? 'active' : '' }}"
                            href="{{ route('module.antique') }}">
                            <span>Antique</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('module.services') ? 'active' : '' }}"
                            href="{{ route('module.services') }}">
                            <span>Services</span>
                        </a>
                    </li> -->

                    {{-- @auth
                    <li class="nav-item ms-2">
                        <a class="btn-nav-action btn-nav-primary" href="{{ route('admin.dashboard') }}">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item ms-2">
                        <a class="btn-nav-action btn-nav-outline" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    @endauth --}}
                </ul>
            </div>

            <!-- Mobile Toggler (Modern Hamburger) -->
            <button class="navbar-toggler-premium border-0 shadow-none d-lg-none" type="button"
                aria-label="Toggle navigation" id="mobileDrawerToggler">
                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

        </div>
    </nav>

    <!-- Mobile Drawer Backdrop Overlay -->
    <div class="drawer-backdrop" id="mobileDrawerBackdrop"></div>

    <!-- Mobile Navigation Drawer (Sleek App-Like Slide-out) -->
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header d-flex align-items-center justify-content-between">
            <a class="d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset($systemSetting->favicon ?? $systemSetting->logo ?? 'default/logo.svg') }}" alt="Logo"
                    class="logo-img-mobile">
                <span
                    class="brand-text-mobile ms-2 fw-extrabold tracking-tight">{{ $systemSetting->name ?? env('APP_NAME') }}</span>
            </a>
            <button type="button" class="drawer-close" id="mobileDrawerClose" aria-label="Close menu">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="drawer-body">
            <!-- Mobile Search Bar inside Drawer -->
            <form class="drawer-search-form" action="{{ route('home') }}" method="GET">
                <div class="input-group-premium">
                    <span class="input-group-text-premium">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input class="form-control-premium" type="search" name="search"
                        placeholder="Search premium products..." value="{{ request('search') }}">
                </div>
            </form>

            <!-- Navigation Links list -->
            <nav class="drawer-nav">
                <div class="drawer-nav-title">Categories</div>
                <ul class="drawer-nav-list list-unstyled">
                    <li class="drawer-nav-item animate-item" style="--item-index: 1">
                        <a class="drawer-nav-link {{ request()->routeIs('module.msm') ? 'active' : '' }}"
                            href="{{ route('module.msm') }}">
                            <div class="drawer-link-content">
                                <div class="drawer-icon-wrapper color-msm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                </div>
                                <div class="drawer-link-texts">
                                    <span class="drawer-link-title">MSM Course</span>
                                    <span class="drawer-link-desc">Master marketing & sales skills</span>
                                </div>
                            </div>
                            <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                    <li class="drawer-nav-item animate-item" style="--item-index: 2">
                        <a class="drawer-nav-link {{ request()->routeIs('module.gadgets') ? 'active' : '' }}"
                            href="{{ route('module.gadgets') }}">
                            <div class="drawer-link-content">
                                <div class="drawer-icon-wrapper color-gadgets">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                    </svg>
                                </div>
                                <div class="drawer-link-texts">
                                    <span class="drawer-link-title">Gadgets</span>
                                    <span class="drawer-link-desc">Shop elite hardware & tech</span>
                                </div>
                            </div>
                            <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                    <li class="drawer-nav-item animate-item" style="--item-index: 3">
                        <a class="drawer-nav-link {{ request()->routeIs('module.digital') ? 'active' : '' }}"
                            href="{{ route('module.digital') }}">
                            <div class="drawer-link-content">
                                <div class="drawer-icon-wrapper color-digital">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </div>
                                <div class="drawer-link-texts">
                                    <span class="drawer-link-title">Digital Products</span>
                                    <span class="drawer-link-desc">Modern web & design assets</span>
                                </div>
                            </div>
                            <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                    <li class="drawer-nav-item animate-item" style="--item-index: 4">
                        <a class="drawer-nav-link {{ request()->routeIs('module.antique') ? 'active' : '' }}"
                            href="{{ route('module.antique') }}">
                            <div class="drawer-link-content">
                                <div class="drawer-icon-wrapper color-antique">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="7"></circle>
                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                    </svg>
                                </div>
                                <div class="drawer-link-texts">
                                    <span class="drawer-link-title">Antique Collection</span>
                                    <span class="drawer-link-desc">Rare classical collectibles</span>
                                </div>
                            </div>
                            <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                    <!-- <li class="drawer-nav-item animate-item" style="--item-index: 5">
                        <a class="drawer-nav-link {{ request()->routeIs('module.services') ? 'active' : '' }}"
                            href="{{ route('module.services') }}">
                            <div class="drawer-link-content">
                                <div class="drawer-icon-wrapper color-services">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </div>
                                <div class="drawer-link-texts">
                                    <span class="drawer-link-title">Business Services</span>
                                    <span class="drawer-link-desc">Get customized enterprise solutions</span>
                                </div>
                            </div>
                            <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>

        {{-- <div class="drawer-footer animate-item" style="--item-index: 6">
            @auth
            <a class="btn-nav-action btn-nav-primary w-100" href="{{ route('admin.dashboard') }}">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </a>
            @else
            <a class="btn-nav-action btn-nav-outline w-100" href="{{ route('login') }}">
                Login to Account
            </a>
            @endauth
        </div> --}}
    </div>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap');

    /* CSS VARIABLES FOR PREMIUM DARK-THEME DESIGN SYSTEM */
    :root {
        --nav-primary: #6366f1;
        --nav-primary-gradient: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        --nav-hover-gradient: linear-gradient(90deg, #6366f1, #06b6d4);
        --nav-primary-glow: rgba(99, 102, 241, 0.15);
        --slate-950: #090d16;
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
        --slate-400: #94a3b8;
        --slate-300: #cbd5e1;
        --nav-font: 'Plus Jakarta Sans', sans-serif;
        --shadow-subtle: 0 4px 30px rgba(0, 0, 0, 0.2);
        --shadow-premium: 0 10px 30px -10px rgba(0, 0, 0, 0.4);
    }

    /* HEADER & BASE NAVBAR */
    .header-container {
        position: relative;
        z-index: 1040;
        font-family: var(--nav-font);
    }

    .navbar {
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: var(--shadow-subtle);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 16px 0;
    }

    .navbar.scrolled {
        background: rgba(9, 13, 22, 0.98);
        padding: 10px 0;
        box-shadow: var(--shadow-premium);
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .navbar-collapse {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }


    /* BRAND / LOGO */
    .navbar-brand {
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .navbar-brand:hover {
        transform: scale(1.02);
    }

    .logo-img {
        height: 40px;
        width: auto;
        border-radius: 8px;
        object-fit: contain;
    }

    .brand-text {
        font-size: 20px;
        font-weight: 900 !important;
        letter-spacing: -0.5px;
        color: #ffffff;
    }

    /* PREMIUM DESKTOP SEARCH BAR */
    .search-form {
        max-width: 320px;
        width: 100%;
        margin-left: 2.5rem;
    }

    .input-group-premium {
        display: flex;
        align-items: center;
        width: 100%;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 100px;
        border: 1.5px solid rgba(255, 255, 255, 0.1);
        padding: 2px 6px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .input-group-premium:focus-within {
        background: #1e293b;
        border-color: var(--nav-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.25), 0 10px 25px -10px rgba(0, 0, 0, 0.3);
    }

    .input-group-text-premium {
        background: transparent;
        border: none;
        padding-left: 12px;
        display: flex;
        align-items: center;
    }

    .search-icon-svg {
        color: var(--slate-400);
        transition: color 0.3s ease;
    }

    .input-group-premium:focus-within .search-icon-svg {
        color: #ffffff !important;
    }

    .form-control-premium {
        border: none;
        background: transparent;
        box-shadow: none !important;
        padding: 8px 12px;
        font-size: 13.5px;
        font-weight: 600;
        color: #ffffff;
        width: 100%;
    }

    .form-control-premium::placeholder {
        color: var(--slate-400);
        font-weight: 500;
        opacity: 0.75;
    }

    .search-shortcut {
        font-size: 10px;
        font-weight: 700;
        color: var(--slate-400);
        background: rgba(255, 255, 255, 0.12);
        padding: 3px 8px;
        border-radius: 6px;
        margin-right: 8px;
        pointer-events: none;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: opacity 0.25s ease;
    }

    .input-group-premium:focus-within .search-shortcut {
        opacity: 0;
    }

    /* PREMIUM NAV LINKS (DESKTOP) */
    .nav-link-premium {
        color: var(--slate-300) !important;
        font-weight: 800 !important;
        font-size: 13.5px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 8px 16px !important;
        border-radius: 8px;
        position: relative;
        display: inline-block;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nav-link-premium:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.06);
    }

    .nav-link-premium.active {
        color: #ffffff !important;
        background: var(--nav-primary-glow);
    }

    .nav-link-premium::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 16px;
        right: 16px;
        height: 2.5px;
        background: var(--nav-hover-gradient);
        border-radius: 10px;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .nav-link-premium:hover::after,
    .nav-link-premium.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* PREMIUM ACTION BUTTONS */
    .btn-nav-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px;
        font-weight: 700;
        font-size: 13.5px;
        border-radius: 100px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }

    .btn-nav-primary {
        background: var(--nav-primary-gradient);
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.18);
        border: 1px solid transparent;
    }

    .btn-nav-primary:hover {
        transform: translateY(-1.5px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.28);
    }

    .btn-nav-outline {
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        color: #ffffff !important;
        background: transparent;
    }

    .btn-nav-outline:hover {
        border-color: var(--nav-primary);
        color: #ffffff !important;
        background: var(--nav-primary-glow);
        transform: translateY(-1.5px);
    }

    /* MODERN HAMBURGER TOGGLER */
    .navbar-toggler-premium {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }

    .navbar-toggler-premium:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: scale(1.05);
    }

    .hamburger-menu {
        width: 18px;
        height: 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }

    .hamburger-menu span {
        display: block;
        width: 100%;
        height: 2px;
        background: #ffffff;
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .navbar-toggler-premium.open .hamburger-menu span:nth-child(1) {
        transform: translateY(5px) rotate(45deg);
    }

    .navbar-toggler-premium.open .hamburger-menu span:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }

    .navbar-toggler-premium.open .hamburger-menu span:nth-child(3) {
        transform: translateY(-5px) rotate(-45deg);
    }

    /* =========================
       MOBILE DRAWER NAVIGATION
    ========================= */
    .drawer-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(9, 13, 22, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 1040;
    }

    .drawer-backdrop.active {
        opacity: 1;
        pointer-events: auto;
    }

    .mobile-drawer {
        position: fixed;
        top: 0;
        right: -320px;
        width: 320px;
        height: 100vh;
        background: rgba(15, 23, 42, 0.96);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-left: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: -10px 0 40px rgba(0, 0, 0, 0.3);
        z-index: 1045;
        display: flex;
        flex-direction: column;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 24px;
        box-sizing: border-box;
    }

    .mobile-drawer.open {
        transform: translateX(-320px);
    }

    .drawer-header {
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 18px;
    }

    .logo-img-mobile {
        height: 34px;
        width: auto;
        border-radius: 6px;
    }

    .brand-text-mobile {
        font-weight: 950 !important;
        font-size: 18px;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .drawer-close {
        background: rgba(255, 255, 255, 0.06);
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--slate-300);
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .drawer-close:hover {
        background: rgba(99, 102, 241, 0.2);
        color: #ffffff;
        transform: rotate(90deg);
    }

    .drawer-body {
        flex: 1;
        overflow-y: auto;
        margin-right: -10px;
        padding-right: 10px;
    }

    .drawer-search-form {
        margin-bottom: 24px;
    }

    .drawer-search-form .input-group-premium {
        background: rgba(255, 255, 255, 0.06);
        border-color: transparent;
        padding: 4px 8px;
    }

    .drawer-search-form .input-group-premium:focus-within {
        background: #1e293b;
        border-color: var(--nav-primary);
    }

    .drawer-nav-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--slate-400);
        margin-bottom: 12px;
        padding-left: 4px;
    }

    .drawer-nav-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 0;
        margin: 0;
    }

    .drawer-nav-item {
        list-style: none;
    }

    .drawer-nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        border-radius: 14px;
        background: transparent;
        text-decoration: none !important;
        border: 1px solid transparent;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .drawer-nav-link:hover,
    .drawer-nav-link.active {
        background: rgba(255, 255, 255, 0.04);
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
    }

    .drawer-link-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .drawer-icon-wrapper {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .drawer-icon-wrapper svg {
        width: 18px;
        height: 18px;
    }

    /* CATEGORIZED COLORS FOR MOBILE DRAWER CARDS */
    .color-msm {
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
    }

    .color-gadgets {
        background: rgba(6, 182, 212, 0.15);
        color: #22d3ee;
    }

    .color-digital {
        background: rgba(168, 85, 247, 0.15);
        color: #c084fc;
    }

    .color-antique {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
    }

    .color-services {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
    }

    .drawer-nav-link:hover .drawer-icon-wrapper {
        transform: scale(1.1);
    }

    .drawer-link-texts {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .drawer-link-title {
        font-weight: 700;
        font-size: 14px;
        color: #ffffff;
        transition: color 0.2s ease;
    }

    .drawer-nav-link:hover .drawer-link-title,
    .drawer-nav-link.active .drawer-link-title {
        color: #ffffff;
    }

    .drawer-link-desc {
        font-size: 11px;
        font-weight: 500;
        color: var(--slate-400);
    }

    .drawer-chevron {
        width: 16px;
        height: 16px;
        color: var(--slate-400);
        transition: all 0.3s ease;
        opacity: 0.5;
    }

    .drawer-nav-link:hover .drawer-chevron {
        opacity: 1;
        transform: translateX(3px);
        color: #ffffff;
    }

    .drawer-footer {
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin-top: 18px;
    }

    /* STAGGERED ENTRANCE ANIMATION FOR ITEMS */
    .drawer-nav-item.animate-item,
    .drawer-footer.animate-item {
        opacity: 0;
        transform: translateY(12px);
        transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mobile-drawer.open .animate-item {
        opacity: 1;
        transform: translateY(0);
        transition-delay: calc(var(--item-index) * 0.06s);
    }

    /* =========================
       RESPONSIVE RESOLUTION BREAKPOINTS
    ========================= */
    @media (max-width: 991px) {
        .navbar {
            padding: 12px 0;
        }

        .logo-img {
            height: 34px;
        }

        .brand-text {
            font-size: 18px;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding-left: 16px;
            padding-right: 16px;
        }

        .brand-text {
            font-size: 16px;
        }

        .logo-img {
            height: 30px;
        }

        .navbar-toggler-premium {
            width: 36px;
            height: 36px;
            border-radius: 8px;
        }

        .mobile-drawer {
            width: 100vw;
            right: -100vw;
        }

        .mobile-drawer.open {
            transform: translateX(-100vw);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Sticky Navbar Scrolling Shrink Effect
        const navbar = document.getElementById('mainNavbar');
        const handleScroll = () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Check on initial page load

        // Drawer Controls
        const toggler = document.getElementById('mobileDrawerToggler');
        const drawer = document.getElementById('mobileDrawer');
        const backdrop = document.getElementById('mobileDrawerBackdrop');
        const closeBtn = document.getElementById('mobileDrawerClose');

        function toggleDrawer() {
            const isOpen = drawer.classList.contains('open');
            if (isOpen) {
                drawer.classList.remove('open');
                backdrop.classList.remove('active');
                toggler.classList.remove('open');
                document.body.style.overflow = '';
            } else {
                drawer.classList.add('open');
                backdrop.classList.add('active');
                toggler.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
        }

        if (toggler) toggler.addEventListener('click', toggleDrawer);
        if (closeBtn) closeBtn.addEventListener('click', toggleDrawer);
        if (backdrop) backdrop.addEventListener('click', toggleDrawer);

        // Keyboard Shortcut: Focus Search Form
        window.addEventListener('keydown', (e) => {
            // Handle Cmd+K / Ctrl+K shortcut
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                const desktopSearch = document.querySelector('.search-form .form-control-premium');
                if (desktopSearch && window.innerWidth >= 992) {
                    desktopSearch.focus();
                }
            }
        });
    });
</script>