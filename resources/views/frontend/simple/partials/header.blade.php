<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="mainNavbar">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset($systemSetting->logo ?? 'default/logo.svg') }}" 
                     alt="Logo" class="logo-img">
                <span class="ms-3 fw-black text-slate-900 fs-22 tracking-tight">{{ $systemSetting->name ?? env('APP_NAME') }}</span>
            </a>

            <!-- Mobile Toggler -->
<button class="navbar-toggler border-0 shadow-none p-2" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#navbarNav">

    <i class="fe fe-home text-white fs-5"></i>

</button>

            <!-- Main Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <!-- Search Bar (Centered on Large Screens, Fixed Spacing) -->
                <form class="search-form d-flex mx-lg-auto my-3 my-lg-0" action="{{ route('home') }}" method="GET">
                    <div class="input-group-premium">
                        <span class="input-group-text-premium">
                            <i class="fe fe-search text-muted"></i>
                        </span>
                        <input class="form-control-premium" 
                               type="search" 
                               name="search" 
                               placeholder="Search premium products..." 
                               value="{{ request('search') }}">
                    </div>
                </form>

                <!-- Navigation Links (With perfect spacing from search) -->
                <ul class="navbar-nav ms-lg-4 align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link-premium" href="{{ route('module.msm') }}">MSM Course</a></li>
                    <li class="nav-item"><a class="nav-link-premium" href="{{ route('module.gadgets') }}">Gadgets</a></li>
                    <li class="nav-item"><a class="nav-link-premium" href="{{ route('module.digital') }}">Digital</a></li>
                    <li class="nav-item"><a class="nav-link-premium" href="{{ route('module.antique') }}">Antique</a></li>
                    <li class="nav-item"><a class="nav-link-premium" href="{{ route('module.services') }}">Services</a></li>

                    {{-- @auth
                        <li class="nav-item ms-lg-3">
                            <a class="btn-nav-action btn-nav-primary" href="{{ route('admin.dashboard') }}">
                                <i class="fe fe-grid me-2"></i>Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a class="btn-nav-action btn-nav-outline" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @endauth --}}
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap');

    /* CSS VARIABLES FOR PREMIUM THEME */
    :root {
        --nav-primary: #4f46e5;
        --nav-primary-glow: rgba(79, 70, 229, 0.08);
        --slate-900: #0f172a;
        --slate-700: #334155;
        --slate-200: #e2e8f0;
        --nav-font: 'Plus Jakarta Sans', sans-serif;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 18px 0;
        font-family: var(--nav-font);
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.95);
        padding: 12px 0;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
    }

    /* LOGO & BRAND */
    .logo-img {
        height: 46px;
        width: auto;
        transition: transform 0.3s ease;
    }
    .navbar-brand:hover .logo-img {
        transform: scale(1.04);
    }
    .fw-black { font-weight: 900 !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .tracking-tight { letter-spacing: -0.5px; }
    .fs-22 { font-size: 22px; }

    /* MODERN BOLD NAV LINKS & LUXURY HOVER EFFECT */
    .nav-link-premium {
        color: var(--slate-700) !important;
        font-weight: 800 !important; /* লেখাগুলোকে বড় এবং বোল্ড করা হয়েছে */
        font-size: 15px;
        padding: 10px 18px !important;
        margin: 0 2px;
        position: relative;
        display: inline-block;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    /* Luxurious Glow Background + Underline Effect */
    .nav-link-premium::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 18px;
        right: 18px;
        height: 3px;
        background: linear-gradient(90deg, #4f46e5, #06b6d4);
        border-radius: 10px;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .nav-link-premium:hover {
        color: var(--nav-primary) !important;
    }

    .nav-link-premium:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* PREMIUM INPUT SEARCH BAR */
    .search-form {
        max-width: 380px;
        width: 100%;
    }

    .input-group-premium {
        display: flex;
        align-items: center;
        width: 100%;
        background: #f8fafc;
        border-radius: 100px;
        border: 2px solid #f1f5f9;
        padding: 2px 6px;
        transition: all 0.3s ease;
    }

    .input-group-premium:focus-within {
        background: #fff;
        border-color: var(--nav-primary);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.12), 0 0 0 4px rgba(79, 70, 229, 0.08);
    }

    .input-group-text-premium {
        background: transparent;
        border: none;
        padding-left: 14px;
        display: flex;
        align-items: center;
    }

    .form-control-premium {
        border: none;
        background: transparent;
        box-shadow: none !important;
        padding: 10px 12px;
        font-size: 14px;
        font-weight: 600;
        color: var(--slate-900);
        width: 100%;
    }
    .form-control-premium::placeholder {
        color: #94a3b8;
        font-weight: 500;
    }

    /* PREMIUM AUTH BUTTONS */
    .btn-nav-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 24px;
        font-weight: 700;
        font-size: 14px;
        border-radius: 100px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }

    .btn-nav-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
    }
    .btn-nav-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        opacity: 0.95;
    }

    .btn-nav-outline {
        border: 2px solid var(--slate-200);
        color: var(--slate-900) !important;
    }
    .btn-nav-outline:hover {
        border-color: var(--nav-primary);
        color: var(--nav-primary) !important;
        background: var(--nav-primary-glow);
        transform: translateY(-2px);
    }

    /* RESPONSIVE DESIGN REFINEMENTS */
    @media (max-width: 991px) {
        .navbar {
            padding: 14px 0;
            background: #ffffff !important;
        }
        
        /* সার্চ বার ও মেনু আইটেমের মধ্যকার স্পেসিং ফিক্স */
        .search-form {
            margin: 16px 0 12px 0 !important;
            max-width: 100%;
        }

        .navbar-nav {
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
        }

        .nav-item {
            margin: 4px 0;
            width: 100%;
        }

        .nav-link-premium {
            padding: 14px 20px !important;
            font-size: 16px;
            display: block;
            border-radius: 12px;
        }
        .nav-link-premium:hover {
            background: var(--nav-primary-glow);
        }
        .nav-link-premium::after {
            display: none; /* মোবাইলে আন্ডারলাইন অফ করে ক্লিন ব্যাকগ্রাউন্ড দেওয়া হয়েছে */
        }

        .btn-nav-action {
            width: 100%;
            margin-top: 8px;
            padding: 12px 24px;
        }
    }

    @media (max-width: 576px) {
        .logo-img { height: 38px; }
        .fs-22 { font-size: 18px; }
    }

    /* =========================
   ULTRA MOBILE RESPONSIVE
========================= */

