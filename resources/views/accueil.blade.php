@extends('master')

@section('content')

{{-- TOAST --}}
@if(session('error'))
<div id="toastErr" style="position:fixed;top:86px;left:50%;transform:translateX(-50%);background:#fdeaea;color:#e05555;border:1px solid #f5c2c2;border-radius:12px;padding:12px 24px;font-size:.88rem;font-weight:600;z-index:9999;box-shadow:0 4px 20px rgba(0,0,0,.1);white-space:nowrap;display:flex;align-items:center;gap:8px;animation:slideDown .3s ease">
  {{ session('error') }}
  <span onclick="this.parentElement.remove()" style="cursor:pointer;opacity:.6;margin-left:8px">✕</span>
</div>
<style>@keyframes slideDown{from{opacity:0;top:70px}to{opacity:1;top:86px}}</style>
<script>setTimeout(()=>{const t=document.getElementById('toastErr');if(t)t.remove();},4000);</script>
@endif

@if(session('success'))
<div id="toastOk" style="position:fixed;top:86px;left:50%;transform:translateX(-50%);background:#e6f7f0;color:#2e9e6b;border:1px solid #b8e8d4;border-radius:12px;padding:12px 24px;font-size:.88rem;font-weight:600;z-index:9999;box-shadow:0 4px 20px rgba(0,0,0,.1);white-space:nowrap;display:flex;align-items:center;gap:8px;animation:slideDown .3s ease">
  {{ session('success') }}
  <span onclick="this.parentElement.remove()" style="cursor:pointer;opacity:.6;margin-left:8px">✕</span>
