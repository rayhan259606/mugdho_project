<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/images/brand/favicon.ico" />

<!-- TITLE -->
<title>Noa - Laravel Bootstrap 5 Admin & Dashboard Template</title>

<!-- BOOTSTRAP CSS -->
<link id="style" href="{{ asset('backend') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{ asset('backend') }}/css/style.css" rel="stylesheet"/>

<!--- FONT-ICONS CSS -->
<link href="{{ asset('backend') }}/plugins/icons/icons.css" rel="stylesheet"/>

<!-- INTERNAL Switcher css -->
<link href="{{ asset('backend') }}/switcher/css/switcher.css" rel="stylesheet" />
<link href="{{ asset('backend') }}/switcher/demo.css" rel="stylesheet" />

<!-- MODERN FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- ANIMATE CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    body {
        font-family: 'Outfit', sans-serif;
        color: #1e293b;
        background-color: #fff;
    }
    .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
        font-weight: 800;
        color: #0f172a;
    }
    h1, h2, h3, h4, h5, h6 {
        font-weight: 700;
        color: #1e293b;
    }
    .text-slate-900 { color: #0f172a !important; }
    .text-slate-800 { color: #1e293b !important; }
    .text-slate-700 { color: #334155 !important; }
    .text-slate-600 { color: #475569 !important; }
    
    .btn-primary {
        background-color: #6366f1 !important;
        border-color: #6366f1 !important;
        color: #fff !important;
    }
    .btn-primary:hover {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3) !important;
    }
    .rounded-pill {
        border-radius: 50rem !important;
    }
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    
    /* Override potential template defaults */
    .navbar-light .navbar-nav .nav-link {
        color: #334155 !important;
    }
    .navbar-light .navbar-nav .nav-link:hover {
        color: #6366f1 !important;
    }
</style>
@stack('style')