<!-- resources/views/layouts/navigation.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">TravelPlatform</a>

        <form class="d-none d-lg-flex ms-4 me-auto" role="search" action="" method="GET">
            <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Search..."
                aria-label="Search">
            <button class="btn btn-sm btn-outline-light" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

    <!-- LEFT SIDE NAV ITEMS -->
    <ul class="navbar-nav gap-2 ms-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#Tours">Tours</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#Visa">Visa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#Hotels">Hotels</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#Corporate">Corporate</a>
        </li>
    </ul>

    <!-- RIGHT SIDE CART + AUTH -->
    <ul class="navbar-nav ms-auto align-items-center">

        <!-- CART ICON -->
        <li class="nav-item me-3">
            <a class="nav-link position-relative" href="">
                <i class="fas fa-shopping-cart"></i>

                @if(session('cart') && count(session('cart')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                </span>
                @endif
            </a>
        </li>

        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li class="nav-item">
            <a class="btn btn-outline-light btn-sm px-3 ms-2" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-outline-light btn-sm px-3 ms-2" href="{{ route('register') }}">Register</a>
        </li>
        @endauth

    </ul>

</div>

    </div>
</nav>