</div>
<script>setTimeout(()=>{const t=document.getElementById('toastOk');if(t)t.remove();},4000);</script>
@endif

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
  }

  body { background: var(--cream); font-family: 'DM Sans', sans-serif; }

  /* ── HERO ── */
  .home-hero {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 55%, #1a3a5c 100%);
    min-height: 520px;
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    padding: 100px 0 80px;
  }

  /* Cercles décoratifs */
  .home-hero::before {
    content: '';
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    border: 1px solid rgba(184,134,78,0.1);
    top: -200px; right: -100px;
  }
  .home-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0; height: 4px;
    background: repeating-linear-gradient(
      90deg, var(--sand) 0px, var(--sand) 30px, transparent 30px, transparent 50px
    );
    opacity: 0.6;
  }

  .hero-inner {
    position: relative; z-index: 1;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center;
  }
  @media (max-width: 768px) {
    .hero-inner { grid-template-columns: 1fr; gap: 2rem; }
    .hero-visual { display: none; }
  }

  .hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.68rem; letter-spacing: 4px; text-transform: uppercase;
    color: var(--sand); font-weight: 600; margin-bottom: 1.25rem;
  }
  .hero-label::before { content: ''; width: 24px; height: 1px; background: var(--sand); opacity: 0.6; }

  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 5vw, 3.8rem);
    font-weight: 700; line-height: 1.1; color: white;
    margin-bottom: 1.25rem;
  }
  .hero-title em { font-style: italic; color: var(--sand); }

  .hero-desc {
    font-size: 1rem; color: rgba(255,255,255,0.6);
    font-weight: 300; line-height: 1.7; margin-bottom: 2rem;
    max-width: 420px;
  }

  .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }

  .btn-hero-primary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 13px 28px;
    background: linear-gradient(135deg, var(--sand), #9a6d38);
    color: white; text-decoration: none; border-radius: 50px;
    font-weight: 600; font-size: 0.92rem;
    box-shadow: 0 6px 20px rgba(184,134,78,0.35);
    transition: all 0.3s;
  }
  .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(184,134,78,0.5); color: white; }

  .btn-hero-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 13px 28px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    color: white; text-decoration: none; border-radius: 50px;
    font-weight: 500; font-size: 0.92rem;
    transition: all 0.3s;
  }
  .btn-hero-secondary:hover { background: rgba(255,255,255,0.15); color: white; }

  /* STATS */
  .hero-stats {
    display: flex; gap: 2rem; margin-top: 2.5rem;
    padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);
  }
  .stat-item { display: flex; flex-direction: column; gap: 2px; }
  .stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem; font-weight: 700; color: white; line-height: 1;
  }
  .stat-num span { color: var(--sand); }
  .stat-label { font-size: 0.72rem; color: rgba(255,255,255,0.5); letter-spacing: 1px; text-transform: uppercase; }

  /* HERO VISUAL (right side) */
  .hero-visual {
    display: flex; flex-direction: column; gap: 1rem;
  }
  .hero-card {
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 16px; padding: 1.25rem 1.5rem;
    animation: floatCard 3s ease-in-out infinite alternate;
  }
  .hero-card:nth-child(2) { margin-left: 2rem; animation-delay: 0.5s; }
  .hero-card:nth-child(3) { margin-left: 1rem; animation-delay: 1s; }

  @keyframes floatCard {
    from { transform: translateY(0); }
    to   { transform: translateY(-6px); }
  }

  .hcard-route {
    display: flex; align-items: center; gap: 10px;
    font-family: 'Playfair Display', serif;
    font-size: 1rem; font-weight: 700; color: white; margin-bottom: 6px;
  }
  .hcard-arrow { color: var(--sand); }
  .hcard-meta { font-size: 0.75rem; color: rgba(255,255,255,0.5); display: flex; gap: 12px; }
  .hcard-prix { color: var(--sand); font-weight: 600; }

  /* ── SECTION VOYAGES ── */
  .voyages-section { padding: 70px 0 80px; }

  .section-header {
    display: flex; align-items: flex-end; justify-content: space-between;
    margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;
  }
  .section-label {
    font-size: 0.68rem; font-weight: 600; letter-spacing: 3px;
    text-transform: uppercase; color: var(--sand); margin-bottom: 6px;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: var(--navy); margin: 0;
  }
  .section-count {
    background: var(--sand-light); color: var(--sand);
    font-size: 0.8rem; font-weight: 600;
    padding: 6px 16px; border-radius: 50px;
    white-space: nowrap;
  }

  /* FILTER BAR */
  .filter-bar {
    display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem;
  }
  .filter-btn {
    padding: 7px 18px; border-radius: 50px;
    border: 1.5px solid var(--border); background: white;
    font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 500;
    color: var(--muted); cursor: pointer; transition: all 0.25s;
  }
  .filter-btn:hover, .filter-btn.active {
    border-color: var(--navy); background: var(--navy); color: white;
  }

  /* VOYAGE GRID */
  .voyages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 1.25rem;
  }

  /* VOYAGE CARD */
  .voyage-card {
    background: white; border-radius: 18px;
    border: 1.5px solid var(--border);
    overflow: hidden; transition: all 0.3s;
    animation: fadeUp 0.4s ease both;
    position: relative;
  }
  .voyage-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 50px rgba(10,22,40,0.12);
    border-color: var(--sand);
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .voyage-card:nth-child(1) { animation-delay: 0.05s; }
  .voyage-card:nth-child(2) { animation-delay: 0.10s; }
  .voyage-card:nth-child(3) { animation-delay: 0.15s; }
  .voyage-card:nth-child(4) { animation-delay: 0.20s; }
  .voyage-card:nth-child(5) { animation-delay: 0.25s; }
  .voyage-card:nth-child(6) { animation-delay: 0.30s; }

  /* Bande colorée */
  .voyage-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--sand), var(--navy));
  }

  .card-header {
    padding: 1.25rem 1.5rem 0;
    display: flex; align-items: center; justify-content: space-between;
  }
  .card-code {
    font-size: 0.65rem; font-weight: 700; letter-spacing: 3px;
    text-transform: uppercase; color: var(--sand);
    background: var(--sand-light); padding: 4px 10px; border-radius: 50px;
  }
  .card-badge-direct {
    font-size: 0.62rem; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: var(--green);
    background: #e6f7f0; padding: 4px 10px; border-radius: 50px;
  }

  .card-route {
    padding: 1rem 1.5rem;
    display: grid; grid-template-columns: 1fr auto 1fr;
    align-items: center; gap: 1rem;
  }
  .card-city { display: flex; flex-direction: column; gap: 2px; }
  .card-city-label { font-size: 0.6rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
  .card-city-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem; font-weight: 700; color: var(--navy); line-height: 1.1;
  }
  .card-city-time { font-size: 0.8rem; font-weight: 500; color: var(--muted); margin-top: 2px; }

  .card-arrow {
    display: flex; flex-direction: column; align-items: center; gap: 4px;
  }
  .arrow-line {
    width: 50px; height: 2px; position: relative;
    background: linear-gradient(90deg, var(--border), var(--sand), var(--border));
  }
  .arrow-icon { font-size: 0.7rem; color: var(--sand); }

  .card-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem;
  }
  .card-prix {
    display: flex; flex-direction: column; gap: 1px;
  }
  .prix-label { font-size: 0.6rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
  .prix-value {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem; font-weight: 700; color: var(--navy); line-height: 1;
  }
  .prix-mad { font-size: 0.75rem; color: var(--sand); font-weight: 600; }

  .btn-card-reserver {
    display: flex; align-items: center; gap: 6px;
    padding: 9px 18px; background: var(--navy); color: white;
    border: none; border-radius: 50px; text-decoration: none;
    font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s; white-space: nowrap;
  }
  .btn-card-reserver:hover { background: var(--sand); color: white; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(184,134,78,0.35); }

  /* EMPTY */
  .empty-state {
    grid-column: 1 / -1; text-align: center; padding: 4rem 2rem;
  }
  .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.3; }
  .empty-title { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--navy); margin-bottom: 0.5rem; }
  .empty-sub { color: var(--muted); font-size: 0.9rem; }

  /* CTA BAND */
  .cta-band {
    background: linear-gradient(135deg, var(--navy), #1e3a5f);
    padding: 60px 0; text-align: center; position: relative; overflow: hidden;
  }
  .cta-band::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 50%, rgba(184,134,78,0.1) 0%, transparent 60%);
  }
  .cta-content { position: relative; z-index: 1; }
  .cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; color: white;
    margin-bottom: 0.75rem;
  }
  .cta-sub { color: rgba(255,255,255,0.55); font-size: 0.95rem; margin-bottom: 1.75rem; }
  .btn-cta {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 14px 32px;
    background: linear-gradient(135deg, var(--sand), #9a6d38);
    color: white; text-decoration: none; border-radius: 50px;
    font-weight: 600; font-size: 0.95rem;
    box-shadow: 0 6px 20px rgba(184,134,78,0.35);
    transition: all 0.3s;
  }
  .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(184,134,78,0.5); color: white; }
