@php
    $ip = request()->server('SERVER_ADDR', '');
    $host = strtolower(gethostname() ?: '');

    $pagina = match (true) {
        $ip === '192.168.10.13' || str_contains($host, 'rocky03') => 'Page 1',
        $ip === '192.168.10.14' || str_contains($host, 'rocky04') => 'Page 2',
        default => 'Servidor desconocido',
    };

    $ipPrivada = match ($pagina) {
        'Page 1' => '192.168.10.13',
        'Page 2' => '192.168.10.14',
        default => $ip,
    };
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f4f5f7;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .card {
            width: min(90%, 580px);
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        header {
            padding: 24px 30px;
            border-bottom: 1px solid #ddd;
            font-size: 26px;
        }

        main {
            padding: 35px 30px 45px;
        }

        p {
            margin: 0;
            font-size: 22px;
        }

        h1 {
            text-align: center;
            font-size: 56px;
            margin: 35px 0 12px;
        }

        .ip {
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        footer {
            border-top: 1px solid #eee;
            padding: 20px 30px;
            text-align: right;
        }

        button {
            background: white;
            border: 1px solid #ccc;
            padding: 10px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="card">
        <header>Bienvenido</header>

        <main>
            <p>Estás en</p>
            <h1>{{ $pagina }}</h1>
            <div class="ip">{{ $ipPrivada }}</div>
        </main>

        <footer>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </footer>
    </div>
</body>
</html>
