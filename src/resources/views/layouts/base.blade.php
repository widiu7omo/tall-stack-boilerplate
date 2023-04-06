@props(['title'=>config('filament.brand')])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    Fav Icon--}}
    @if ($favicon = config('filament.favicon'))
        <link rel="icon" href="{{ $favicon }}">
    @endif
    {{--    Title--}}
    <title>{{ isset($title) ? "$title - " : null }} {{ config('filament.brand') }}</title>
    {{--    Dark Mode--}}
    @if (config('filament.dark_mode'))
        <script>
            const theme = localStorage.getItem('theme')

            if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            }
        </script>
    @endif
    <!-- Fonts -->
    @if (filled($fontsUrl = config('filament.google_fonts')))
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{ $fontsUrl }}" rel="stylesheet"/>
    @else
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @endif
    {{--    Alpine XCloak--}}
    <style>
        [x-cloak=""], [x-cloak="x-cloak"], [x-cloak="1"] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak="-lg"] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak="lg"] {
                display: none !important;
            }
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{ $slot }}
</div>
@livewireScripts
</body>
</html>