</style>

{{-- ── HERO ── --}}
<section class="home-hero">
  <div class="container">
    <div class="hero-inner">

      {{-- TEXTE --}}
      <div class="hero-left">
        <div class="hero-label">ONCF &bull; Réseau Ferroviaire National</div>
        <h1 class="hero-title">
          Voyagez à travers<br>
          le <em>Maroc</em> en train
        </h1>
        <p class="hero-desc">
          Découvrez tous nos trajets disponibles. Réservez facilement vos billets
          en quelques clics et profitez du confort du rail marocain.
        </p>
        <div class="hero-actions">
          <a href="{{ url('/rechercher') }}" class="btn-hero-primary">
            🔍 Rechercher un trajet
          </a>
          <a href="#voyages" class="btn-hero-secondary">
            📋 Voir tous les voyages
          </a>
        </div>

        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-num">{{ $voyages->count() }}<span>+</span></div>
            <div class="stat-label">Trajets</div>
          </div>
          <div class="stat-item">
            <div class="stat-num">{{ $voyages->pluck('villeDepart')->merge($voyages->pluck('villeDarrivee'))->unique()->count() }}<span>+</span></div>
            <div class="stat-label">Villes</div>
          </div>
          <div class="stat-item">
            <div class="stat-num">24<span>h</span></div>
            <div class="stat-label">Sur 24h</div>
          </div>
        </div>
      </div>

      {{-- VISUEL CARTE FLOTTANTES --}}
      <div class="hero-visual">
        @foreach($voyages->take(3) as $v)
        <div class="hero-card">
          <div class="hcard-route">
            {{ $v->villeDepart }}
            <span class="hcard-arrow">→</span>
            {{ $v->villeDarrivee }}
          </div>
          <div class="hcard-meta">
            <span>🕐 {{ $v->heureDepart }}</span>
            <span>🕓 {{ $v->heureDarrivee }}</span>
            <span class="hcard-prix">{{ number_format($v->prixVoyage, 0) }} MAD</span>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section>

