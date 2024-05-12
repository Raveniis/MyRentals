<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('images/anya 4.jpg') }}" alt="">
        </div>

        <span class="logo_name">MyRentals</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="{{ route('dashboard')}}">
                <i class="uil uil-estate"></i>
                <span class="link-name">Dashboard</span>
            </a></li>
            <li><a href="{{ route('listings')}}">
                <i class="uil uil-list-ul"></i>
                <span class="link-name">Product Listing</span>
            </a></li>
            <li><a href="{{ route('addRentals')}}">
                <i class="uil uil-plus-square"></i>
                <span class="link-name">Add Rentals</span>
            </a></li>
            <li><a href="{{ route('applications')}}">
                <i class="uil uil-label"></i>
                <span class="link-name">Application</span>
            </a></li>
            <li><a href="transaction.php">
                <i class="uil uil-transaction"></i>
                <span class="link-name">Transaction History</span>
            </a></li>
            {{-- <li><a href="messaging.php">
                <i class="uil uil-message"></i>
                <span class="link-name">Message</span>
            </a></li> --}}
        </ul>
        
        <ul class="logout-mode">
            <li><a href="{{route('ownerLogout')}}">
                <i class="uil uil-signout"></i>
                <span class="link-name">Logout</span>
            </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
            </a>

            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </li>
        </ul>
    </div>
</nav>