@php
$systemSetting = App\Models\Setting::first();
@endphp

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} | {{ $systemSetting->name ?? env('APP_NAME') }}</title>

    <meta name="description" content="{!! strip_tags($description ?? $systemSetting->description ?? '') !!}">
    <meta name="keywords" content="{!! strip_tags($keywords ?? $systemSetting->keywords ?? '') !!}">
    <meta name="author" content="{{ $author ?? $systemSetting->name ?? env('APP_NAME') }}">

    <!-- Open Graph / Facebook / WhatsApp Sharing Metadata -->
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title ?? $systemSetting->name ?? env('APP_NAME') }}" />
    <meta property="og:description" content="{!! strip_tags($description ?? $systemSetting->description ?? '') !!}" />
    <meta property="og:image" content="{{ isset($image) ? asset($image) : ($systemSetting && $systemSetting->thumbnail && file_exists(public_path($systemSetting->thumbnail)) ? asset($systemSetting->thumbnail) : asset('default/logo.png')) }}?v={{ time() }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="627" />

    <!-- Twitter Sharing Metadata -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title ?? $systemSetting->name ?? env('APP_NAME') }}" />
    <meta name="twitter:description" content="{!! strip_tags($description ?? $systemSetting->description ?? '') !!}" />
    <meta name="twitter:image" content="{{ isset($image) ? asset($image) : ($systemSetting && $systemSetting->thumbnail && file_exists(public_path($systemSetting->thumbnail)) ? asset($systemSetting->thumbnail) : asset('default/logo.png')) }}" />

    <!-- Fixed Favicon -->
                <!--<img src="{{ asset($systemSetting->logo ?? 'default/logo.svg') }}" -->
                <!--     alt="Logo" class="logo-img">-->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.simple.partials.style')

</head>

<body class="ltr app horizontal landing-page">

    @include('frontend.simple.partials.switcher')

    @include('frontend.simple.partials.loader')

    <div class="page">
        <div class="page-main">

            @include('frontend.simple.partials.header')

            @yield('content')

            @include('frontend.simple.partials.footer')

        </div>
    </div>

    @include('frontend.simple.partials.script')

</body>
</html>