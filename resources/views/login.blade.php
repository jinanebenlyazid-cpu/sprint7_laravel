<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ONCF — Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      display: grid;
      grid-template-columns: 1fr 1fr;
      background: var(--cream);
    }

    @media (max-width: 768px) {
      body { grid-template-columns: 1fr; }
      .left-panel { display: none; }
    }

    /* ── PANNEAU GAUCHE ── */
    .left-panel {
      background: linear-gradient(150deg, var(--navy) 0%, var(--navy-mid) 50%, #1a3a5c 100%);
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      padding: 3rem; position: relative; overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute; inset: 0;
      background:
        radial-gradient(circle at 20% 30%, rgba(184,134,78,0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(184,134,78,0.08) 0%, transparent 40%);
    }

    /* Rails décoratifs */
    .rails {
      position: absolute; bottom: 0; left: 0; right: 0; height: 4px;
      background: repeating-linear-gradient(
        90deg, var(--sand) 0px, var(--sand) 30px, transparent 30px, transparent 50px
      );
      opacity: 0.5;
    }

    /* Cercle décoratif */
    .deco-circle {
      position: absolute;
      width: 400px; height: 400px; border-radius: 50%;
      border: 1px solid rgba(184,134,78,0.12);
      top: -100px; right: -100px;
    }
    .deco-circle-2 {
      position: absolute;
      width: 250px; height: 250px; border-radius: 50%;
      border: 1px solid rgba(184,134,78,0.08);
      bottom: 50px; left: -80px;
    }

    .left-content { position: relative; z-index: 1; text-align: center; }

    .brand-logo {
      display: flex; align-items: center; justify-content: center; gap: 12px;
      margin-bottom: 3rem;
    }
    .brand-icon-box {
      width: 52px; height: 52px; border-radius: 14px;
      background: linear-gradient(135deg, var(--sand), #8a5e2e);
      display: flex; align-items: center; justify-content: center;
      font-size: 24px;
      box-shadow: 0 8px 24px rgba(184,134,78,0.35);
    }
    .brand-text-wrap { text-align: left; }
    .brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem; font-weight: 700; color: white; letter-spacing: 3px; line-height: 1;
    }
    .brand-tagline { font-size: 0.62rem; color: var(--sand); letter-spacing: 3px; text-transform: uppercase; font-weight: 500; }

    .left-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem; font-weight: 700; color: white; line-height: 1.25;
      margin-bottom: 1rem;
    }
    .left-title em { font-style: italic; color: var(--sand); }
    .left-desc { font-size: 0.9rem; color: rgba(255,255,255,0.5); font-weight: 300; line-height: 1.7; margin-bottom: 2.5rem; }

    /* Mini cards flottantes */
    .float-cards { display: flex; flex-direction: column; gap: 0.75rem; }
    .float-card {
      background: rgba(255,255,255,0.07);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px; padding: 0.9rem 1.25rem;
      display: flex; align-items: center; gap: 12px;
      animation: float 3s ease-in-out infinite alternate;
    }
    .float-card:nth-child(2) { animation-delay: 0.4s; margin-left: 1.5rem; }
    .float-card:nth-child(3) { animation-delay: 0.8s; margin-left: 0.75rem; }
    @keyframes float { from { transform: translateY(0); } to { transform: translateY(-5px); } }

    .fc-icon { font-size: 1.2rem; }
    .fc-text { text-align: left; }
    .fc-route { font-size: 0.82rem; font-weight: 600; color: white; }
    .fc-info { font-size: 0.68rem; color: rgba(255,255,255,0.45); }

    /* ── PANNEAU DROIT (FORMULAIRE) ── */
    .right-panel {
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      padding: 3rem 2rem; overflow-y: auto;
    }

    .form-wrap { width: 100%; max-width: 420px; }

    .form-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem; font-weight: 700; color: var(--navy);
      margin-bottom: 0.4rem;
    }
    .form-subtitle { font-size: 0.88rem; color: var(--muted); margin-bottom: 2rem; }

    /* ALERT */
    .alert-error {
      background: #fdeaea; color: var(--danger); border: 1px solid #f5c2c2;
      border-radius: 12px; padding: 12px 16px; font-size: 0.85rem; font-weight: 500;
      margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;
    }
    .alert-success-msg {
      background: #e6f7f0; color: #2e9e6b; border: 1px solid #b8e8d4;
      border-radius: 12px; padding: 12px 16px; font-size: 0.85rem; font-weight: 500;
      margin-bottom: 1.5rem;
    }

    /* FIELD */
    .field-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 1.1rem; }
    .field-label {
      font-size: 0.7rem; font-weight: 700;
      letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted);
    }
    .field-input-wrap { position: relative; }
    .field-icon {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      font-size: 1rem; pointer-events: none;
    }
    .field-input {
      width: 100%; padding: 13px 16px 13px 42px;
      border: 1.5px solid var(--border); border-radius: 12px;
      font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--text);
      background: white; outline: none;
      transition: border-color 0.25s, box-shadow 0.25s;
    }
    .field-input:focus { border-color: var(--sand); box-shadow: 0 0 0 3px rgba(184,134,78,0.1); }
    .field-input.is-invalid { border-color: var(--danger); }
    .field-error { font-size: 0.75rem; color: var(--danger); margin-top: 3px; }

    /* REMEMBER + FORGOT */
    .form-options {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.5rem;
    }
    .remember-label { display: flex; align-items: center; gap: 8px; font-size: 0.82rem; color: var(--muted); cursor: pointer; }
    .remember-label input { accent-color: var(--sand); width: 14px; height: 14px; }
    .forgot-link { font-size: 0.82rem; color: var(--sand); text-decoration: none; font-weight: 500; }
    .forgot-link:hover { text-decoration: underline; }

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

    /* DIVIDER */
    .divider {
      display: flex; align-items: center; gap: 12px;
      margin: 1.5rem 0; color: var(--muted); font-size: 0.78rem;
    }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    /* SWITCH LINK */
    .switch-link {
      text-align: center; font-size: 0.85rem; color: var(--muted);
    }
    .switch-link a { color: var(--sand); font-weight: 600; text-decoration: none; }
    .switch-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  {{-- PANNEAU GAUCHE --}}
  <div class="left-panel">
    <div class="deco-circle"></div>
    <div class="deco-circle-2"></div>
    <div class="rails"></div>

    <div class="left-content">
      <a href="{{ url('/') }}" style="text-decoration: none;" class="brand-logo">
        <div class="brand-icon-box">🚆</div>
        <div class="brand-text-wrap">
          <div class="brand-name">ONCF</div>
          <div class="brand-tagline">Réseau National</div>
        </div>
