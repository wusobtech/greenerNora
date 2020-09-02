<header class="header">
    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                    <a href="{{ url('/') }}" class="navbar-brand"><img height="25" width="105" src="{{ $web_source ?? '' }}/images/logo.png" /></a>
                <nav class="main-nav">
                    <ul class="menu">
                        <li class="megamenu-container">
                            <a class="sf" href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a class="sf" href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li>
                            <a class="sf" href="{{ route('contactus') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">#</span>
                    </a>
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
