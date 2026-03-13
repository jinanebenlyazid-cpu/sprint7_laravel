@extends('master')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0a1628;
    --sand: #b8864e;
    --sand-light: #f0e6d3;
    --cream: #faf8f4;
    --border: #e4eaf5;
    --text: #1a2540;
    --muted: #6b7a99;
    --green: #2e9e6b;
  }

  body { background: var(--cream); font-family: 'DM Sans', sans-serif; }

  .success-hero {
    background: linear-gradient(135deg, #0d2b1a, var(--green));
    padding: 80px 0 50px; text-align: center;
    position: relative; overflow: hidden;
  }
  .success-hero::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px;
    background: repeating-linear-gradient(90deg, rgba(255,255,255,0.3) 0px, rgba(255,255,255,0.3) 30px, transparent 30px, transparent 50px);
  }
  .success-icon { font-size: 3.5rem; margin-bottom: 1rem; animation: popIn 0.6s cubic-bezier(0.34,1.56,0.64,1) both; }
  @keyframes popIn { from { transform:scale(0); opacity:0; } to { transform:scale(1); opacity:1; } }
  .success-title { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; color: white; margin-bottom: 0.5rem; }
  .success-sub { color: rgba(255,255,255,0.65); font-size: 0.92rem; margin-bottom: 1.25rem; }
  .commande-ref {
    display: inline-block;
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
    padding: 8px 22px; border-radius: 50px;
    color: white; font-size: 0.82rem; font-weight: 600; letter-spacing: 1.5px;
  }

  .billets-wrap { margin-top: -28px; padding-bottom: 80px; }

  .action-bar {
    background: white; border-radius: 16px; border: 1px solid var(--border);
    box-shadow: 0 8px 30px rgba(10,22,40,0.07);
    padding: 1.25rem 2rem; margin-bottom: 2rem;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
  }
  .action-bar-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: var(--navy); }
  .action-bar-sub { font-size: 0.8rem; color: var(--muted); margin-top: 2px; }
  .btn-print {
    display: flex; align-items: center; gap: 8px;
    padding: 11px 24px; background: var(--navy); color: white;
    border: none; border-radius: 50px; font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
    box-shadow: 0 4px 14px rgba(10,22,40,0.2);
  }
  .btn-print:hover { background: var(--sand); transform: translateY(-1px); }

  /* BILLET CARD */
  .billet-card {
    background: white; border-radius: 20px; border: 1.5px solid var(--border);
    box-shadow: 0 8px 40px rgba(10,22,40,0.08);
    margin-bottom: 1.5rem; overflow: hidden;
    animation: slideUp 0.4s ease both;
  }
  @keyframes slideUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
  .billet-card:nth-child(1) { animation-delay: 0.05s; }
  .billet-card:nth-child(2) { animation-delay: 0.10s; }
  .billet-card:nth-child(3) { animation-delay: 0.15s; }

  .billet-header {
    background: linear-gradient(135deg, var(--navy), #1e3a5f);
    padding: 1.25rem 1.75rem;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;
  }
  .billet-brand { display: flex; align-items: center; gap: 10px; }
  .brand-icon { width: 36px; height: 36px; border-radius: 9px; background: linear-gradient(135deg, var(--sand), #8a5e2e); display: flex; align-items: center; justify-content: center; font-size: 17px; }
  .brand-name { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: white; letter-spacing: 2px; }
  .brand-tagline { font-size: 0.58rem; color: rgba(255,255,255,0.5); letter-spacing: 2px; text-transform: uppercase; }
  .billet-num-wrap { text-align: right; }
  .billet-num-label { font-size: 0.6rem; color: rgba(255,255,255,0.5); letter-spacing: 2px; text-transform: uppercase; }
  .billet-num-val { font-size: 0.88rem; font-weight: 700; color: var(--sand); letter-spacing: 2px; }

  .billet-body { padding: 1.75rem 2rem; }

  .route-grid {
    display: grid; grid-template-columns: 1fr auto 1fr;
    align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;
  }
  .city-block { display: flex; flex-direction: column; gap: 3px; }
  .city-block.right { text-align: right; align-items: flex-end; }
  .city-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--muted); }
  .city-name { font-family: 'Playfair Display', serif; font-size: 1.7rem; font-weight: 700; color: var(--navy); line-height: 1; }
  .city-time { font-size: 0.88rem; font-weight: 600; color: var(--sand); margin-top: 3px; }

  .route-mid { display: flex; flex-direction: column; align-items: center; gap: 6px; }
  .route-track { display: flex; align-items: center; gap: 3px; }
  .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--sand); flex-shrink: 0; }
  .dashes { display: flex; gap: 3px; }
  .dash { width: 7px; height: 2px; background: var(--border); border-radius: 1px; }
  .route-badge { font-size: 0.6rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--green); background: #e6f7f0; padding: 3px 10px; border-radius: 50px; }

  .ticket-sep {
    display: flex; align-items: center; margin: 0 -2rem 1.5rem;
  }
  .sep-hole { width: 20px; height: 20px; border-radius: 50%; background: var(--cream); border: 1.5px solid var(--border); flex-shrink: 0; }
  .sep-line { flex: 1; border-top: 2px dashed var(--border); }
  .sep-icon { background: white; padding: 0 8px; font-size: 0.75rem; color: var(--muted); }

  .info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
  @media (max-width: 576px) { .info-grid { grid-template-columns: 1fr 1fr; } }
  .info-item { display: flex; flex-direction: column; gap: 3px; }
  .info-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
  .info-value { font-size: 0.92rem; font-weight: 600; color: var(--text); }
  .info-value.big { font-family: 'Playfair Display', serif; font-size: 1.05rem; color: var(--navy); }
  .info-value.ok { color: var(--green); font-weight: 700; }

  .billet-footer {
    background: var(--cream); border-top: 2px dashed var(--border);
    padding: 1rem 2rem;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;
  }
  .footer-ref { font-size: 0.75rem; color: var(--muted); line-height: 1.6; }
  .footer-ref strong { color: var(--navy); }
  .footer-prix { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; color: var(--navy); }
  .footer-prix small { font-size: 0.8rem; color: var(--sand); font-family: 'DM Sans', sans-serif; }

  /* EMPTY */
  .empty-billets { text-align: center; padding: 5rem 2rem; background: white; border-radius: 20px; border: 1.5px solid var(--border); }
  .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.3; }
  .empty-title { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--navy); margin-bottom: 0.5rem; }
  .empty-sub { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }

  .bottom-actions { display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }
  .btn-action {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 26px; border-radius: 50px;
    font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 600;
    text-decoration: none; transition: all 0.3s; cursor: pointer; border: none;
  }
  .btn-dark { background: var(--navy); color: white; box-shadow: 0 4px 14px rgba(10,22,40,0.2); }
  .btn-dark:hover { background: var(--sand); color: white; transform: translateY(-1px); }
  .btn-light { background: white; color: var(--navy); border: 1.5px solid var(--border); }
  .btn-light:hover { border-color: var(--navy); color: var(--navy); transform: translateY(-1px); }

  @media print {
    .action-bar, .bottom-actions, .success-hero, nav { display: none !important; }
    .billets-wrap { margin: 0; padding: 0; }
    body { background: white; }
    .billet-card { box-shadow: none; border: 1px solid #ccc; page-break-after: always; margin-bottom: 0; }
    .billet-card:last-child { page-break-after: avoid; }
  }
</style>

{{-- HERO --}}
<section class="success-hero">
  <div class="container">
    <div class="success-icon">🎉</div>
    <h1 class="success-title">Réservation confirmée !</h1>
    <p class="success-sub">Vos billets sont prêts. Bon voyage ! 🚆</p>
    <div class="commande-ref">
      Commande N° {{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
      &nbsp;·&nbsp;
      {{ \Carbon\Carbon::parse($commande->date_comm)->format('d/m/Y') }}
    </div>
  </div>
</section>

{{-- BILLETS --}}
<div class="billets-wrap">
  <div class="container">

    {{-- ACTION BAR --}}
    <div class="action-bar">
      <div>
        <div class="action-bar-title">🎫 Mes billets de train</div>
        <div class="action-bar-sub">
          {{ $commande->billets->count() }} billet{{ $commande->billets->count() > 1 ? 's' : '' }}
          &nbsp;·&nbsp; Total :
          <strong style="color:var(--navy)">
            {{ number_format($commande->billets->sum(fn($b) => $b->voyage->prixVoyage * $b->qte), 2) }} MAD
          </strong>
        </div>
      </div>
      <button class="btn-print" onclick="window.print()">🖨️ Imprimer</button>
    </div>

    {{-- BILLETS --}}
    @forelse($commande->billets as $billet)
    @php $voyage = $billet->voyage; @endphp

    <div class="billet-card">

      <div class="billet-header">
        <div class="billet-brand">
          <div class="brand-icon">🚆</div>
          <div>
            <div class="brand-name">ONCF</div>
            <div class="brand-tagline">Réseau Ferroviaire National</div>
          </div>
        </div>
        <div class="billet-num-wrap">
          <div class="billet-num-label">Billet N°</div>
          <div class="billet-num-val">{{ str_pad($billet->id, 8, '0', STR_PAD_LEFT) }}</div>
        </div>
      </div>

      <div class="billet-body">

        <div class="route-grid">
          <div class="city-block">
            <span class="city-label">Départ</span>
            <span class="city-name">{{ $voyage->villeDepart }}</span>
            <span class="city-time">🕐 {{ $voyage->heureDepart }}</span>
          </div>

          <div class="route-mid">
            <div class="route-track">
              <div class="dot"></div>
              <div class="dashes">@for($i=0;$i<5;$i++)<div class="dash"></div>@endfor</div>
              <span style="font-size:1.1rem">🚆</span>
              <div class="dashes">@for($i=0;$i<5;$i++)<div class="dash"></div>@endfor</div>
              <div class="dot"></div>
            </div>
            <span class="route-badge">✓ Direct</span>
          </div>

          <div class="city-block right">
            <span class="city-label">Arrivée</span>
            <span class="city-name">{{ $voyage->villeDarrivee }}</span>
            <span class="city-time">🕓 {{ $voyage->heureDarrivee }}</span>
          </div>
        </div>

        <div class="ticket-sep">
          <div class="sep-hole"></div>
          <div class="sep-line"></div>
          <span class="sep-icon">✂</span>
          <div class="sep-line"></div>
          <div class="sep-hole"></div>
        </div>

        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">Code voyage</span>
            <span class="info-value big">{{ $voyage->code_voyage }}</span>
          </div>
          <div class="info-item">
            <span class="info-label">Nombre de places</span>
            <span class="info-value big">{{ $billet->qte }} place{{ $billet->qte > 1 ? 's' : '' }}</span>
          </div>
          <div class="info-item">
            <span class="info-label">Date réservation</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($billet->created_at)->format('d/m/Y') }}</span>
          </div>
          <div class="info-item">
            <span class="info-label">N° Commande</span>
            <span class="info-value">{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</span>
          </div>
          <div class="info-item">
            <span class="info-label">Classe</span>
            <span class="info-value">2ème classe</span>
          </div>
          <div class="info-item">
            <span class="info-label">Statut</span>
            <span class="info-value ok">✓ Confirmé</span>
          </div>
        </div>

      </div>

      <div class="billet-footer">
        <div class="footer-ref">
          Réf : <strong>ONCF-{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}-{{ str_pad($billet->id, 4, '0', STR_PAD_LEFT) }}</strong><br>
          Émis le {{ \Carbon\Carbon::parse($billet->created_at)->format('d/m/Y à H:i') }}
        </div>
        <div class="footer-prix">
          {{ number_format($voyage->prixVoyage * $billet->qte, 2) }}<small> MAD</small>
        </div>
      </div>

    </div>
    @empty
    <div class="empty-billets">
      <div class="empty-icon">🎫</div>
      <div class="empty-title">Aucun billet trouvé</div>
      <p class="empty-sub">Cette commande ne contient pas de billets.</p>
      <a href="{{ url('/') }}" class="btn-action btn-dark">🏠 Accueil</a>
    </div>
    @endforelse

    @if($commande->billets->count() > 0)
    <div class="bottom-actions">
      <button class="btn-action btn-dark" onclick="window.print()">🖨️ Imprimer</button>
      <a href="{{ url('/') }}" class="btn-action btn-light">🏠 Accueil</a>
      <a href="{{ url('/rechercher') }}" class="btn-action btn-light">🔍 Nouveau voyage</a>
    </div>
    @endif

  </div>
</div>

@endsection