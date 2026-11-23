@props(['title' => 'ServerLab', 'mode' => 'auth'])
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080f1e">
    <title>{{ $title }} | ServerLab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('serverlab.css') }}">
    @livewireStyles
</head>
<body class="{{ $mode === 'auth' ? 'auth-screen' : 'page-screen' }}">
    @if($mode === 'auth')
        <aside class="visual">
            <div class="logo"><span class="logo-mark">S</span> SERVER<span>LAB</span></div>
            <div class="visual-center">
                <div class="eyebrow">ROCKY LINUX · NGINX · LARAVEL</div>
                <h1>Una sesión.<br><em>Dos servidores.</em></h1>
                <p>Infraestructura distribuida con autenticación de dos factores, sesiones compartidas y balanceo de carga.</p>
                <div class="server-diagram">
                    <span>CLIENTE</span><b>→</b><span>NGINX</span><b>→</b>
                    <div><span>PAGE 1</span><span>PAGE 2</span></div>
                </div>
            </div>
            <div class="visual-footer"><span class="online-dot"></span> ENTORNO DE LABORATORIO ACTIVO</div>
        </aside>
    @endif

    <main class="form-zone">
        <div class="frame">
            {{ $slot }}
        </div>
    </main>
    @stack('modals')
    @livewireScripts
</body>
</html>
