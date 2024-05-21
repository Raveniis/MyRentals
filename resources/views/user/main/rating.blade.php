<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MyRentals</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/user/houserental.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('css/user/rating.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="main-container">
    <div class="container-fluid" style="margin-top: 63px; padding: 0px 30px">
        <div class="card shadow mb-3">
            <div class="card-header py-3" style="display: flex"> 
                <a style="cursor: pointer; margin-right: 10px; font-size: 24px; color: black;" href="{{route('userTenant')}}">
                    <i class='bx bx-arrow-back'></i>
                </a>
                <p class="text-primary m-0 fw-bold" style="font-size: 18px;"><span style="color: rgb(15, 17, 20);">Rental Details</span></p>
            </div>
            <div class="card-body">
            <form>
                @csrf
                <div class="row" style="margin-bottom: 25px;text-align: left;">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2" style="display: inline;text-align: center;margin-bottom: 25px;">
                            <img id="previewImage" class="rounded-circle mb-3 mt-4 img-fluid" src="{{ asset($houserental->image) }}" style=" display: inline; max-height: 150px; width: 200px; height: 200px; border-radius: 0px !important;">
                        </div>                        
                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                        <div class="row">
                            <div class="col-md-12 text-start">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Rental Name</strong></label>
                                <input class="form-control" value="{{ $houserental->name}}" readonly>
                            </div>
                            </div>
                            <div class="col-md-12 text-start">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Address</strong></label>
                                <input class="form-control" type="text" value="{{ $houserental->address }}" readonly></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="first_name"><strong>Monthly Rent</strong></label>
                            <input class="form-control" type="text" value="{{ $houserental->monthly_rent }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="first_name"><strong>Maximum Occupants</strong></label>
                            <input class="form-control" type="text" value="{{ $houserental->maximum_occupants }}" readonly>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

{{-- <section class="rating-container"> --}}
    <div class="container-fluid" style="margin-top: 63px; padding: 0px 30px">
        <div class="card shadow mb-3">
            <div class="card-body" style="height: 280px;">
            <div class ="rate-header"><b>Rate Rentals</b></div>
                <form id="ratingForm" action="{{route('houserental.reviewPost', ['id' => $houserental->id])}}" method="POST">
                    @csrf
                    <div class="product-rating">
                        <div class="rating-content">
                            <p>Experience:</p>
                        </div>
                        <div id="starContainer" class="rating-content">
                            <i title="1" onclick="rateProduct(1)" class='bx bxs-star'></i>
                            <i title="2" onclick="rateProduct(2)" class='bx bxs-star'></i>
                            <i title="3" onclick="rateProduct(3)" class='bx bxs-star'></i>
                            <i title="4" onclick="rateProduct(4)" class='bx bxs-star'></i>
                            <i title="5" onclick="rateProduct(5)" class='bx bxs-star'></i>
                        </div>
                        <input id="rating" type="number" name="ratings" hidden>
                        <div class="rating-content">
                            <p id="rating-equivalent" style="margin-left: 4px;"></p>
                        </div>
                    </div>
                    
                    <div class="col-md-12 text-start">
                        <div class="mb-3"><label class="form-label" for="email"><strong>Comment</strong></label>
                        <textarea class="form-control" name="comment" style="margin: 5px;"></textarea>
                    </div>
                    <div class="col-md-12" style="text-align: left;margin-top: 5px;">
                    @if($errors->any())
                        <div class="warning-messages" style="color:red">
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                        </div>
                    @endif
                    </div>
                    <div class="col-md-12" style="text-align: right;margin-top: 5px;">
                        <div style="position: absolute;display: flex;">
                            {{-- <a href="changePassword.php" class="btn btn-primary btn-sm" id="submitBtn"  style="margin-right: 12px;">Change Password?</a> --}}
                            <button id="save" class="btn btn-success btn-sm" type="submit">Review</button></div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>
{{-- </section> --}}

<script>
var ratings
const starContainer = document.getElementById("starContainer")
const stars = starContainer.querySelectorAll("i")
const ratingMessage = document.getElementById("rating-equivalent")
const ratingInput = document.getElementById("rating")
var productRating = 0

function rateProduct(ratings){
    productRating = ratings
    console.log(ratings)

    var count = 1;
    stars.forEach(star=>{ 
        if(count <= ratings)
        {
            star.style.color="#feb921"
        }
        else
        {
            star.style.color="rgb(140 140 140)"
        }
        count++

        var message = ""
        switch(ratings) {
            case 1:
                message = "Bad"
                break;
            case 2:
                message = "Poor"
                break;
            case 3:
                message = "Fair"
                break;
            case 4:
                message = "Good"
                break;
            case 5:
                message = "Excellent"
                break;
            default:
                message = ""
          }
          ratingInput.value = productRating;
          ratingMessage.innerHTML = message
        })
    }
</script>
</body>

</html>