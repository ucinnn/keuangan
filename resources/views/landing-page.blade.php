<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-6">
        <h1 class="text-3xl font-bold">
            <center>Selamat Datang di Sistem Keuangan Yayasan Nurul Huda</center>
        </h1>
    </header>
    <main class="p-6">
        <section class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">
                <center>Silahkan login sesuai posisi anda</center>
            </h2>
        </section>
        <br><br>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-2">Admin</h3>
                <form action="{{ route('admin.login') }}">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-2">TU PUSAT</h3>
                <form action="{{ route('tupusat.login') }}">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-2">TU UNIT</h3>
                <form action="{{ route('tuunit.login') }}">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </main>
    <div class="fixed bottom-0 w-full">
        <footer class="bg-blue-600 text-white text-center p-4">
            <p>copyright &copy; {{ date('Y') }} Yayasan Nurul Huda</p>
        </footer>
    </div>

</body>

</html>
