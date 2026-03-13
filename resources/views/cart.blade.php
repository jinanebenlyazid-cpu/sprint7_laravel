@extends('master')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0a1628;
    --sand: #b8864e;
    --sand-light: #f0e6d3;
    --cream: #faf8f4;
    --border: #e4eaf5;
    --text: #1a2540;
    --muted: #6b7a99;
    --danger: #e05555;
    --success: #2e9e6b;
  }

  body { background: var(--cream); font-family: 'DM Sans', sans-serif; }

  /* HERO */
  .cart-hero {
    background: linear-gradient(135deg, var(--navy), #162240);
    padding: 90px 0 50px;
    position: relative;
    overflow: hidden;
  }
  .cart-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 4px;
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
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; color: white;
  }
  .hero-title span { color: var(--sand); }

  /* LAYOUT */
  .cart-wrap {
    margin-top: -30px;
    padding-bottom: 80px;
  }

  /* ALERT */
  .alert-custom {
    border-radius: 12px; padding: 14px 20px; font-size: 0.9rem;
    font-weight: 500; margin-bottom: 1.5rem; border: none;
    display: flex; align-items: center; gap: 10px;
  }
  .alert-success { background: #e6f7f0; color: var(--success); }
  .alert-danger   { background: #fdeaea; color: var(--danger); }

  /* CART CARD */
  .cart-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(10,22,40,0.1);
    border: 1px solid var(--border);
    overflow: hidden;
  }

  .cart-card-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
  }

  .cart-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem; font-weight: 700; color: var(--navy);
  }

  .badge-count {
    background: var(--sand-light); color: var(--sand);
    font-size: 0.78rem; font-weight: 600;
    padding: 4px 12px; border-radius: 50px;
  }

  /* ITEM */
  .cart-item {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border);
    display: grid;
    grid-template-columns: 1fr auto auto auto;
    align-items: center;
    gap: 1.5rem;
    transition: background 0.2s;
    animation: fadeIn 0.3s ease both;
  }

  .cart-item:last-child { border-bottom: none; }
  .cart-item:hover { background: #fafbff; }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateX(-8px); }
    to   { opacity: 1; transform: translateX(0); }
  }

  .item-route { display: flex; flex-direction: column; gap: 4px; }

  .item-code {
    font-size: 0.68rem; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase; color: var(--sand);
  }

  .item-cities {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem; font-weight: 700; color: var(--navy);
    display: flex; align-items: center; gap: 10px;
  }

  .item-cities .arrow { color: var(--muted); font-size: 1rem; }

  .item-times {
    font-size: 0.8rem; color: var(--muted); font-weight: 400;
  }

  /* PRIX UNITAIRE */
  .item-prix {
    text-align: center; min-width: 80px;
  }

  .prix-label { font-size: 0.65rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
  .prix-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem; font-weight: 700; color: var(--navy);
  }
  .prix-currency { font-size: 0.8rem; color: var(--sand); font-weight: 600; }

  /* QTE FORM */
  .qte-form { display: flex; align-items: center; gap: 8px; }

  .qte-input {
    width: 64px; text-align: center;
    padding: 8px; border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 600;
    color: var(--text); outline: none;
    transition: border-color 0.2s;
  }
  .qte-input:focus { border-color: var(--sand); }

  .btn-update {
    padding: 8px 14px; border-radius: 10px;
    background: var(--navy); color: white; border: none;
    font-size: 0.78rem; font-weight: 600; cursor: pointer;
    transition: all 0.25s;
  }
  .btn-update:hover { background: var(--sand); }

  /* DELETE */
  .btn-remove {
    width: 36px; height: 36px; border-radius: 50%;
    background: #fdeaea; color: var(--danger);
    border: none; font-size: 1rem; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.25s;
    flex-shrink: 0;
  }
  .btn-remove:hover { background: var(--danger); color: white; transform: scale(1.1); }

  /* SUBTOTAL */
  .item-subtotal {
    text-align: right; min-width: 90px;
  }
  .sub-label { font-size: 0.65rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
  .sub-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.4rem; font-weight: 700; color: var(--navy);
  }

  @media (max-width: 768px) {
    .cart-item {
      grid-template-columns: 1fr 1fr;
      grid-template-rows: auto auto;
    }
    .item-route { grid-column: 1 / -1; }
  }

  /* SUMMARY CARD */
  .summary-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(10,22,40,0.1);
    border: 1px solid var(--border);
    padding: 2rem;
    position: sticky;
    top: 100px;
  }

  .summary-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem; font-weight: 700; color: var(--navy);
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
  }

  .summary-line {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 0.85rem; font-size: 0.88rem; color: var(--muted);
  }
  .summary-line span:last-child { font-weight: 600; color: var(--text); }

  .summary-total {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 1rem; border-top: 2px solid var(--border);
    margin-top: 1rem;
  }

  .total-label {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.1rem; font-weight: 700; color: var(--navy);
  }

  .total-amount {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem; font-weight: 700; color: var(--navy);
  }

  .total-amount .currency { font-size: 1rem; color: var(--sand); }

  .btn-checkout {
    width: 100%; margin-top: 1.5rem; padding: 15px;
    background: linear-gradient(135deg, var(--navy), #162240);
    color: white; border: none; border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem; font-weight: 600; letter-spacing: 0.3px;
    cursor: pointer; transition: all 0.3s;
    box-shadow: 0 6px 20px rgba(10,22,40,0.2);
    display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .btn-checkout:hover {
    background: linear-gradient(135deg, var(--sand), #9a6d38);
    box-shadow: 0 8px 28px rgba(184,134,78,0.35);
    transform: translateY(-1px);
  }

  .btn-continue {
    width: 100%; margin-top: 0.75rem; padding: 12px;
    background: transparent; color: var(--muted);
    border: 1.5px solid var(--border); border-radius: 12px;
    font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;
    cursor: pointer; transition: all 0.25s;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    text-decoration: none;
  }
  .btn-continue:hover { border-color: var(--navy); color: var(--navy); }

  /* EMPTY */
  .empty-cart {
    text-align: center; padding: 5rem 2rem;
    animation: fadeIn 0.4s ease;
  }
  .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.4; }
  .empty-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.6rem; color: var(--navy); margin-bottom: 0.5rem;
  }
  .empty-sub { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }
  .btn-go-search {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 28px; background: var(--navy); color: white;
    border-radius: 50px; text-decoration: none;
    font-weight: 600; font-size: 0.9rem;
    transition: all 0.3s;
  }
  .btn-go-search:hover { background: var(--sand); color: white; transform: translateY(-1px); }
</style>

{{-- HERO --}}
<section class="cart-hero">
  <div class="container">
    <div class="hero-content">
      <div class="hero-label">ONCF &bull; Mon Panier</div>
      <h1 class="hero-title">🛒 Mon <span>Panier</span></h1>
    </div>
  </div>
</section>

{{-- CONTENU --}}
<div class="cart-wrap">
  <div class="container">

    {{-- Alertes --}}
    @if(session('success'))
      <div class="alert-custom alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(!empty($cart))
    <div class="row g-4">

      {{-- LISTE ITEMS --}}
      <div class="col-lg-8">
        <div class="cart-card">
          <div class="cart-card-header">
            <div class="cart-card-title">Mes voyages</div>
            <span class="badge-count">{{ count($cart) }} trajet{{ count($cart) > 1 ? 's' : '' }}</span>
          </div>

          @foreach($cart as $id => $item)
          <div class="cart-item">

            {{-- ROUTE --}}
            <div class="item-route">
              <span class="item-code">{{ $item['code_voyage'] }}</span>
              <div class="item-cities">
                {{ $item['villeDepart'] }}
                <span class="arrow">→</span>
                {{ $item['villeDarrivee'] }}
              </div>
              <div class="item-times">
                🕐 {{ $item['heureDepart'] }} &nbsp;›&nbsp; 🕓 {{ $item['heureDarrivee'] }}
              </div>
            </div>

            {{-- PRIX UNITAIRE --}}
            <div class="item-prix">
              <div class="prix-label">Prix/billet</div>
              <div class="prix-value">{{ number_format($item['prix'], 2) }}<span class="prix-currency"> MAD</span></div>
            </div>

            {{-- QTE --}}
            <form action="{{ route('cart.update') }}" method="POST" class="qte-form">
              @csrf @method('PATCH')
              <input type="hidden" name="voyage_id" value="{{ $id }}">
              <input type="number" name="qte" value="{{ $item['qte'] }}" min="1" max="10" class="qte-input">
              <button type="submit" class="btn-update">✓</button>
            </form>

            {{-- SOUS-TOTAL + DELETE --}}
            <div style="display:flex; align-items:center; gap:12px;">
              <div class="item-subtotal">
                <div class="sub-label">Sous-total</div>
                <div class="sub-value">{{ number_format($item['prix'] * $item['qte'], 2) }} <small style="font-size:0.7rem;color:var(--sand)">MAD</small></div>
              </div>

              <form action="{{ route('cart.remove') }}" method="POST">
                @csrf @method('DELETE')
                <input type="hidden" name="voyage_id" value="{{ $id }}">
                <button type="submit" class="btn-remove" title="Supprimer">🗑</button>
              </form>
            </div>

          </div>
          @endforeach
        </div>
      </div>

      {{-- RÉSUMÉ --}}
      <div class="col-lg-4">
        <div class="summary-card">
          <div class="summary-title">📋 Récapitulatif</div>

          @foreach($cart as $id => $item)
          <div class="summary-line">
            <span>{{ $item['villeDepart'] }} → {{ $item['villeDarrivee'] }} × {{ $item['qte'] }}</span>
            <span>{{ number_format($item['prix'] * $item['qte'], 2) }} MAD</span>
          </div>
          @endforeach

          <div class="summary-total">
            <span class="total-label">Total</span>
            <span class="total-amount">{{ number_format($total, 2) }}<span class="currency"> MAD</span></span>
          </div>

          {{-- Bouton vers infos voyageurs (étape suivante) --}}
          <a href="{{ url('/paiement') }}" class="btn-checkout">
            💳 Passer au paiement
          </a>
          <a href="{{ url('/rechercher/resultats') }}" class="btn-continue">
            ← Continuer mes achats
          </a>
        </div>
      </div>

    </div>

    @else
    {{-- PANIER VIDE --}}
    <div class="cart-card">
      <div class="empty-cart">
        <div class="empty-icon">🛒</div>
        <div class="empty-title">Votre panier est vide</div>
        <p class="empty-sub">Recherchez un voyage et ajoutez-le à votre panier.</p>
        
      </div>
    </div>
    @endif

  </div>
</div>

@endsection