</a>

      <h2 class="left-title">Voyagez à travers<br>le <em>Maroc</em> en train</h2>
      <p class="left-desc">Connectez-vous pour réserver vos billets,<br>gérer vos voyages et imprimer vos billets.</p>

      <div class="float-cards">
        <div class="float-card">
          <span class="fc-icon">🚆</span>
          <div class="fc-text">
            <div class="fc-route">Rabat → Casablanca</div>
            <div class="fc-info">08:00 › 09:30 &nbsp;·&nbsp; 80 MAD</div>
          </div>
        </div>
        <div class="float-card">
          <span class="fc-icon">🚆</span>
          <div class="fc-text">
            <div class="fc-route">Casablanca → Marrakech</div>
            <div class="fc-info">10:00 › 12:00 &nbsp;·&nbsp; 120 MAD</div>
          </div>
        </div>
        <div class="float-card">
          <span class="fc-icon">🚆</span>
          <div class="fc-text">
            <div class="fc-route">Fès → Tanger</div>
            <div class="fc-info">07:00 › 10:30 &nbsp;·&nbsp; 95 MAD</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- PANNEAU DROIT --}}
  <div class="right-panel">
    <div class="form-wrap">

      <h1 class="form-title">Connexion</h1>
      <p class="form-subtitle">Bienvenue ! Entrez vos identifiants pour continuer.</p>

      {{-- Alertes --}}
      @if(session('success'))
        <div class="alert-success-msg">{{ session('success') }}</div>
      @endif

      @if($errors->has('login'))
        <div class="alert-error">⚠️ {{ $errors->first('login') }}</div>
      @endif

      <form action="{{ url('/login') }}" method="POST">
        @csrf

        <div class="field-group">
          <label class="field-label">Login</label>
          <div class="field-input-wrap">
            <span class="field-icon">👤</span>
            <input type="text" name="login" class="field-input {{ $errors->has('login') ? 'is-invalid' : '' }}"
              placeholder="Votre login" value="{{ old('login') }}" required autofocus>
          </div>
        </div>

        <div class="field-group">
          <label class="field-label">Mot de passe</label>
          <div class="field-input-wrap">
            <span class="field-icon">🔒</span>
            <input type="password" name="password" class="field-input"
              placeholder="Votre mot de passe" required>
          </div>
        </div>

        <div class="form-options">
          <label class="remember-label">
            <input type="checkbox" name="remember"> Se souvenir de moi
          </label>
        </div>

        <button type="submit" class="btn-submit">
          🔑 Se connecter
        </button>
      </form>

      <div class="divider">ou</div>

      <div class="switch-link">
        Pas encore de compte ? <a href="{{ url('/register') }}">Créer un compte</a>
      </div>

    </div>
  </div>

</body>
</html>