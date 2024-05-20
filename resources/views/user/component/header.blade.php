

<header class="header">
    <div class="menu-icon">
        <!-- <div class="logo-image">
            <img src="resource/images/pcex-logo.png" alt="">
        </div> -->
        <a href="{{ route('index')}}"><p>MyRentals</p></a>
    </div>
    
    <div class="header-right">
        @auth
            <div class='user-profile-container' id='profile'>
                <img  src="{{ asset(auth()->user()->profile_pic ? auth()->user()->profile_pic : 'images/default.png') }}" alt='img'>
                <ul class='profile-link'>
                    <li><a href='{{ route('userApplication')}}'><i class='bx bx-list-ul'></i></i></i>Application Status</a></li>
                    <li><a href='{{ route('userTenant')}}'><i class='bx bx-history'></i>Rental History</a></li>
                    <li><a href='{{ route('userProfile')}}'><i class='bx bxs-user-circle icon' ></i>Profile</a></li>
                    <li><a href=''><i class='bx bxs-log-out-circle' ></i>Logout</a></li>
                </ul>
            </div>
        @endauth
        @guest   
            <div class='login'>
                <p><a href='{{ route('userRegister')}}'>Register</a></p>
            </div>
            <div class='login'>
                <p><a href='{{route('login')}}'>Login</a></p>
            </div>     
        @endguest  
    </div>

    <script>
        //  document.getElementById("searchBar").addEventListener('keydown', function(event){
        //     if (event.key === 'Enter') {
        //         Search()
        //     }
        // });

        // Parse the query string parameters
        // var urlParams = new URLSearchParams(window.location.search);

        // var searchParam = urlParams.get('search') || '';
        // var filterParam = urlParams.get('filter') || '';
        // document.getElementById("searchBar").value = urlParams.get('search')

        // Output the values (you can do whatever you want with them)
        // console.log(searchParam !== '' ? searchParam : 'Search parameter does not exist');

        // console.log(filterParam !== '' ? filterParam : 'Filter parameter does not exist');

        // function Search(){
        //     var search = document.getElementById("searchBar").value.trim();
        //      window.location.href = "productsearch.php?search=" + search + "&filter=" + filterParam
        // }

        // PROFILE DROPDOWN
        const profile = document.getElementById('profile');
        const imgProfile = profile.querySelector('img');
        const dropdownProfile = profile.querySelector('.profile-link');

        imgProfile.addEventListener('click', function () 
        {
            dropdownProfile.classList.toggle('show');
        })

        window.addEventListener('click', function (e) 
        {
            if(e.target !== imgProfile) 
            {
                if(e.target !== dropdownProfile) 
                {
                    if(dropdownProfile.classList.contains('show')) 
                    {
                        dropdownProfile.classList.remove('show');
                    }
                }
            }
        })
    </script>
</header>