<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{route('search')}}" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="q" id="q" value="{{request()->input('q')}}" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="#">Shop</a>
                    <ul>
                        <li><a href="{{ route('frozenfoods') }}" class="menu-title">Frozen foods</a></li>
                        <li><a href="{{ route('lounge') }}" class="menu-title">Lounges</a></li>
                    </ul>
                </li>
                <li>
                    <a  href="{{ route('contactus') }}">Contact Us</a>
                </li>
                <li>
                    <a href="{{ route('login') }}"><i class="icon-user"></i>@if(Auth::check())
                        {{Auth::user()->name}}
                        @else
                           Login
                      @endif

                </a>
                </li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->
