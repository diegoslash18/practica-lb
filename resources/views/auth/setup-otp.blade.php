<x-lab-layout title="Configurar OTP" mode="wide">
    <header class="page-header">
        <div class="logo"><span class="logo-mark">S</span> SERVER<span>LAB</span></div>
        <span class="pill">REGISTRO PROTEGIDO</span>
    </header>

    <div class="eyebrow">PASO 2 DE 2 · SEGURIDAD</div>
    <h1 class="page-title">Configura tu autenticador.</h1>
    <p class="page-desc">
        La configuración OTP es obligatoria. Activa Google Authenticator,
        escanea el QR y confirma el código de seis dígitos.
    </p>

    <div class="setup-panel">
        @livewire('profile.two-factor-authentication-form')
    </div>

    <a class="primary" style="max-width:310px" href="{{ route('dashboard') }}">
        Continuar al dashboard →
    </a>
    <p class="footer-note">
        El dashboard seguirá bloqueado hasta que hayas confirmado el OTP.
        Guarda los códigos de recuperación en un lugar seguro.
    </p>
</x-lab-layout>
