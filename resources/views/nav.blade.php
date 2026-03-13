<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap');

  :root {
    --navy: #0a1628;
    --sand: #b8864e;
    --text-dark: #1a2540;
    --text-muted: #5a6a8a;
    --border: #e4eaf5;
    --hover-bg: #f2f5fc;
    --danger: #e05555;
  }

  .oncf-nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    font-family: 'DM Sans', sans-serif;
    background: #ffffff;
    border-bottom: 1.5px solid var(--border);
    box-shadow: 0 2px 18px rgba(10, 22, 40, 0.07);
    transition: box-shadow 0.3s ease;
  }

  .oncf-nav.scrolled {
    box-shadow: 0 4px 28px rgba(10, 22, 40, 0.13);
  }

  .nav-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 2rem;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
  }

  /* BRAND */
  .oncf-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
  }

  .brand-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--sand), #8a5e2e);
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    box-shadow: 0 4px 14px rgba(184,134,78,0.3);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .oncf-brand:hover .brand-icon {
    transform: rotate(-6deg) scale(1.08);
    box-shadow: 0 6px 20px rgba(184,134,78,0.45);
  }

  .brand-text { display: flex; flex-direction: column; line-height: 1; }

  .brand-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.60rem;
    color: var(--navy);
    letter-spacing: 2px;
  }

  .brand-tagline {
    font-size: 0.6rem;
    color: var(--sand);
    letter-spacing: 2.5px;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 2px;
  }

  /* DIVIDER */
  .nav-divider {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), transparent);
    max-width: 100px;
    display: none;
  }
  @media (min-width: 992px) { .nav-divider { display: block; } }

  /* NAV LINKS */
  .oncf-links {
    display: flex;
    align-items: center;
    gap: 0.15rem;
    list-style: none;
    margin: 0; padding: 0;
  }

  .oncf-links .nav-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    border-radius: 9px;
    transition: all 0.25s ease;
  }

  .oncf-links .nav-link .link-icon {
    font-size: 1rem;
    transition: transform 0.25s;
  }

  .oncf-links .nav-link:hover {
    color: var(--navy);
    background: var(--hover-bg);
  }

  .oncf-links .nav-link:hover .link-icon { transform: scale(1.2); }

  .oncf-links .nav-link::after {
    content: '';
    position: absolute;
    bottom: 5px; left: 50%;
    transform: translateX(-50%);
    width: 0; height: 1.5px;
    background: var(--sand);
    border-radius: 2px;
    transition: width 0.3s;
  }
  .oncf-links .nav-link:hover::after { width: 55%; }

  /* BADGE PANIER */
  .cart-link { position: relative; }
  .cart-badge {
    position: absolute;
    top: 5px; right: 8px;
    width: 8px; height: 8px;
    background: var(--sand);
    border-radius: 50%;
    border: 2px solid #fff;
    animation: pulse-badge 2s infinite;
  }

  @keyframes pulse-badge {
    0%, 100% { box-shadow: 0 0 0 0 rgba(184,134,78,0.5); }
    50%       { box-shadow: 0 0 0 5px rgba(184,134,78,0); }
  }

  /* CTA BUTTON */
  .nav-cta {
    padding: 9px 20px !important;
    background: var(--navy) !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    box-shadow: 0 4px 14px rgba(10,22,40,0.2);
    transition: all 0.3s ease !important;
  }
  .nav-cta::after { display: none !important; }
  .nav-cta:hover {
    background: var(--sand) !important;
    color: #fff !important;
    box-shadow: 0 6px 22px rgba(184,134,78,0.4) !important;
    transform: translateY(-1px);
  }

  /* USER DROPDOWN */
  .user-dropdown { position: relative; }

  .user-btn {
    display: flex; align-items: center; gap: 8px;
    padding: 7px 14px;
    background: var(--hover-bg); border: 1.5px solid var(--border);
    border-radius: 50px; cursor: pointer;
    font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 600;
    color: var(--navy); transition: all 0.25s;
  }
  .user-btn:hover { border-color: var(--sand); background: #fdf6ee; }

  .user-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, var(--sand), #8a5e2e);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 700; color: white; flex-shrink: 0;
  }
  .user-arrow { font-size: 0.6rem; color: var(--text-muted); transition: transform 0.25s; }
  .user-dropdown.open .user-arrow { transform: rotate(180deg); }

  .dropdown-menu-custom {
    display: none;
    position: absolute; top: calc(100% + 8px); right: 0;
    background: white; border: 1.5px solid var(--border);
    border-radius: 14px; min-width: 200px;
    box-shadow: 0 16px 40px rgba(10,22,40,0.12);
    overflow: hidden; z-index: 999;
    animation: dropIn 0.2s ease;
  }
  @keyframes dropIn {
    from { opacity:0; transform:translateY(-6px); }
    to   { opacity:1; transform:translateY(0); }
  }
  .user-dropdown.open .dropdown-menu-custom { display: block; }

  .dropdown-header {
    padding: 12px 16px;
    background: var(--hover-bg);
    border-bottom: 1px solid var(--border);
  }
  .dropdown-user-name { font-size: 0.88rem; font-weight: 700; color: var(--navy); }
  .dropdown-user-email { font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

  .dropdown-item-custom {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 16px; font-size: 0.82rem; font-weight: 500;
    color: var(--text-dark); text-decoration: none;
    transition: background 0.2s;
  }
  .dropdown-item-custom:hover { background: var(--hover-bg); color: var(--navy); }

  .dropdown-sep { height: 1px; background: var(--border); margin: 4px 0; }

  .logout-form { margin: 0; padding: 0; }
  .logout-btn {
    width: 100%; display: flex; align-items: center; gap: 10px;
    padding: 10px 16px; font-size: 0.82rem; font-weight: 500;
    color: var(--danger); background: none; border: none;
    cursor: pointer; font-family: 'DM Sans', sans-serif;
    text-align: left; transition: background 0.2s;
  }
  .logout-btn:hover { background: #fdeaea; }

  /* AUTH LINKS */
  .nav-login {
    display: flex; align-items: center; gap: 7px;
    padding: 8px 16px; color: var(--text-dark);
    text-decoration: none; font-size: 0.875rem; font-weight: 500;
    border-radius: 9px; transition: all 0.25s;
  }
  .nav-login:hover { background: var(--hover-bg); color: var(--navy); }

  .nav-register {
    display: flex; align-items: center; gap: 7px;
    padding: 9px 18px;
    background: var(--navy); color: white;
    text-decoration: none; font-size: 0.82rem; font-weight: 600;
    border-radius: 50px;
    box-shadow: 0 4px 14px rgba(10,22,40,0.2);
    transition: all 0.3s;
  }
  .nav-register:hover {
    background: var(--sand); color: white;
    box-shadow: 0 6px 20px rgba(184,134,78,0.35);
    transform: translateY(-1px);
  }

  /* TOGGLER MOBILE */
  .oncf-toggler {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
    border-radius: 8px;
    transition: background 0.2s;
  }
  .oncf-toggler:hover { background: var(--hover-bg); }
  .oncf-toggler span {
    display: block; height: 2px;
    background: var(--navy);
    border-radius: 2px;
    transition: all 0.3s;
  }
  .oncf-toggler span:nth-child(1) { width: 24px; }
  .oncf-toggler span:nth-child(2) { width: 16px; }
  .oncf-toggler span:nth-child(3) { width: 20px; }
  .oncf-toggler.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); width: 22px; }
  .oncf-toggler.active span:nth-child(2) { opacity: 0; }
  .oncf-toggler.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); width: 22px; }

  /* MOBILE MENU */
  @media (max-width: 991.98px) {
    .oncf-toggler { display: flex; }

    .oncf-collapse {
      display: none;
      position: absolute;
      top: 72px; left: 0; right: 0;
      background: #ffffff;
      border-top: 1px solid var(--border);
      box-shadow: 0 8px 30px rgba(10,22,40,0.1);
      padding: 1.25rem 1.5rem 1.5rem;
      border-radius: 0 0 16px 16px;
    }
    .oncf-collapse.open { display: block; }

    .oncf-links {
      flex-direction: column;
      align-items: stretch;
      gap: 0.25rem;
    }
    .oncf-links .nav-link { padding: 12px 14px; }
    .nav-cta {
      justify-content: center;
      margin-top: 0.5rem;
      border-radius: 12px !important;
    }
    .user-dropdown { width: 100%; }
    .user-btn { width: 100%; justify-content: space-between; border-radius: 12px; }
    .dropdown-menu-custom { position: static; box-shadow: none; border: 1px solid var(--border); margin-top: 6px; }
    .nav-login, .nav-register { justify-content: center; margin-top: 0.25rem; }
    .nav-register { border-radius: 12px; }
  }
