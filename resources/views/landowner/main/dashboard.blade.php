<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{asset('css/landowner/main.css')}}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Dashboard</title> 
</head>
<body>
    @include('landowner.components.sidebar')

    <section class="dashboard">
        @include('landowner.components.header')
        

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="uil uil-estate"></i>                
                <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <a class="box box1" href="{{route('listings')}}">
                        <i class="uil uil-list-ul"></i>
                        <span class="text">Total Listings</span>
                        <span class="number">{{ $houseRentalCount }}</span>
                    </a>
                    <a class="box box2" href="{{ route('tenants') }}">
                        <i class="uil uil-transaction"></i>
                        <span class="text">Total Tenants</span>
                        <span class="number">{{ $tenants }}</span>
                    </a>
                    <a href="{{ route('applications') }}"class="box box3">
                        <i class="uil uil-message"></i>
                        <span class="text">Total Rental Applicants</span>
                        <span class="number">{{ $applicantsCount }}</span>
                    </a>
                    
                    {{-- <div class="box box3" style="margin-top: 30px;">
                        <i class="uil uil-message"></i>
                        <span class="text">Daily profit</span>
                        <span class="number</span>
                    </div> --}}

                    

                    
                </div>
            </div>
        </div>
    </div>
    </section>

    <script src="{{asset("js/landowner/main.js")}}"></script>
    @if(session()->has("success"))
        <script>
            Swal.fire({
            title: 'Login Successful',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            customClass: {
                popup: 'sweetalert-custom-popup',
                title: 'sweetalert-custom-title',
                icon: 'sweetalert-custom-icon-success'
            },
            background: '#ffffff',
            });
        </script>
    @endif
</body>

</html>