{{-- ── TOUS LES VOYAGES ── --}}
<section class="voyages-section" id="voyages">
  <div class="container">

    <div class="section-header">
      <div>
        <div class="section-label">Disponible maintenant</div>
        <h2 class="section-title">Tous nos trajets</h2>
      </div>
      <span class="section-count">{{ $voyages->count() }} trajet{{ $voyages->count() > 1 ? 's' : '' }}</span>
    </div>

    {{-- FILTRES PAR VILLE --}}
    <div class="filter-bar" id="filterBar">
      <button class="filter-btn active" data-filter="all">🗺️ Tous</button>
      @foreach($voyages->pluck('villeDepart')->unique()->sort() as $ville)
        <button class="filter-btn" data-filter="{{ $ville }}">{{ $ville }}</button>
      @endforeach
    </div>

    {{-- GRILLE --}}
    <div class="voyages-grid" id="voyagesGrid">

      @forelse($voyages as $v)
      <div class="voyage-card" data-depart="{{ $v->villeDepart }}">

        <div class="card-header">
          <span class="card-code">{{ $v->code_voyage }}</span>
          <span class="card-badge-direct">✓ Direct</span>
        </div>

        <div class="card-route">
          <div class="card-city">
            <span class="card-city-label">Départ</span>
            <span class="card-city-name">{{ $v->villeDepart }}</span>
            <span class="card-city-time">🕐 {{ $v->heureDepart }}</span>
          </div>

          <div class="card-arrow">
            <div class="arrow-line"></div>
            <span class="arrow-icon">🚆</span>
          </div>

          <div class="card-city">
            <span class="card-city-label">Arrivée</span>
            <span class="card-city-name">{{ $v->villeDarrivee }}</span>
            <span class="card-city-time">🕓 {{ $v->heureDarrivee }}</span>
          </div>
        </div>

        <div class="card-footer">
          <div class="card-prix">
            <span class="prix-label">À partir de</span>
            <span class="prix-value">{{ number_format($v->prixVoyage, 2) }}<span class="prix-mad"> MAD</span></span>
          </div>

          @auth
          <form action="{{ route('cart.add') }}" method="POST" style="display:inline">
            @csrf
            <input type="hidden" name="voyage_id" value="{{ $v->id }}">
            <input type="hidden" name="qte" value="1">
            <button type="submit" class="btn-card-reserver">
              🛒 Réserver
            </button>
          </form>
          @else
          <a href="{{ url('/login') }}" class="btn-card-reserver" style="text-decoration:none">
            🛒 Réserver
          </a>
          @endauth
        </div>

      </div>
      @empty
      <div class="empty-state">
        <div class="empty-icon">🚆</div>
        <div class="empty-title">Aucun voyage disponible</div>
        <p class="empty-sub">Revenez bientôt pour de nouveaux trajets.</p>
      </div>
      @endforelse

    </div>
  </div>
</section>

{{-- ── CTA ── --}}
<section class="cta-band">
  <div class="container">
    <div class="cta-content">
      <h2 class="cta-title">Vous savez déjà où vous allez ?</h2>
      <p class="cta-sub">Utilisez la recherche avancée pour filtrer par ville de départ et d'arrivée.</p>
      <a href="{{ url('/rechercher') }}" class="btn-cta">
        🔍 Recherche avancée
      </a>
    </div>
  </div>
</section>

<script>
  // Filtre par ville de départ
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;
      document.querySelectorAll('.voyage-card').forEach(card => {
        if (filter === 'all' || card.dataset.depart === filter) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
</script>

@endsection