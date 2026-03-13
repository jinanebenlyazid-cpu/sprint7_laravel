@extends('master')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0a1628;
    --navy-mid: #162240;
    --sand: #b8864e;
    --sand-light: #f0e6d3;
    --cream: #faf8f4;
    --border: #e4eaf5;
    --text: #1a2540;
    --muted: #6b7a99;
    --green: #2e9e6b;
    --danger: #e05555;
  }

  body { background: var(--cream); font-family: 'DM Sans', sans-serif; }

  /* ── HERO ── */
  .pay-hero {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, #1a3a5c 100%);
    padding: 100px 0 55px;
    position: relative; overflow: hidden;
  }
  .pay-hero::before {
    content: '';
    position: absolute; width: 500px; height: 500px; border-radius: 50%;
    border: 1px solid rgba(184,134,78,0.1);
    top: -180px; right: -80px;
  }
  .pay-hero::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
    background: repeating-linear-gradient(90deg, var(--sand) 0px, var(--sand) 24px, transparent 24px, transparent 42px);
    opacity: 0.5;
  }
  .hero-label {
    font-size: 0.65rem; font-weight: 700; letter-spacing: 4px;
    text-transform: uppercase; color: var(--sand); margin-bottom: 10px;
    display: flex; align-items: center; gap: 8px;
  }
  .hero-label::before { content: ''; width: 20px; height: 1px; background: var(--sand); opacity: 0.6; }
  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700;
    color: white; margin-bottom: 0.5rem; line-height: 1.15;
  }
  .hero-title em { font-style: italic; color: var(--sand); }
  .hero-sub { font-size: 0.9rem; color: rgba(255,255,255,0.5); font-weight: 300; }

  /* STEPS */
  .steps-bar {
    display: flex; align-items: center; justify-content: center;
    gap: 0; margin-top: 2rem; position: relative; z-index: 1;
  }
  .step {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.35);
  }
  .step.active { color: white; }
  .step.done { color: var(--sand); }
  .step-circle {
    width: 26px; height: 26px; border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 700;
  }
  .step.active .step-circle { background: var(--sand); border-color: var(--sand); color: white; }
  .step.done .step-circle { background: rgba(184,134,78,0.2); border-color: var(--sand); color: var(--sand); }
  .step-line { width: 50px; height: 1px; background: rgba(255,255,255,0.15); margin: 0 6px; }

  /* ── LAYOUT ── */
  .pay-layout {
    padding: 50px 0 80px;
  }
  .pay-grid {
    display: grid; grid-template-columns: 1fr 380px; gap: 2rem; align-items: start;
  }
  @media (max-width: 900px) { .pay-grid { grid-template-columns: 1fr; } }

  /* ── CARD GÉNÉRIQUE ── */
  .pay-card {
    background: white; border-radius: 20px;
    border: 1.5px solid var(--border);
    box-shadow: 0 8px 32px rgba(10,22,40,0.07);
    overflow: hidden; margin-bottom: 1.25rem;
  }
  .pay-card-header {
    padding: 1.25rem 1.75rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
  }
  .pay-card-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--sand-light);
    display: flex; align-items: center; justify-content: center; font-size: 1rem;
  }
  .pay-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem; font-weight: 700; color: var(--navy);
  }
  .pay-card-body { padding: 1.5rem 1.75rem; }

  /* ── RÉSUMÉ COMMANDE ── */
  .order-item {
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem; padding: 1rem 0;
    border-bottom: 1px dashed var(--border);
  }
  .order-item:last-child { border-bottom: none; padding-bottom: 0; }

  .order-route {
    display: flex; align-items: center; gap: 8px;
    font-family: 'Playfair Display', serif;
    font-size: 1rem; font-weight: 700; color: var(--navy);
  }
  .order-arrow { color: var(--sand); font-size: 0.8rem; }
  .order-meta { font-size: 0.75rem; color: var(--muted); margin-top: 3px; }
  .order-qty {
    display: flex; align-items: center; gap: 6px;
    background: var(--sand-light); color: var(--sand);
    font-size: 0.75rem; font-weight: 700;
    padding: 4px 10px; border-radius: 50px;
  }
  .order-prix {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem; font-weight: 700; color: var(--navy); white-space: nowrap;
  }

  /* ── TOTAL ── */
  .total-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--navy), var(--navy-mid));
    border-radius: 0 0 18px 18px;
  }
  .total-label { font-size: 0.78rem; font-weight: 600; color: rgba(255,255,255,0.6); letter-spacing: 1px; text-transform: uppercase; }
  .total-value {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem; font-weight: 700; color: white;
  }
  .total-value small { font-size: 0.85rem; color: var(--sand); font-family: 'DM Sans', sans-serif; }

  /* ── MÉTHODE PAIEMENT ── */
  .method-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1.5rem; }

  .method-option { display: none; }
  .method-label {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
    padding: 1rem; border: 1.5px solid var(--border); border-radius: 14px;
    cursor: pointer; transition: all 0.25s; text-align: center;
    background: var(--cream);
  }
  .method-label:hover { border-color: var(--sand); background: #fdf6ee; }
  .method-option:checked + .method-label {
    border-color: var(--navy); background: white;
    box-shadow: 0 0 0 3px rgba(10,22,40,0.08);
  }
  .method-icon { font-size: 1.6rem; }
  .method-name { font-size: 0.8rem; font-weight: 600; color: var(--navy); }
  .method-sub { font-size: 0.65rem; color: var(--muted); }

  /* PANEL CARTE */
  .card-panel {
    display: none; padding-top: 1rem;
    border-top: 1px solid var(--border); margin-top: 0.5rem;
  }
  .card-panel.visible { display: block; }

  /* FIELD */
  .field-group { margin-bottom: 1rem; }
  .field-label {
    display: block; font-size: 0.68rem; font-weight: 700;
    letter-spacing: 1.5px; text-transform: uppercase;
    color: var(--muted); margin-bottom: 6px;
  }
  .field-wrap { position: relative; }
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
  .field-input:focus { border-color: var(--sand); box-shadow: 0 0 0 3px rgba(184,134,78,0.1); background: white; }
  .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }

  /* CARTE SIMULÉE */
  .card-preview {
    background: linear-gradient(135deg, var(--navy), #1e3a5f);
    border-radius: 14px; padding: 1.5rem;
    margin-bottom: 1.25rem; position: relative; overflow: hidden;
  }
  .card-preview::before {
    content: '';
    position: absolute; width: 200px; height: 200px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.05);
    top: -60px; right: -40px;
  }
  .cp-chip { font-size: 1.5rem; margin-bottom: 1rem; }
  .cp-number { font-size: 1.1rem; font-weight: 600; color: rgba(255,255,255,0.9); letter-spacing: 3px; margin-bottom: 1rem; }
  .cp-footer { display: flex; justify-content: space-between; align-items: flex-end; }
  .cp-holder-label { font-size: 0.6rem; color: rgba(255,255,255,0.4); letter-spacing: 1.5px; text-transform: uppercase; }
  .cp-holder-name { font-size: 0.85rem; font-weight: 600; color: white; margin-top: 2px; }
  .cp-logo { font-size: 1.8rem; }

  /* VIREMENT INFO */
  .virement-box {
    background: #f0f7ff; border: 1px solid #c8dff5;
    border-radius: 12px; padding: 1.25rem;
    display: none;
  }
  .virement-box.visible { display: block; }
  .virement-box p { font-size: 0.82rem; color: #2a5080; margin: 0 0 0.5rem; }
  .virement-box strong { color: var(--navy); }
  .virement-rib {
    background: white; border: 1px solid #c8dff5; border-radius: 8px;
    padding: 0.75rem 1rem; font-size: 0.82rem; font-weight: 600;
    color: var(--navy); letter-spacing: 1px; margin-top: 0.75rem;
    display: flex; align-items: center; gap: 8px;
  }

  /* ESPÈCES INFO */
  .especes-box {
    background: #f0faf5; border: 1px solid #b8e8d4;
    border-radius: 12px; padding: 1.25rem;
    display: none;
  }
  .especes-box.visible { display: block; }
  .especes-box p { font-size: 0.82rem; color: #1e6b47; margin: 0 0 0.5rem; }

  /* ── SIDEBAR ── */
  .sidebar-card {
    background: white; border-radius: 20px;
    border: 1.5px solid var(--border);
    box-shadow: 0 8px 32px rgba(10,22,40,0.07);
    overflow: hidden; position: sticky; top: 90px;
  }
  .sidebar-header {
    background: linear-gradient(135deg, var(--navy), var(--navy-mid));
    padding: 1.25rem 1.5rem;
  }
  .sidebar-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem; font-weight: 700; color: white;
  }
  .sidebar-sub { font-size: 0.72rem; color: rgba(255,255,255,0.45); margin-top: 2px; }

  .sidebar-body { padding: 1.25rem 1.5rem; }

  .summary-line {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.6rem 0; border-bottom: 1px solid var(--border);
    font-size: 0.82rem;
  }
  .summary-line:last-child { border-bottom: none; }
  .summary-line .label { color: var(--muted); }
  .summary-line .val { font-weight: 600; color: var(--navy); }

  .summary-total {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1rem 1.5rem;
    background: var(--sand-light);
    border-top: 1.5px solid var(--border);
  }
  .summary-total .label { font-size: 0.8rem; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: 1px; }
  .summary-total .val {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem; font-weight: 700; color: var(--navy);
  }

  /* BTN PAYER */
  .btn-payer {
    width: 100%; margin: 1.25rem 1.5rem 1.5rem;
    width: calc(100% - 3rem);
    padding: 15px;
    background: linear-gradient(135deg, var(--navy), var(--navy-mid));
    color: white; border: none; border-radius: 14px;
    font-family: 'DM Sans', sans-serif; font-size: 1rem; font-weight: 700;
    cursor: pointer; transition: all 0.3s;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    box-shadow: 0 6px 20px rgba(10,22,40,0.2);
  }
  .btn-payer:hover {
    background: linear-gradient(135deg, var(--sand), #9a6d38);
    box-shadow: 0 8px 28px rgba(184,134,78,0.35);
    transform: translateY(-1px);
  }

  /* SÉCURITÉ */
  .security-badges {
    display: flex; justify-content: center; gap: 1rem;
    padding: 0 1.5rem 1.25rem; flex-wrap: wrap;
  }
  .sec-badge {
    display: flex; align-items: center; gap: 4px;
    font-size: 0.68rem; color: var(--muted); font-weight: 500;
  }

  /* RETOUR */
  .btn-back {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.82rem; color: var(--muted); text-decoration: none;
    padding: 8px 14px; border-radius: 8px; transition: all 0.2s;
    margin-bottom: 1.5rem;
  }
  .btn-back:hover { background: white; color: var(--navy); }
</style>

{{-- HERO --}}
<section class="pay-hero">
  <div class="container">
    <div class="hero-label">ONCF · Réservation sécurisée</div>
    <h1 class="hero-title">Finaliser votre <em>paiement</em></h1>
    <p class="hero-sub">Vos billets seront générés immédiatement après confirmation.</p>

    <div class="steps-bar">
      <div class="step done">
        <div class="step-circle">✓</div>
        <span>Panier</span>
      </div>
      <div class="step-line"></div>
      <div class="step active">
        <div class="step-circle">2</div>
        <span>Paiement</span>
      </div>
      <div class="step-line"></div>
      <div class="step">
        <div class="step-circle">3</div>
        <span>Billets</span>
      </div>
    </div>
  </div>
</section>

{{-- CONTENU --}}
<div class="pay-layout">
  <div class="container">

    <a href="{{ url('/cart') }}" class="btn-back">← Retour au panier</a>

    <div class="pay-grid">

      {{-- COLONNE GAUCHE --}}
      <div>

        {{-- RÉSUMÉ COMMANDE --}}
        <div class="pay-card">
          <div class="pay-card-header">
            <div class="pay-card-icon">🧾</div>
            <div class="pay-card-title">Récapitulatif de la commande</div>
          </div>
          <div class="pay-card-body" style="padding-bottom:0">
            @foreach($cart as $id => $item)
            <div class="order-item">
              <div>
                <div class="order-route">
                  {{ $item['villeDepart'] }}
                  <span class="order-arrow">→</span>
                  {{ $item['villeDarrivee'] }}
                </div>
                <div class="order-meta">
                  🕐 {{ $item['heureDepart'] }} &nbsp;·&nbsp; 🕓 {{ $item['heureDarrivee'] }}
                  &nbsp;·&nbsp; {{ $item['code_voyage'] }}
                </div>
              </div>
              <div style="display:flex;align-items:center;gap:12px;flex-shrink:0">
                <span class="order-qty">× {{ $item['qte'] }}</span>
                <span class="order-prix">{{ number_format($item['prix'] * $item['qte'], 2) }} <small style="color:var(--sand);font-size:0.7rem">MAD</small></span>
              </div>
            </div>
            @endforeach
          </div>
          <div class="total-row">
            <span class="total-label">Total à payer</span>
            <span class="total-value">{{ number_format($total, 2) }}<small> MAD</small></span>
          </div>
        </div>

        {{-- MÉTHODE DE PAIEMENT --}}
        <div class="pay-card">
          <div class="pay-card-header">
            <div class="pay-card-icon">💳</div>
            <div class="pay-card-title">Mode de paiement</div>
          </div>
          <div class="pay-card-body">

            <div class="method-grid">
              <div>
                <input type="radio" name="methode" id="m_carte" value="carte" class="method-option" checked>
                <label for="m_carte" class="method-label">
                  <span class="method-icon">💳</span>
                  <span class="method-name">Carte bancaire</span>
                  <span class="method-sub">Visa · Mastercard</span>
                </label>
              </div>
              <div>
                <input type="radio" name="methode" id="m_virement" value="virement" class="method-option">
                <label for="m_virement" class="method-label">
                  <span class="method-icon">🏦</span>
                  <span class="method-name">Virement</span>
                  <span class="method-sub">Bancaire</span>
                </label>
              </div>
              <div>
                <input type="radio" name="methode" id="m_especes" value="especes" class="method-option">
                <label for="m_especes" class="method-label">
                  <span class="method-icon">💵</span>
                  <span class="method-name">Espèces</span>
                  <span class="method-sub">En guichet</span>
                </label>
              </div>
              <div>
                <input type="radio" name="methode" id="m_cmi" value="cmi" class="method-option">
                <label for="m_cmi" class="method-label">
                  <span class="method-icon">📱</span>
                  <span class="method-name">CMI Pay</span>
                  <span class="method-sub">Paiement mobile</span>
                </label>
              </div>
            </div>

            {{-- CARTE BANCAIRE --}}
            <div class="card-panel visible" id="panel_carte">
              <div class="card-preview">
                <div class="cp-chip">▬▬</div>
                <div class="cp-number" id="previewNum">•••• •••• •••• ••••</div>
                <div class="cp-footer">
                  <div>
                    <div class="cp-holder-label">Titulaire</div>
                    <div class="cp-holder-name" id="previewName">VOTRE NOM</div>
                  </div>
                  <div class="cp-logo">💳</div>
                </div>
              </div>

              <div class="field-group">
                <label class="field-label">Numéro de carte</label>
                <div class="field-wrap">
                  <span class="field-icon">💳</span>
                  <input type="text" id="cardNum" class="field-input" placeholder="1234 5678 9012 3456" maxlength="19">
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">Nom du titulaire</label>
                <div class="field-wrap">
                  <span class="field-icon">👤</span>
                  <input type="text" id="cardName" class="field-input" placeholder="MOHAMMED ALAOUI">
                </div>
              </div>
              <div class="field-row">
                <div class="field-group">
                  <label class="field-label">Date d'expiration</label>
                  <div class="field-wrap">
                    <span class="field-icon">📅</span>
                    <input type="text" class="field-input" placeholder="MM/AA" maxlength="5">
                  </div>
                </div>
                <div class="field-group">
                  <label class="field-label">CVV</label>
                  <div class="field-wrap">
                    <span class="field-icon">🔒</span>
                    <input type="password" class="field-input" placeholder="•••" maxlength="3">
                  </div>
                </div>
              </div>
            </div>

            {{-- VIREMENT --}}
            <div class="virement-box" id="panel_virement">
              <p>Effectuez un virement vers le compte ONCF suivant :</p>
              <div class="virement-rib">🏦 RIB : 007 780 0001234567890012 26</div>
              <p style="margin-top:0.75rem">Mentionnez votre <strong>nom complet</strong> en référence. Votre réservation sera confirmée sous 24h.</p>
            </div>

            {{-- ESPÈCES --}}
            <div class="especes-box" id="panel_especes">
              <p>💵 Rendez-vous au guichet ONCF le plus proche avec votre <strong>numéro de réservation</strong>.</p>
              <p>Vos billets seront émis sur place après règlement en espèces.</p>
            </div>

            {{-- CMI PAY --}}
            <div class="card-panel" id="panel_cmi">
              <div style="text-align:center;padding:1.5rem 0">
                <div style="font-size:3rem;margin-bottom:0.75rem">📱</div>
                <p style="font-size:0.88rem;color:var(--muted)">Vous serez redirigé vers la plateforme CMI Pay pour finaliser votre paiement de manière sécurisée.</p>
              </div>
            </div>

          </div>
        </div>

      </div>

      {{-- SIDEBAR --}}
      <div>
        <div class="sidebar-card">
          <div class="sidebar-header">
            <div class="sidebar-title">🎫 Votre commande</div>
            <div class="sidebar-sub">{{ count($cart) }} trajet{{ count($cart) > 1 ? 's' : '' }} · ONCF</div>
          </div>

          <div class="sidebar-body">
            @foreach($cart as $id => $item)
            <div class="summary-line">
              <span class="label">{{ $item['villeDepart'] }} → {{ $item['villeDarrivee'] }} ×{{ $item['qte'] }}</span>
              <span class="val">{{ number_format($item['prix'] * $item['qte'], 2) }}</span>
            </div>
            @endforeach
            <div class="summary-line">
              <span class="label">Frais de service</span>
              <span class="val" style="color:var(--green)">Gratuit</span>
            </div>
          </div>

          <div class="summary-total">
            <span class="label">Total</span>
            <span class="val">{{ number_format($total, 2) }} <small style="font-size:0.75rem;color:var(--sand);font-family:'DM Sans',sans-serif">MAD</small></span>
          </div>

          {{-- BOUTON PAYER --}}
          <div id="card-error" style="display:none;background:#fdeaea;color:#e05555;border:1px solid #f5c2c2;border-radius:10px;padding:10px 14px;font-size:0.82rem;font-weight:600;margin:0 1.5rem 0.75rem;text-align:center">
            ⚠️ Veuillez remplir toutes les informations de la carte.
          </div>
          <form action="{{ url('/paiement') }}" method="POST" id="payForm">
            @csrf
            <button type="submit" class="btn-payer" id="btnPayer">
              🔐 Confirmer & Payer {{ number_format($total, 2) }} MAD
            </button>
          </form>

          <div class="security-badges">
            <span class="sec-badge">🔒 SSL sécurisé</span>
            <span class="sec-badge">✅ Paiement crypté</span>
            <span class="sec-badge">🛡️ 100% sécurisé</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  // Switcher méthode paiement
  const panels = {
    carte:    { show: 'panel_carte',    type: 'card' },
    virement: { show: 'panel_virement', type: 'box' },
    especes:  { show: 'panel_especes',  type: 'box' },
    cmi:      { show: 'panel_cmi',      type: 'card' },
  };

  document.querySelectorAll('.method-option').forEach(radio => {
    radio.addEventListener('change', () => {
      document.querySelectorAll('.card-panel').forEach(p => p.classList.remove('visible'));
      document.querySelectorAll('.virement-box, .especes-box').forEach(p => p.classList.remove('visible'));
      const p = panels[radio.value];
      const el = document.getElementById(p.show);
      if (el) el.classList.add('visible');
      // Cacher erreur quand on change méthode
      document.getElementById('card-error').style.display = 'none';
    });
  });

  // Preview carte bancaire
  const cardNum  = document.getElementById('cardNum');
  const cardName = document.getElementById('cardName');
  const previewNum  = document.getElementById('previewNum');
  const previewName = document.getElementById('previewName');

  if (cardNum) {
    cardNum.addEventListener('input', (e) => {
      let val = e.target.value.replace(/\D/g, '').substring(0, 16);
      let formatted = val.match(/.{1,4}/g)?.join(' ') || val;
      e.target.value = formatted;
      previewNum.textContent = formatted || '•••• •••• •••• ••••';
    });
  }

  if (cardName) {
    cardName.addEventListener('input', (e) => {
      previewName.textContent = e.target.value.toUpperCase() || 'VOTRE NOM';
    });
  }

  // ✅ VALIDATION AVANT SOUMISSION
  document.getElementById('payForm').addEventListener('submit', function(e) {
    const methode = document.querySelector('.method-option:checked')?.value;

    if (methode === 'carte') {
      const num  = document.getElementById('cardNum')?.value.replace(/\s/g,'');
      const name = document.getElementById('cardName')?.value.trim();
      const exp  = document.querySelector('input[placeholder="MM/AA"]')?.value.trim();
      const cvv  = document.querySelector('input[placeholder="•••"]')?.value.trim();

      const errDiv = document.getElementById('card-error');

      if (!num || num.length < 16) {
        e.preventDefault();
        errDiv.textContent = '⚠️ Numéro de carte invalide (16 chiffres requis).';
        errDiv.style.display = 'block';
        document.getElementById('cardNum').focus();
        document.getElementById('cardNum').style.borderColor = '#e05555';
        return;
      }
      if (!name) {
        e.preventDefault();
        errDiv.textContent = '⚠️ Veuillez entrer le nom du titulaire.';
        errDiv.style.display = 'block';
        document.getElementById('cardName').focus();
        document.getElementById('cardName').style.borderColor = '#e05555';
        return;
      }
      if (!exp || exp.length < 5) {
        e.preventDefault();
        errDiv.textContent = '⚠️ Date d\'expiration invalide (MM/AA).';
        errDiv.style.display = 'block';
        return;
      }
      if (!cvv || cvv.length < 3) {
        e.preventDefault();
        errDiv.textContent = '⚠️ CVV invalide (3 chiffres requis).';
        errDiv.style.display = 'block';
        return;
      }

      // Tout OK — animation bouton
      const btn = document.getElementById('btnPayer');
      btn.textContent = '⏳ Traitement en cours...';
      btn.style.opacity = '0.7';
      btn.disabled = true;
    }
  });

  // Reset border color on input
  document.querySelectorAll('.field-input').forEach(input => {
    input.addEventListener('input', () => {
      input.style.borderColor = '';
      document.getElementById('card-error').style.display = 'none';
    });
  });
</script>

@endsection