@media (max-width: 991px) {

    .container{
        padding-left: 14px;
        padding-right: 14px;
    }

    /* Navbar */
    .navbar {
        padding: 12px 0;
    }

    .navbar-brand {
        max-width: 75%;
        overflow: hidden;
    }

    .navbar-brand span {
        font-size: 17px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .logo-img {
        height: 36px;
    }

    /* Toggler */
.navbar-toggler {
    background: #797670;
    border-radius: 12px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.navbar-toggler:hover {
    transform: scale(1.05);
    background: #dad8df;
}

.navbar-toggler i {
    font-size: 20px;
    color: #fff;
}

    /* Mobile menu */
    .navbar-collapse {
        margin-top: 14px;
        background: #ffffff;
        border-radius: 20px;
        padding: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        animation: smoothDropdown 0.3s ease;
    }

    @keyframes smoothDropdown {
        from{
            opacity:0;
            transform: translateY(-10px);
        }
        to{
            opacity:1;
            transform: translateY(0);
        }
    }

    /* Search bar */
    .search-form {
        width: 100%;
        max-width: 100%;
        margin: 0 0 18px 0 !important;
    }

    .input-group-premium {
        width: 100%;
        border-radius: 16px;
        padding: 4px 10px;
        min-height: 54px;
    }

    .form-control-premium {
        font-size: 15px;
        padding: 12px;
    }

    /* Nav items */
    .navbar-nav {
        gap: 10px;
        padding-top: 0;
        border-top: none;
    }

    .nav-item {
        width: 100%;
    }

    .nav-link-premium {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 18px !important;
        border-radius: 16px;
        background: #f8fafc;
        font-size: 15px;
        font-weight: 800 !important;
        transition: all 0.3s ease;
    }

    .nav-link-premium:hover {
        background: rgba(79, 70, 229, 0.08);
        transform: translateY(-2px);
    }

    /* Buttons */
    .btn-nav-action {
        width: 100%;
        min-height: 50px;
        border-radius: 14px;
        margin-top: 8px;
    }
}


/* =========================
   EXTRA SMALL DEVICES
========================= */

@media (max-width: 576px) {

    .container{
        padding-left: 12px;
        padding-right: 12px;
    }

    .navbar-brand span {
        font-size: 15px !important;
    }

    .logo-img {
        height: 32px;
    }

    .navbar-toggler {
        width: 40px;
        height: 40px;
    }

    .navbar-collapse {
        padding: 14px;
        border-radius: 18px;
    }

    .nav-link-premium {
        font-size: 14px;
        padding: 14px !important;
    }

    .input-group-premium {
        min-height: 50px;
    }

    .form-control-premium {
        font-size: 14px;
    }
}


/* =========================
   SUPER SMALL DEVICES
========================= */

@media (max-width: 380px) {

    .navbar-brand span {
        display: none;
    }

    .logo-img {
        height: 30px;
    }

    .navbar-toggler {
        width: 38px;
        height: 38px;
    }

    .nav-link-premium {
        padding: 13px !important;
        font-size: 13px;
    }

    .form-control-premium {
        font-size: 13px;
    }
}
</style>

<script>
    // Scroll handling for clean visual feedback
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
