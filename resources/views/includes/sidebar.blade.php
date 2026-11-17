<aside class="sidebar">
    <a class="brand" href="{{ route('dashboard') }}">
        <span class="brand-mark">P</span>
        <span><strong>Paw Ledger</strong><small>Pet records</small></span>
    </a>
    <div class="nav-caption">WORKSPACE</div>
    <nav class="side-nav" aria-label="Main navigation">
        <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><span class="nav-glyph">D</span> Dashboard</a>
        <a href="{{ route('pets.index') }}" class="side-link {{ request()->routeIs('pets.*') ? 'active' : '' }}"><span class="nav-glyph">R</span> Pet records</a>
        <a href="{{ route('pets.create') }}" class="side-link {{ request()->routeIs('pets.create') ? 'active' : '' }}"><span class="nav-glyph">+</span> Add a pet</a>
    </nav>
    <div class="sidebar-note"><span class="status-dot"></span><span>Records are stored securely<br>in your configured database.</span></div>
</aside>