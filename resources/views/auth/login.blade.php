<x-lab-layout title="Iniciar sesión">
    <div class="mini-brand">SERVER<span>LAB</span></div>
    <div class="eyebrow">ACCESO SEGURO</div>
    <h2 class="form-head">Bienvenido de nuevo.</h2>
    <p class="form-sub">Ingresa tus credenciales para continuar con la verificación de dos factores.</p>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
                   autocomplete="username" placeholder="usuario@ejemplo.com" required autofocus>
            @error('email') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password"
                   autocomplete="current-password" placeholder="Tu contraseña" required>
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <label class="check-line"><input type="checkbox" name="remember"> Mantener sesión iniciada</label>
        <button class="primary" type="submit">Continuar de forma segura</button>
    </form>
    <p class="form-footer">¿No tienes cuenta? <a href="{{ route('register') }}">Crear una cuenta</a></p>
</x-lab-layout>
