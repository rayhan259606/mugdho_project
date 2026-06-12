<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="{{ asset(settings('logo') ?? 'default/logo.png') }}" type="image/x-icon">
  <title>{{ $title ?? '' }} | {{ settings('name') ?? config('app.name') }}</title>
  <meta name="description" content="{!! strip_tags($description ?? settings('description') ?? '') !!}">
  <meta name="keywords" content="{!! strip_tags($keywords ?? settings('keywords') ?? '') !!}">
  <meta name="author" content="{{$author ?? settings('system_name') ?? config('app.name') }}">

  <meta property="og:url" content="{{ $url ?? env('APP_URL') }}" />
  <meta property="og:type" content="{{ $type ?? 'website' }}" />
  <meta property="og:title" content="{{ $title ?? settings('name') ?? config('app.name') }}" />
  <meta property="og:description" content="{!! strip_tags($description ?? settings('description') ?? '') !!}" />
  <meta property="og:image" content="{{ $image ?? asset(settings('thumbnail') ?? 'default/logo.png') }}?v={{ time() }}" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="627" />

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="{{ $title ?? settings('title') ?? config('app.name') }}" />
  <meta name="twitter:description" content="{!! strip_tags($description ?? settings('description') ?? '') !!}" />
  <meta name="twitter:image" content="{{ $image ?? asset(settings('thumbnail') ?? 'default/logo.png') }}" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @include('frontend.default.partials.style')

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <!-- Preloader -->
  <div id="preloader">
    <div class="outer">
      <!-- Google Chrome -->
      <div class="infinityChrome">
        <div></div>
        <div></div>
        <div></div>
      </div>

      <!-- Safari and others -->
      <div class="infinity">
        <div>
          <span></span>
        </div>
        <div>
          <span></span>
        </div>
        <div>
          <span></span>
        </div>
      </div>
      <!-- Stuff -->
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="goo-outer">
        <defs>
          <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
            <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
            <feBlend in="SourceGraphic" in2="goo" />
          </filter>
        </defs>
      </svg>
    </div>
  </div>

  @include('frontend.default.partials.header')

  @yield('content')

  <!-- WhatsApp Floating Button -->
  @php
    $activeNum = settings('whatsapp_active') ?? 1;
    $activeWhatsapp = '';
    if ($activeNum == 1) {
        $activeWhatsapp = settings('whatsapp_number_1');
    } elseif ($activeNum == 2) {
        $activeWhatsapp = settings('whatsapp_number_2');
    } elseif ($activeNum == 3) {
        $activeWhatsapp = settings('whatsapp_number_3');
    } elseif ($activeNum == 4) {
        $activeWhatsapp = settings('whatsapp_number_4');
    }
  @endphp
  @if(!empty($activeWhatsapp))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $activeWhatsapp) }}" 
       target="_blank" 
       class="whatsapp-float animate__animated animate__fadeInUp animate__delay-1s" 
       title="Chat with us on WhatsApp">
        <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.031 6.172c-2.31 0-4.195 1.885-4.195 4.196 0 .885.276 1.71.75 2.4l-.49 1.792 1.844-.483c.664.426 1.442.677 2.276.677 2.31 0 4.196-1.885 4.196-4.196 0-2.31-1.886-4.186-4.181-4.186zm2.443 5.922c-.1.282-.578.547-.854.587-.245.03-.564.05-1.22-.224-.8-.33-1.312-1.127-1.352-1.18-.04-.05-.294-.394-.294-.753 0-.358.188-.534.254-.606.067-.072.146-.09.195-.09s.1.002.144.004c.047.002.112-.018.175.134.067.162.228.556.248.596.02.04.03.088.005.138-.025.05-.053.08-.105.14-.052.062-.11.138-.157.186-.052.052-.107.108-.046.213.06.103.268.442.574.715.393.35 0.724.458.828.51.103.052.164.043.224-.027.06-.07.254-.296.323-.397.07-.1.137-.084.23-.05.093.034.593.28.696.332.103.05.172.076.197.118.026.043.026.246-.075.528zM12 2C6.477 2 2 6.477 2 12c0 2.01.597 3.882 1.621 5.457L2 22l4.729-1.565C8.216 21.433 9.998 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18c-1.724 0-3.324-.483-4.688-1.32l-.336-.208-2.784.922.938-3.424-.228-.363C4.12 14.248 3.6 12.656 3.6 11c0-4.632 3.768-8.4 8.4-8.4s8.4 3.768 8.4 8.4-3.768 8.4-8.4 8.4z"/>
        </svg>
    </a>
    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: #fff !important;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            z-index: 9999;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none !important;
        }
        .whatsapp-float:hover {
            background-color: #128c7e;
            transform: scale(1.15) translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        }
        .whatsapp-float svg {
            width: 28px;
            height: 28px;
        }
    </style>
  @endif

  @include('frontend.default.partials.script')

</body>

</html>