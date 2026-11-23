<x-lab-layout title="Verificar identidad">
    <div class="mini-brand">SERVER<span>LAB</span></div>
    <div class="eyebrow">SEGUNDO FACTOR</div>
    <h2 class="form-head">Verifica tu identidad.</h2>
    <p class="form-sub">Abre Google Authenticator e introduce tu código temporal de seis dígitos.</p>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <div class="field">
            <label for="code">Código OTP</label>
            <input id="code" type="text" name="code" inputmode="numeric"
                   pattern="[0-9]{6}" maxlength="6" autocomplete="one-time-code"
                   placeholder="000000" required autofocus>
            @error('code') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <button class="primary" type="submit">Verificar y acceder</button>
    </form>

    <p class="form-footer">¿Perdiste tu autenticador? Usa un código de recuperación:</p>
    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <div class="field">
            <input name="recovery_code" type="text" placeholder="Código de recuperación" required>
            @error('recovery_code') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <button class="secondary-btn" type="submit">Ingresar con código de recuperación</button>
    </form>
</x-lab-layout>
