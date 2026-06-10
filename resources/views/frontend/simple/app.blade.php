@php
$systemSetting = App\Models\Setting::first();
@endphp

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} | {{ $systemSetting->system_name ?? env('APP_NAME') }}</title>

    <meta name="description" content="{!! strip_tags($description ?? $systemSetting->description ?? '') !!}">
    <meta name="keywords" content="{!! strip_tags($keywords ?? $systemSetting->keywords ?? '') !!}">
    <meta name="author" content="{{ $author ?? $systemSetting->system_name ?? env('APP_NAME') }}">

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