<x-lab-layout title="Confirmar contraseña">
    <div class="mini-brand">SERVER<span>LAB</span></div>
    <div class="eyebrow">VERIFICACIÓN DE SEGURIDAD</div>
    <h2 class="form-head">Confirma tu contraseña.</h2>
    <p class="form-sub">Para proteger tu cuenta, necesitamos verificar tu contraseña antes de configurar OTP.</p>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="field">
            <label for="password">Contraseña actual</label>
            <input id="password" name="password" type="password" required autofocus autocomplete="current-password">
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <button class="primary" type="submit">Confirmar contraseña</button>
    </form>
</x-lab-layout>
