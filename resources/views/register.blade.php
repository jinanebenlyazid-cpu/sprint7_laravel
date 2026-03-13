<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ONCF — Inscription</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
      --navy: #0a1628;
      --navy-mid: #162240;
      --sand: #b8864e;
      --sand-light: #f0e6d3;
      --cream: #faf8f4;
      --border: #e4eaf5;
      --text: #1a2540;
      --muted: #6b7a99;
      --danger: #e05555;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      background: var(--cream);
      display: flex; align-items: center; justify-content: center;
      padding: 2rem 1rem;
    }

    .register-wrap {
      width: 100%; max-width: 620px;
    }

    /* BRAND HEADER */
    .brand-header {
      text-align: center; margin-bottom: 2rem;
    }
    .brand-logo {
      display: inline-flex; align-items: center; gap: 12px;
      text-decoration: none; margin-bottom: 0.5rem;
    }
    .brand-icon-box {
      width: 46px; height: 46px; border-radius: 12px;
      background: linear-gradient(135deg, var(--sand), #8a5e2e);
      display: flex; align-items: center; justify-content: center;
      font-size: 20px; box-shadow: 0 6px 18px rgba(184,134,78,0.3);
    }
    .brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem; font-weight: 700; color: var(--navy); letter-spacing: 2px;
    }

    /* CARD */
    .register-card {
      background: white; border-radius: 24px;
      box-shadow: 0 20px 60px rgba(10,22,40,0.1);
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .card-header-custom {
      background: linear-gradient(135deg, var(--navy), #1e3a5f);
      padding: 1.75rem 2rem;
      position: relative; overflow: hidden;
    }
    .card-header-custom::after {
      content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
      background: repeating-linear-gradient(90deg, var(--sand) 0px, var(--sand) 20px, transparent 20px, transparent 36px);
      opacity: 0.5;
    }
    .card-header-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 4px;
    }
    .card-header-sub { font-size: 0.82rem; color: rgba(255,255,255,0.5); }

    .card-body-custom { padding: 2rem; }

    /* ALERT */
    .alert-error {
      background: #fdeaea; color: var(--danger); border: 1px solid #f5c2c2;
      border-radius: 12px; padding: 12px 16px; font-size: 0.85rem;
      margin-bottom: 1.5rem;
    }

    /* SECTION TITLE */
    .section-divider {
      display: flex; align-items: center; gap: 10px;
      margin: 1.5rem 0 1rem;
    }
    .section-divider-label {
      font-size: 0.65rem; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: var(--sand);
      white-space: nowrap;
    }
    .section-divider-line { flex: 1; height: 1px; background: var(--border); }

    /* GRID 2 COLONNES */
    .fields-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .fields-grid { grid-template-columns: 1fr; } }
    .fields-grid.full { grid-template-columns: 1fr; }

    /* FIELD */
    .field-group { display: flex; flex-direction: column; gap: 5px; }
    .field-label {
      font-size: 0.68rem; font-weight: 700;
      letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted);
    }
    .field-input-wrap { position: relative; }
    .field-icon {
      position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
      font-size: 0.95rem; pointer-events: none;
    }
    .field-input {
      width: 100%; padding: 12px 14px 12px 40px;
      border: 1.5px solid var(--border); border-radius: 11px;
      font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--text);
      background: var(--cream); outline: none;
      transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
    }
    .field-input:focus {
      border-color: var(--sand);
      box-shadow: 0 0 0 3px rgba(184,134,78,0.1);
      background: white;
    }
    .field-input.is-invalid { border-color: var(--danger); }
    .field-error { font-size: 0.72rem; color: var(--danger); }

    /* PASSWORD HINT */
    .password-hint { font-size: 0.7rem; color: var(--muted); margin-top: 4px; }

    /* TERMS */
    .terms-wrap {
      display: flex; align-items: flex-start; gap: 10px;
      background: var(--cream); border-radius: 12px;
      padding: 12px 14px; margin-top: 1.5rem; margin-bottom: 1.5rem;
      border: 1px solid var(--border);
    }
    .terms-wrap input { accent-color: var(--sand); margin-top: 2px; flex-shrink: 0; }
    .terms-text { font-size: 0.8rem; color: var(--muted); line-height: 1.5; }

    /* BOUTON */
    .btn-submit {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, var(--navy), var(--navy-mid));
      color: white; border: none; border-radius: 12px;
      font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 600;
      cursor: pointer; transition: all 0.3s;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      box-shadow: 0 6px 20px rgba(10,22,40,0.2);
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, var(--sand), #9a6d38);
      box-shadow: 0 8px 28px rgba(184,134,78,0.35);
      transform: translateY(-1px);
    }

    /* SWITCH LINK */
    .switch-link {
      text-align: center; font-size: 0.85rem; color: var(--muted);
      margin-top: 1.25rem;
    }
    .switch-link a { color: var(--sand); font-weight: 600; text-decoration: none; }
    .switch-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  <div class="register-wrap">

    {{-- BRAND --}}
    <div class="brand-header">
      <a href="{{ url('/') }}" class="brand-logo">
        <div class="brand-icon-box">🚆</div>
        <span class="brand-name">ONCF</span>
      </a>
    </div>

    <div class="register-card">

      <div class="card-header-custom">
        <div class="card-header-title">Créer un compte</div>
        <div class="card-header-sub">Rejoignez ONCF et réservez vos billets facilement</div>
      </div>

      <div class="card-body-custom">

        {{-- Erreurs globales --}}
        @if($errors->any())
          <div class="alert-error">
            ⚠️ Veuillez corriger les erreurs ci-dessous.
          </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
          @csrf

          {{-- IDENTITÉ --}}
          <div class="section-divider">
            <span class="section-divider-label">👤 Identité</span>
            <div class="section-divider-line"></div>
          </div>

          <div class="fields-grid">
            <div class="field-group">
              <label class="field-label">Nom</label>
              <div class="field-input-wrap">
                <span class="field-icon">🪪</span>
                <input type="text" name="nom" class="field-input {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                  placeholder="Ex: ALAOUI" value="{{ old('nom') }}" required>
              </div>
              @error('nom') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="field-group">
              <label class="field-label">Prénom</label>
              <div class="field-input-wrap">
                <span class="field-icon">✍️</span>
                <input type="text" name="prenom" class="field-input {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                  placeholder="Ex: Mohammed" value="{{ old('prenom') }}" required>
              </div>
              @error('prenom') <span class="field-error">{{ $message }}</span> @enderror
            </div>
          </div>

          {{-- CONTACT --}}
          <div class="section-divider">
            <span class="section-divider-label">📬 Contact</span>
            <div class="section-divider-line"></div>
          </div>

          <div class="fields-grid">
            <div class="field-group">
              <label class="field-label">Email</label>
              <div class="field-input-wrap">
                <span class="field-icon">📧</span>
                <input type="email" name="email" class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                  placeholder="email@exemple.com" value="{{ old('email') }}" required>
              </div>
              @error('email') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="field-group">
              <label class="field-label">Téléphone</label>
              <div class="field-input-wrap">
                <span class="field-icon">📱</span>
                <input type="text" name="tel" class="field-input {{ $errors->has('tel') ? 'is-invalid' : '' }}"
                  placeholder="06XXXXXXXX" value="{{ old('tel') }}" required>
              </div>
              @error('tel') <span class="field-error">{{ $message }}</span> @enderror
            </div>
          </div>

          {{-- ACCÈS --}}
          <div class="section-divider">
            <span class="section-divider-label">🔐 Accès</span>
            <div class="section-divider-line"></div>
          </div>

          <div class="fields-grid">
            <div class="field-group">
              <label class="field-label">Login</label>
              <div class="field-input-wrap">
                <span class="field-icon">👤</span>
                <input type="text" name="login" class="field-input {{ $errors->has('login') ? 'is-invalid' : '' }}"
                  placeholder="Choisir un login" value="{{ old('login') }}" required>
              </div>
              @error('login') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="field-group">
              <label class="field-label">Mot de passe</label>
              <div class="field-input-wrap">
                <span class="field-icon">🔒</span>
                <input type="password" name="password" class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                  placeholder="Min. 6 caractères" required>
              </div>
              @error('password') <span class="field-error">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="fields-grid full" style="margin-top:1rem">
            <div class="field-group">
              <label class="field-label">Confirmer le mot de passe</label>
              <div class="field-input-wrap">
                <span class="field-icon">🔑</span>
                <input type="password" name="password_confirmation" class="field-input"
                  placeholder="Répéter le mot de passe" required>
              </div>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            🚀 Créer mon compte
          </button>
        </form>

        <div class="switch-link">
          Déjà un compte ? <a href="{{ url('/login') }}">Se connecter</a>
        </div>

      </div>
    </div>
  </div>

</body>
</html>