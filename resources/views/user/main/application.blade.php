<html>

<head>
    <title>PCEX</title>
    <link rel="stylesheet" href="{{ asset('css/user/header.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/houseRental.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/applications.css')}}">
    {{-- <link rel="stylesheet" href="css/transaction.css"> --}}
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body> 

@include('user.component.header')


<!-- main content -->
<main>

<section class="container">

    <div class="table-container">
        <div class="table-content">
            <div class="table-header">
                <h4>Transactions</h4>
                <div class="rows">
                    <div class="row-header">
                        <div class="product-pic">
                            <p>House Rentals</p>
                        </div>
                        <div class="status" style="flex-basis: 15%;">
                        </div>  
                        <div class="status">
                            <p>Monthly Rent</p>
                        </div>
                        <div class="status">
                            <p>Status</p>
                        </div>
                        <div class="triple-dot">    </div>
                    </div>
                    @foreach ($tenantApplications as $tenantApplication)
                    <div class="row-content">
                        <div class="product-name">
                            <div>
                                <p> {{$tenantApplication->houseRental->name}} </p>
                                <div style="margin-top: 10px; display: flex; flex-direction: column;">
                                    <div style="display: flex; flex-direction: row; font-size: 14px;">
                                        <p style="color: #5f5f5f; width: 100px;">{{$tenantApplication->houseRental->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="status">
                            <p style="color: orange;">₱{{ $tenantApplication->houseRental->monthly_rent}}</p>
                        </div>
                        <div class="status">
                            @if ($tenantApplication->application_status == 'pending')
                                <p style="color: orange;">{{ $tenantApplication->application_status}}</p>
                            @elseif ($tenantApplication->application_status == 'rejected')
                            <p style="color: red;">{{ $tenantApplication->application_status}}</p>
                            @elseif ($tenantApplication->application_status == 'accepted')
                            <p style="color: green;">{{ $tenantApplication->application_status}}</p>
                            @endif
                        </div>
                        <div class="triple-dot" data-dropdown>
                                {{-- if($transaction['status'] == "Delivering")
                                {
                                    echo "<p style='font-size: 14px; color: #5f5f5f; cursor: pointer;' onclick='cancelOrder(" . $transaction['transactionID'] . ", this)'>Cancel order</p>";
                                }
                                else if ($transaction['status'] == "Completed")
                                {
                                    echo '
                                    <p style="font-size: 14px; color: #5f5f5f; cursor: pointer;" class="" onclick="openOldRatingForm(\'' .  $transaction['productName'] . '\' ,  ' . $transaction['productID'] . ' , ' . $review['rating'] . ' , \'' . $review['comment'] . '\')">Edit rating</p>
                                    ';
                                }
                                else if ($transaction['status'] == "Delivered")
                                {
                                    echo '
                                    <p style="font-size: 14px; color: #5f5f5f; cursor: pointer;" class="" onclick="openOldRatingForm(\'' .  $transaction['productName'] . '\' ,  ' . $transaction['productID'] . ' , ' . $review['rating'] . ' , \'' . $review['comment'] . '\')">Edit rating</p>
                                    ';
                                }
                            }
                            else
                            {
                                if($transaction['status'] == "Delivered" || $transaction['status'] == "Completed")
                                {
                                    echo '
                                        <p style="font-size: 14px; color: #5f5f5f; cursor: pointer;" class="" onclick="openRatingForm(\'' .  $transaction['productName'] . '\' ,  ' . $transaction['productID'] . ')">Rate product</p>
                                    ';

                                }
                                else if($transaction['status'] == "Delivering")
                                {
                                    echo "<p style='font-size: 14px; color: #5f5f5f; cursor: pointer;' onclick='cancelOrder(" . $transaction['transactionID'] . ", this)'>Cancel order</p>";
                                }
                            } --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>

{{-- <section id="ratingsForm" class="popup-form">
    <div class ="rate-header">Rate product</div>
    <div id="productName" class ="rate-product">Geforce GTX</div>
    <form id="ratingForm" action="" method="POST">
        <div class ="product-rating">
            <p>Product quality:</p>
            <div id="starContainer" class="rating-star">
                <i title="1" onclick="rateProduct(1)" class='bx bxs-star'></i>
                <i title="2" onclick="rateProduct(2)" class='bx bxs-star'></i>
                <i title="3" onclick="rateProduct(3)" class='bx bxs-star'></i>
                <i title="4" onclick="rateProduct(4)" class='bx bxs-star'></i>
                <i title="5" onclick="rateProduct(5)" class='bx bxs-star'></i>
            </div>
            <p id="rating-equivalent" style="margin-left: 4px;"></p>
        </div>
        <div class="form-field">
            <label>Comment</label>
            <br>
            <textarea id="review" rows="4" placeholder="Optional"></textarea>
        </div>
        <div class ="warning-text">
            <p id="ratingWarning">Geforce GTX</p>
        </div>
        <div class="form-button">
            <input id="" type="submit" name="addItem" value="Rate">
            <input type="button" value="Cancel" onclick="closeRatingForm()">        
        </div>
    </form>
</section> --}}

</main>

</body>

{{-- <script src="js/wishlist.js"></script>
<script src="js/transaction.js"></script> --}}

</html>

