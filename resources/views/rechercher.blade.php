@extends('master')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0a1628;
    --navy-mid: #162240;
    --sand: #b8864e;
    --sand-light: #f0e6d3;
    --cream: #faf8f4;
    --border: #e4eaf5;
    --text: #1a2540;
    --muted: #6b7a99;
  }

  body { background: var(--cream); font-family: 'DM Sans', sans-serif; }

  .search-hero {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, #1e3a5f 100%);
    padding: 90px 0 60px;
    position: relative; overflow: hidden;
  }
  .search-hero::before {
    content: ''; position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 20% 50%, rgba(184,134,78,0.12) 0%, transparent 50%),
      radial-gradient(circle at 80% 20%, rgba(184,134,78,0.08) 0%, transparent 40%);
  }
  .search-hero::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px;
    background: repeating-linear-gradient(90deg, var(--sand) 0px, var(--sand) 30px, transparent 30px, transparent 50px);
    opacity: 0.5;
  }

  .hero-content { position: relative; z-index: 1; text-align: center; color: white; }
  .hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase;
    color: var(--sand); font-weight: 500; margin-bottom: 1rem;
  }
  .hero-label::before, .hero-label::after { content: ''; width: 30px; height: 1px; background: var(--sand); opacity: 0.5; }
  .hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 700; line-height: 1.15;
    color: white; margin-bottom: 0.5rem;
  }
  .hero-title span { color: var(--sand); }
  .hero-sub { font-size: 0.9rem; color: rgba(255,255,255,0.55); font-weight: 300; }

  /* SEARCH CARD */
  .search-card-wrap { margin-top: -36px; position: relative; z-index: 10; padding-bottom: 60px; }
  .search-card {
    background: white; border-radius: 20px;
    box-shadow: 0 20px 60px rgba(10,22,40,0.12), 0 4px 16px rgba(10,22,40,0.06);
    padding: 2.5rem; border: 1px solid var(--border);
  }
  .search-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem; font-weight: 600; color: var(--navy);
    margin-bottom: 1.75rem; display: flex; align-items: center; gap: 10px;
  }
  .search-card-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }

  .search-form { display: flex; flex-direction: column; gap: 1.25rem; }
  .form-row { display: grid; grid-template-columns: 1fr auto 1fr; gap: 1rem; align-items: end; }
  @media (max-width: 768px) {
    .form-row { grid-template-columns: 1fr; }
    .swap-btn-wrap { display: none; }
  }

  .form-group { display: flex; flex-direction: column; gap: 6px; }
  .form-label { font-size: 0.72rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }

  .form-select-custom {
    appearance: none; -webkit-appearance: none;
    width: 100%; padding: 14px 44px 14px 16px;
    border: 1.5px solid var(--border); border-radius: 12px;
    font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 500; color: var(--text);
    background: var(--cream) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7a99' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 14px center;
    cursor: pointer; outline: none; transition: border-color 0.25s, box-shadow 0.25s;
  }
  .form-select-custom:focus { border-color: var(--sand); box-shadow: 0 0 0 3px rgba(184,134,78,0.12); background-color: white; }

  .swap-btn-wrap { display: flex; align-items: flex-end; padding-bottom: 2px; }
  .swap-btn {
    width: 42px; height: 42px; border-radius: 50%;
    border: 1.5px solid var(--border); background: white; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; color: var(--muted); transition: all 0.3s; flex-shrink: 0;
  }
  .swap-btn:hover { border-color: var(--sand); color: var(--sand); background: var(--sand-light); transform: rotate(180deg); }

  .btn-search {
    width: 100%; padding: 15px;
    background: linear-gradient(135deg, var(--navy), #162240);
    color: white; border: none; border-radius: 12px;
    font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 600;
    cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
    transition: all 0.3s; box-shadow: 0 6px 20px rgba(10,22,40,0.2);
  }
  .btn-search:hover { background: linear-gradient(135deg, var(--sand), #9a6d38); box-shadow: 0 8px 28px rgba(184,134,78,0.35); transform: translateY(-1px); }
  .btn-search .btn-icon { font-size: 1.1rem; transition: transform 0.3s; }
  .btn-search:hover .btn-icon { transform: translateX(4px); }

  /* RESULTS */
  .results-section { padding: 0 0 80px; }
  .results-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
  .results-title { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 700; color: var(--navy); }
  .results-count { background: var(--sand-light); color: var(--sand); font-size: 0.8rem; font-weight: 600; padding: 5px 14px; border-radius: 50px; }

  /* VOYAGE CARD */
  .voyage-card {
    background: white; border-radius: 16px; border: 1.5px solid var(--border);
    padding: 1.5rem 2rem; margin-bottom: 1rem;
    display: grid; grid-template-columns: 1fr auto 1fr auto;
    align-items: center; gap: 1.5rem;
    transition: all 0.3s; animation: slideUp 0.4s ease both;
    position: relative; overflow: hidden;
  }
  .voyage-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
    background: linear-gradient(180deg, var(--sand), var(--navy));
    border-radius: 4px 0 0 4px;
  }
  .voyage-card:hover { box-shadow: 0 12px 40px rgba(10,22,40,0.1); transform: translateY(-2px); border-color: var(--sand); }
  @keyframes slideUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
  .voyage-card:nth-child(1) { animation-delay: 0.05s; }
  .voyage-card:nth-child(2) { animation-delay: 0.10s; }
  .voyage-card:nth-child(3) { animation-delay: 0.15s; }

  .city-block { display: flex; flex-direction: column; gap: 4px; }
  .city-label { font-size: 0.65rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
  .city-name { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 700; color: var(--navy); line-height: 1; }
  .city-time { font-size: 0.85rem; font-weight: 500; color: var(--muted); margin-top: 2px; }

  .route-visual { display: flex; flex-direction: column; align-items: center; gap: 4px; }
  .route-line { display: flex; align-items: center; gap: 4px; width: 100px; }
  .route-line .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--sand); flex-shrink: 0; }
  .route-line .line {
    flex: 1; height: 2px;
    background: repeating-linear-gradient(90deg, var(--border) 0px, var(--border) 6px, transparent 6px, transparent 10px);
    position: relative; overflow: hidden;
  }
  .route-line .train-emoji { font-size: 0.9rem; position: absolute; top: 50%; transform: translateY(-50%); animation: trainMove 2s linear infinite; }
  @keyframes trainMove { 0% { left: -20px; } 100% { left: 110%; } }
  .route-type { font-size: 0.65rem; color: var(--muted); }

  /* PRICE + CART */
  .price-action { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
  .price-wrap { text-align: right; }
  .price-label { font-size: 0.65rem; color: var(--muted); font-weight: 500; letter-spacing: 1px; text-transform: uppercase; }
  .price-amount { font-family: 'Cormorant Garamond', serif; font-size: 1.9rem; font-weight: 700; color: var(--navy); line-height: 1; }
  .price-currency { font-size: 0.9rem; font-weight: 600; color: var(--sand); }

  .cart-inline-form { display: flex; align-items: center; gap: 8px; }

  .qte-select {
    width: 62px; padding: 8px 6px;
    border: 1.5px solid var(--border); border-radius: 10px;
    font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 600;
    color: var(--text); background: var(--cream); outline: none; cursor: pointer;
    text-align: center; transition: border-color 0.2s;
  }
  .qte-select:focus { border-color: var(--sand); }

  .btn-add-cart {
    padding: 9px 18px; background: var(--navy); color: white;
    border: none; border-radius: 50px;
    font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s; white-space: nowrap;
    display: flex; align-items: center; gap: 6px;
  }
  .btn-add-cart:hover { background: var(--sand); box-shadow: 0 4px 16px rgba(184,134,78,0.35); transform: translateY(-1px); }

  /* ALERT */
  .alert-success-custom {
    background: #e6f7f0; color: #2e9e6b; border: 1px solid #b8e8d4;
    border-radius: 12px; padding: 12px 20px; font-size: 0.88rem; font-weight: 500;
    margin-bottom: 1.25rem; display: flex; align-items: center; gap: 8px;
  }

  @media (max-width: 768px) {
    .voyage-card { grid-template-columns: 1fr 1fr; grid-template-rows: auto auto; }
    .route-visual { grid-column: 1 / -1; }
    .price-action { align-items: flex-start; }
    .cart-inline-form { flex-wrap: wrap; }
  }

  /* EMPTY */
  .empty-state { text-align: center; padding: 4rem 2rem; animation: slideUp 0.4s ease; }
  .empty-icon { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.5; }
  .empty-title { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; color: var(--navy); margin-bottom: 0.5rem; }
  .empty-sub { font-size: 0.9rem; color: var(--muted); }
</style>

{{-- HERO --}}
<section class="search-hero">
  <div class="container">
    <div class="hero-content">
      <div class="hero-label">ONCF &bull; Réseau National</div>
      <h1 class="hero-title">Trouvez votre <span>prochain trajet</span></h1>
      <p class="hero-sub">Des milliers de destinations à travers tout le Maroc</p>
    </div>
  </div>
</section>

{{-- SEARCH CARD --}}
<div class="search-card-wrap">
  <div class="container">
    <div class="search-card">
      <div class="search-card-title">🔍 Rechercher un voyage</div>

<form class="search-form" action="{{ url('/rechercher/resultats') }}" method="GET">        <div class="form-row">

          <div class="form-group">
            <label class="form-label">🏙️ Ville de départ</label>
            <select name="ville_depart" class="form-select-custom" required>
              <option value="" disabled selected>Choisir une ville...</option>
              @foreach($villesDepart as $ville)
                <option value="{{ $ville }}" {{ request('ville_depart') == $ville ? 'selected' : '' }}>
                  {{ $ville }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="swap-btn-wrap">
            <button type="button" class="swap-btn" id="swapBtn" title="Inverser">⇄</button>
          </div>

          <div class="form-group">
            <label class="form-label">📍 Ville d'arrivée</label>
            <select name="ville_arrivee" class="form-select-custom" required>
              <option value="" disabled selected>Choisir une ville...</option>
              @foreach($villesArrivee as $ville)
                <option value="{{ $ville }}" {{ request('ville_arrivee') == $ville ? 'selected' : '' }}>
                  {{ $ville }}
                </option>
              @endforeach
            </select>
          </div>

        </div>

        <button type="submit" class="btn-search">
          <span class="btn-icon">🚆</span>
          Rechercher les trajets disponibles
        </button>
      </form>
    </div>
  </div>
</div>

{{-- RÉSULTATS --}}
@if(isset($voyages))
<section class="results-section">
  <div class="container">

    @if(session('success'))
      <div class="alert-success-custom">✅ {{ session('success') }}</div>
    @endif

    <div class="results-header">
      <h2 class="results-title">
        {{ $voyages->count() > 0 ? 'Trajets disponibles' : 'Aucun trajet trouvé' }}
      </h2>
      @if($voyages->count() > 0)
        <span class="results-count">
          {{ $voyages->count() }} résultat{{ $voyages->count() > 1 ? 's' : '' }}
        </span>
      @endif
    </div>

    @forelse($voyages as $v)
    <div class="voyage-card">

      {{-- DÉPART --}}
      <div class="city-block">
        <span class="city-label">Départ</span>
        <span class="city-name">{{ $v->villeDepart }}</span>
        <span class="city-time">🕐 {{ $v->heureDepart }}</span>
      </div>

      {{-- ROUTE --}}
      <div class="route-visual">
        <div class="route-line">
          <div class="dot"></div>
          <div class="line"><span class="train-emoji">🚆</span></div>
          <div class="dot"></div>
        </div>
        <span class="route-type">Train direct</span>
      </div>

      {{-- ARRIVÉE  ← heureDarrivee (champ exact du modèle) --}}
      <div class="city-block">
        <span class="city-label">Arrivée</span>
        <span class="city-name">{{ $v->villeDarrivee }}</span>
        <span class="city-time">🕓 {{ $v->heureDarrivee }}</span>
      </div>

      {{-- PRIX + FORMULAIRE PANIER ← prixVoyage (champ exact du modèle) --}}
      <div class="price-action">
        <div class="price-wrap">
          <div class="price-label">À partir de</div>
          <div class="price-amount">
            {{ number_format($v->prixVoyage, 2) }}<span class="price-currency"> MAD</span>
          </div>
        </div>

        <form action="{{ route('cart.add') }}" method="POST" class="cart-inline-form">
          @csrf
          <input type="hidden" name="voyage_id" value="{{ $v->id }}">
          <select name="qte" class="qte-select" title="Nombre de billets">
            @for($i = 1; $i <= 10; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
          <button type="submit" class="btn-add-cart">🛒 Ajouter</button>
        </form>
      </div>

    </div>
    @empty
    <div class="empty-state">
      <div class="empty-icon">🗺️</div>
      <div class="empty-title">Aucun voyage disponible</div>
      <p class="empty-sub">Essayez d'autres villes ou une date différente.</p>
    </div>
    @endforelse

  </div>
</section>
@endif

<script>
  document.getElementById('swapBtn')?.addEventListener('click', () => {
    const dep = document.querySelector('select[name="ville_depart"]');
    const arr = document.querySelector('select[name="ville_arrivee"]');
    const tmp = dep.value;
    dep.value = arr.value;
    arr.value = tmp;
  });
</script>

@endsection