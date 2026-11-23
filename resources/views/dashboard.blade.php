@php
    $host = strtolower(gethostname() ?: 'desconocido');
    $page = str_contains($host, 'rocky03') ? 1 : (str_contains($host, 'rocky04') ? 2 : 0);
@endphp

<x-lab-layout title="Dashboard" mode="wide">
    <header class="page-header">
        <div class="logo"><span class="logo-mark">S</span> SERVER<span>LAB</span></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="secondary-btn" type="submit">Cerrar sesión</button>
        </form>
    </header>

    <div class="eyebrow">PANEL DE INFRAESTRUCTURA</div>
    <h1 class="page-title">Hola, {{ auth()->user()->name }}.</h1>
    <p class="page-desc">
        Tu sesión está protegida con contraseña y OTP.
        Observa cómo Nginx distribuye las solicitudes entre nuestros servidores Laravel.
    </p>

    <div class="stats">
        <div class="stat">
            <div class="stat-label">Servidor de esta página</div>
            <div class="stat-value">{{ $page ? 'PAGE '.$page : $host }}</div>
            <div class="stat-note">{{ $host }} · Rocky Linux</div>
        </div>
        <div class="stat">
            <div class="stat-label">Última solicitud</div>
            <div class="stat-value" id="last-server">Conectando...</div>
            <div class="stat-note" id="last-time">Consultando infraestructura</div>
        </div>
        <div class="stat">
            <div class="stat-label">Estado de la sesión</div>
            <div class="stat-value" style="color:#6ee7b7">Protegida</div>
            <div class="stat-note">Contraseña + OTP confirmado</div>
        </div>
    </div>

    <div class="lab-row">
        <div class="node" id="node1">
            <div class="eyebrow">NODO WEB 01</div>
            <strong>PAGE 1</strong>
            <div class="stat-note">Rocky03 · Laravel / PHP-FPM</div>
            <div class="node-count" id="count1">0</div>
            <small>Solicitudes recibidas en esta prueba</small>
        </div>
        <div class="node" id="node2">
            <div class="eyebrow">NODO WEB 02</div>
            <strong>PAGE 2</strong>
            <div class="stat-note">Rocky04 · Laravel / PHP-FPM</div>
            <div class="node-count" id="count2">0</div>
            <small>Solicitudes recibidas en esta prueba</small>
        </div>
    </div>

    <p class="footer-note" id="monitor-status">
        El monitor comprueba automáticamente el balanceo cada 3.5 segundos.
        Los contadores comienzan en cero al abrir esta página.
    </p>

    <script>
    (() => {
        const counts = {1: 0, 2: 0};

        async function checkServer() {
            try {
                const response = await fetch(@json(route('lab.status')), {
                    credentials: 'same-origin',
                    cache: 'no-store',
                    headers: {'Accept': 'application/json'}
                });

                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }

                const data = await response.json();
                const page = Number(data.page);

                document.getElementById('last-server').textContent =
                    page ? 'PAGE ' + page : data.hostname;

                document.getElementById('last-time').textContent =
                    'Respondió: ' + data.hostname;

                if (page === 1 || page === 2) {
                    counts[page]++;
                    document.getElementById('count' + page).textContent = counts[page];
                }

                document.getElementById('node1').classList.toggle('active', page === 1);
                document.getElementById('node2').classList.toggle('active', page === 2);

                document.getElementById('monitor-status').textContent =
                    'Monitor activo · Última actualización: ' +
                    new Date().toLocaleTimeString('es-MX');
            } catch (error) {
                document.getElementById('monitor-status').textContent =
                    'No se pudo consultar el balanceador: ' + error.message;
            }
        }

        checkServer();
        setInterval(checkServer, 3500);
    })();
    </script>
</x-lab-layout>