</style>

<nav class="oncf-nav" id="oncfNav">
  <div class="nav-inner">

    {{-- BRAND --}}
    <a class="oncf-brand" href="{{ url('/') }}">
      <div class="brand-icon">🚆</div>
      <div class="brand-text">
        <span class="brand-name">ONCF</span>
        <span class="brand-tagline">Chaque trajet une histoire</span>
      </div>
    </a>

    <div class="nav-divider"></div>

    {{-- TOGGLER MOBILE --}}
    <button class="oncf-toggler" id="navToggler" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>

    {{-- LINKS --}}
    <div class="oncf-collapse" id="oncfCollapse">
      <ul class="oncf-links">

        @auth
        {{-- ══ UTILISATEUR CONNECTÉ ══ --}}

        <li>
          <a class="nav-link" href="{{ url('/') }}">
            <span class="link-icon">🏠</span>
            Accueil
          </a>
        </li>

        <li>
          <a class="nav-link cart-link" href="{{ url('/cart') }}">
            <span class="link-icon">🛒</span>
            Panier
            @php $cartCount = count(session()->get('cart', [])); @endphp
            @if($cartCount > 0)
              <span class="cart-badge"></span>
            @endif
          </a>
        </li>

        <li>
          <a class="nav-link" href="{{ url('/mes-billets') }}">
            <span class="link-icon">🎫</span>
            Mes billets
          </a>
        </li>

        <li>
          <a class="nav-link nav-cta" href="{{ url('/rechercher') }}">
            <span>🗺️</span>
            Rechercher trajets
          </a>
        </li>

        <li> 
          <div class="user-dropdown" id="userDropdown">
            <button class="user-btn" id="userBtn">
              <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
              </div>
              {{ Auth::user()->prenom }}
              <span class="user-arrow">▼</span>
            </button>

            <div class="dropdown-menu-custom">
              <div class="dropdown-header">
                <div class="dropdown-user-name">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>
                <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
              </div>
              <!-- <a href="{{ url('/cart') }}" class="dropdown-item-custom">🛒 Mon panier</a>
              <a href="{{ url('/mes-billets') }}" class="dropdown-item-custom">🎫 Mes billets</a> -->
              <div class="dropdown-sep"></div>
              <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">👋 Déconnexion</button>
              </form>
            </div>
          </div>
        </li>

        @else
        {{-- ══ VISITEUR NON CONNECTÉ ══ --}}

        <li><a class="nav-login" href="{{ url('/login') }}">🔑 Connexion</a></li>
        <li><a class="nav-register" href="{{ url('/register') }}">✨ S'inscrire</a></li>

        @endauth

      </ul>
    </div>

  </div>
</nav>

<script>
  // Scroll shadow
  const nav = document.getElementById('oncfNav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 20);
  });

  // Mobile toggler
  const toggler = document.getElementById('navToggler');
  const collapse = document.getElementById('oncfCollapse');
  toggler.addEventListener('click', () => {
    toggler.classList.toggle('active');
    collapse.classList.toggle('open');
  });

  // User dropdown
  const userBtn = document.getElementById('userBtn');
  const userDropdown = document.getElementById('userDropdown');
  if (userBtn) {
    userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      userDropdown.classList.toggle('open');
    });
    document.addEventListener('click', () => {
      userDropdown.classList.remove('open');
    });
  }
</script>