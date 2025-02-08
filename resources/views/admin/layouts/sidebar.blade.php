<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link" href="{{ route('produk') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Produk
            </a>
            <a class="nav-link" href="{{ route('sales') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Sales
            </a>
            <a class="nav-link" href="{{ route('customer') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Pelanggan
            </a>
            <a class="nav-link" href="{{ route('category') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Kategori Buku
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Start Bootstrap
    </div>
</nav>
