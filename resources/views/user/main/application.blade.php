<!DOCTYPE html>
<html>

<head>
    <title>PCEX</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/wishlist.css">
    <link rel="stylesheet" href="css/transaction.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body> 

<!-- header section -->
<?php include_once "include/header.php"?>

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
                            <p>Product</p>
                        </div>
                        <div class="product-name"></div>  
                        <div class="status">
                            <p>Quantity</p>
                        </div>
                        <div class="status">
                            <p>Payment method</p>
                        </div>
                        <div class="status">
                            <p>Status</p>
                        </div>
                        <div class="triple-dot">    </div>
                    </div>
                    <?php
                        include_once "conn.php";

                        // get the first 16 product in the database
                        $SQL = "SELECT transactions.*, products.productName, products.productImage, products.price, products.category
                                FROM transactions
                                JOIN products ON transactions.productId = products.productId
                                WHERE transactions.buyerID=?
                                ORDER BY transactions.transaction_date DESC; ";

                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $SQL))
                        {
                            echo "an error has occured";
                        }
                        mysqli_stmt_bind_param($stmt, 'i', $userID);
                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);   
                
                        mysqli_stmt_close($stmt);

                        $numRows = mysqli_num_rows($results);

                        if($numRows === 0)
                        {
                            echo "<div class='no-items'><p>You currently don't have any transaction  .</p></div>";
                        }
                    
                        while($transaction = mysqli_fetch_assoc($results))
                        {
                    ?>
                    <div class="row-content">
                        <div class="product-pic">
                            <img src="resource/products/<?php echo $transaction['productImage']; ?>">
                        </div>
                        <div class="product-name">
                            <div>
                                <p><?php echo $transaction['productName']; ?></p>
                                <?php if($transaction["method"] != "Exchange") {?>
                                    <div style="margin-top: 10px; display: flex; flex-direction: column;">
                                        <div style="display: flex; flex-direction: row; font-size: 14px;">
                                            <p style="color: #5f5f5f; width: 100px;">Price: </p><p style="color: orange;"><?php echo '₱ ' . $transaction['totalPrice']; ?></p>
                                        </div>
                                        <div style="display: flex; flex-direction: row; font-size: 14px; margin-top: 3px;">
                                            <p style="color: #5f5f5f; width: 100px;">Delivery fee: </p><p style="color: orange;"><?php echo '₱ ' . $transaction['shippingFee']; ?></p>
                                        </div>
                                        <div style="display: flex; flex-direction: row; font-size: 14px; margin-top: 3px;">
                                            <p style="color: #5f5f5f; width: 100px;">Total: </p><p style="color: orange; font-size: 16px;"><?php echo '₱ ' . $transaction['totalPrice'] + $transaction['shippingFee']; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="status">
                            <p><?php echo $transaction['quantity']; echo ($transaction['quantity'] == 1) ? " piece" : " pieces"; ?></p>
                        </div>
                        <div class="status">
                            <p><?php echo $transaction['method'];?></p>
                        </div>
                        <div class="deliveryStatus">
                            <?php 
                                if($transaction["status"] == "Cancelled")
                                {
                                    echo '
                                        <p style="color: red;">' . $transaction["status"] . '</p>
                                    ';
                                }
                                else if ($transaction["status"] == "Completed")
                                {
                                    echo '
                                        <p style="color: green;">' . $transaction["status"] . '</p>
                                    ';
                                }
                                else if ($transaction["status"] == "Delivering")
                                {
                                    echo '
                                        <p style="color: orange;">' . $transaction["status"] . '</p>
                                    ';
                                }
                                else if ($transaction["status"] == "Delivered")
                                {
                                    echo '
                                        <p style="color: green;">' . $transaction["status"] . '</p>
                                    ';
                                }
                                else
                                {
                                    echo '
                                        <p>' . $transaction["status"] . '</p>
                                    ';
                                }
                                
                            ?>
                        </div>
                        <div class="triple-dot" data-dropdown>
                        <?php
                            
                            $SQL = "SELECT * FROM `productreview` WHERE productID = {$transaction['productID']} AND userID= {$userID}";

                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $SQL))
                            {
                                echo "an error has occured";
                            }
                            mysqli_stmt_execute($stmt);
                            $reviewResult = mysqli_stmt_get_result($stmt);   
                            if($review = mysqli_fetch_assoc($reviewResult))
                            {
                                if($transaction['status'] == "Delivering")
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
                            }
                        ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="ratingsForm" class="popup-form">
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
</section>

</main>

</body>

{{-- <script src="js/wishlist.js"></script>
<script src="js/transaction.js"></script> --}}

</html>

