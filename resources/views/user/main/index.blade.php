<!DOCTYPE html>
<html>

<head>
    <title>MyRentals</title>
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='{{ asset('css/user/header.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/user/main.css') }}' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body> 

<!-- header section -->
@include('user.component.header')

<!-- main content -->
<main>
<!-- Advertisement section -->
<section class="ads">
    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide"><img src="{{ asset('images/advertisement 1.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('images/advertisement 2.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('images/advertisement 1.jpg') }}"></div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<div class="product-header">
    <p>Available products</p>
</div>

<section class="product-listing">
    <div class="product-container">
        @foreach ($houseRentals as $houseRental)
            <a href="{{ route('houseRentals', ['id' => $houseRental->id])}}" class="card">
                <img src="{{ $houseRental->image ? asset($houseRental->image) : asset('images/default-house.svg') }}" alt="">
                <div class="card-content">
                    <h4 class="card-title">{{ $houseRental->name }}</h4>
                    <p class="card-price"><span class="price"> {{ $houseRental->monthly_rent }}/mo </span></p>
                    <div class="card-ratings">
                    </div>
                    <div class="card-seller">
                        <!-- <img src="#" alt="pic"> -->
                        <p>Owner: {{ $houseRental->user->firstname }} {{ $houseRental->user->lastname }}</p>
                        <div class="details">
                            <div><p>Contacts:</p></div>
                            <div>
                                <p>{{ $houseRental->user->email }}</p>
                                <p>{{ $houseRental->user->contact_num }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

</main>
    

<!-- footer section -->
@include('user.component.footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const swiper = new Swiper('.swiper', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
        
    autoplay: {
        delay: 5000,
      },
  });
</script>

</body>

</html>
