<div class="top">
    <i class="uil uil-bars sidebar-toggle"></i>
    <div class="profile-dropdown">
    <img src="{{ asset(auth()->user()->profile_pic ? auth()->user()->profile_pic : 'images/default.png') }}" alt="Profile Picture">
        <div class="dropdown-content" id="dropdownContent" style="transform: translateY(-5px)">
            <a href="{{route('profile')}}">Account setting</a>
        </div> 
    </div>
</div>