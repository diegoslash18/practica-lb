<x-lab-layout title="Crear cuenta">
    <div class="mini-brand">SERVER<span>LAB</span></div>
    <div class="eyebrow">PASO 1 DE 2 · REGISTRO</div>
    <h2 class="form-head">Crea tu cuenta.</h2>
    <p class="form-sub">Después de registrarte, deberás configurar Google Authenticator obligatoriamente.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label for="name">Nombre de usuario</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
        </div>
        @if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <label class="check-line">
                <input type="checkbox" name="terms" required>
                Acepto los <a href="{{ route('terms.show') }}" target="_blank">términos</a>
                y la <a href="{{ route('policy.show') }}" target="_blank">privacidad</a>.
            </label>
            @error('terms') <p class="form-error">{{ $message }}</p> @enderror
        @endif
        <button class="primary" type="submit">Registrarme y configurar OTP</button>
    </form>
    <p class="form-footer">¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
</x-lab-layout>
