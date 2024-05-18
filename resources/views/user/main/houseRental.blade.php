<html>

<head>
    <title>My Rentals</title>
    <link rel="stylesheet" href="{{ asset('css/user/header.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/houseRental.css')}}">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body> 

@include('user.component.header')

<!-- main content -->
<main>

<section class="container">
    <div class="product-container">
        <div class="product-details-1">
            <div class="back-button">
                <a style="cursor: pointer" href="{{route('index')}}">
                    <i class='bx bx-arrow-back'></i>
                </a>
            </div>
            <div class="product-picture"> 
                <img src="{{ $houseRental->image ? asset($houseRental->image) : asset('images/default-house.svg')}}">
            </div>
            <div class="seller-details">
                <div class="product-seller">
                    <h3>Owner:</h3>          
                    <div class="seller-profile">
                        <div class="profileContainer">
                            <img class="profilePic" src="{{ $houseRental->user->profile_pic ? asset($houseRental->user->profile_pic) : asset('images/default.png')}}" alt="img">
                        </div>
                        <h4>
                            {{ $houseRental->user->firstname }} {{$houseRental->user->lastname}}
                        </h4>
                    </div>
                </div>
                <div class="contacts">
                    <h3>Contacts:</h3>
                    <div class="contacts-detail">
                        <p> {{ $houseRental->user->email }}</p>
                        <p> {{ $houseRental->user->contact_num }}</p>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="product-details-2">
            <div class="product-name">
                <h2>{{ $houseRental->name }}</h2>
            </div>
            <div class="product-rating">
                stars here
            </div>
            <div class="product-price">
                <p>{{ $houseRental->monthly_rent }}/mo</p>
            </div>
            <div class="product-condition">
                <p>Location: </p>
                <p style="font-size: 16px;">{{ $houseRental->address }}</p>
            </div>
            <div class="product-condition">
                <p>Description: </p>
                <p style="font-size: 16px;">{{ $houseRental->description }}</p>
            </div>
            <div class="product-condition">
                <p>Maximum Occupants: </p>
                <p style="font-size: 16px;">{{ $houseRental->maximum_occupants }}</p>
            </div>
            <div class="product-condition">
                <p>status: </p>
                <p style="font-size: 16px;">{{ ($houseRental->maximum_occupants === 1) ? 'available' : 'unavailable'  }}</p>
            </div>

            <div class="product-actions">
                <a class="make-an-offer" href="">
                    <button>Apply</button>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- <section class="container">
    <div class="review-container">
        <div class="review-content">
            <div class="review">
                <h4>Product Review</h4>
                
                <div class="review-details-container">
                    <div class="review-profile">
                        <div class="profileContainer" style="top: 5px">
                            <img class="profilePic" src="resource\profilepics\" alt="img">
                        </div>
                            <div class="rating-details">
                                <div class="review-name">
                                    <p><namehere</p>
                                </div>
                                <div class="review-stars">
                                    @php
                                        $filledStar = (int)$review['rating'];
                                        $starsLeft = 5;
                                        for($i = 0; $i < $filledStar; $i++)
                                        {
                                            echo "<i class='bx bxs-star' title='" . (int)$review['rating'] . "/5"  . "'></i>";
                                            $starsLeft -= 1;
                                        }
                                        while ($starsLeft > 0)
                                        {
                                            echo "<i class='bx bx-star' title='" . (int)$review['rating'] . "/5"  . "'></i>";
                                            $starsLeft -= 1;
                                        }
                                    @endphp
                                </div>
                                <div class="review-date">
                                    <p>
                                        review date
                                    </p>
                                </div>
                                <div class="user-review">
                                    <p>
                                        comment
                                    </p>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

</main>     



{{-- @include('user.component.footer') --}}

</main>

</body>


</html>
