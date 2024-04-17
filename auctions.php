<?php 
session_start();
include 'assets/_dbconnect.php';
if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!=true){
    header('location:assets/403.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLX-Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/images/olx_logo.png" alt="Logo" width="60"
                    height="44" class="d-inline-block align-text-top" style="cursor:pointer;margin-left:5px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="addpost.php">Sell Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php" style="cursor:pointer;">
                            Profile
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container p-1 m-1 ongoingAuctions">
    <div class="container">
    <div class="row">
        <?php 
        $auctions_sql="SELECT * FROM `auctions` WHERE endtime>NOW()";
        $auctions_result=mysqli_query($conn,$auctions_sql);
        $count = 0; 
        while($auctionsRow=mysqli_fetch_assoc($auctions_result)){
            $auction_id=$auctionsRow['auction_id'];
            $product_id=$auctionsRow['product_id'];
            $product_sql="SELECT * FROM `products` WHERE `product_id`='$product_id'";
            $product_result=mysqli_query($conn,$product_sql);
            $productRow=mysqli_fetch_assoc($product_result);
            $product_title=$productRow['title'];
            $startTime=$auctionsRow['starttime'];
            $formatted_startTime = date("H:i, j F Y", strtotime($startTime));
            $product_photos = unserialize($productRow['photos']);
            $first_photo = !empty($product_photos) ? $product_photos[0] : '';
            if ($count % 3 == 0 && $count != 0) {
                echo '</div><div class="row">'; 
            }
            echo '
            <div class="col-md-4">
                <div class="card mb-1" style="width: 100%;">
                    <img src="'.$first_photo.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'.$product_title.'</h5>
                        <p class="card-text">Auction Starts on:</p>
                        <p class="card-text">'.$formatted_startTime.'</p>
                        <a href="auction.php?auctionid='.$auction_id.'" class="btn btn-success mt-1">View</a>
                    </div>
                </div>
            </div>';
            $count++;
        }
        ?>
    </div>
</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>