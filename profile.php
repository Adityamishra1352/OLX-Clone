<?php
session_start();
include 'assets/_dbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLX-Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .download {
            margin: 100px 0 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f7f8f9;
        }

        .images {
            width: 400px;
        }

        .text {
            border-right: 2px solid #cacdce;
        }

        .text h1 {
            padding: 20px 20px 10px 20px;
            font-size: 35px;
        }

        .text p {
            padding: 10px 20px 20px 20px;
            font-size: 20px;
        }

        .download_store p {
            padding: 20px 20px 20px 0;
            font-weight: bold;
            font-size: 17px;
        }

        .download_store {
            padding-left: 30px;
        }

        .download_store img {
            width: 140px;
            padding-left: 20px;
        }

        .Main_footerP {
            background-color: #ebeeef;
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 1200px;
            margin: auto;
        }

        .footer_box h2 {
            font-size: 17px;
            margin: 10px 0 15px 0;
        }

        .footer_box p {
            margin: 8px 0 8px 0;
        }

        /* ___________________________footer 2________________________________________________ */

        .footer2 {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            background-color: #002f34;
        }

        .footer2 p {
            color: white;
            position: relative;
            margin-right: 500px;
            font-size: 15px;
        }
    </style>
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
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer;">
                            Edit Profile
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['editProfile']) && $_GET['editProfile'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Your Profile has been updated successfully!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>
    <div class="container p-2">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
        $result = mysqli_query($conn, $sql);
        $rowUser = mysqli_fetch_assoc($result);
        $profilePicture = $rowUser['profilePicture'];
        $name = $rowUser['name'];
        $email = $rowUser['email'];
        $mobilenumber = $rowUser['mobilenumber'];
        $location = $rowUser['location'];
        echo '<div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="' . $profilePicture . '" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">' . $name . '</h5>
              <p class="card-text">' . $location . '</p>
              <p class="card-text">' . $mobilenumber . '</p>
            </div>
          </div>
        </div>
      </div>';
        ?>
    </div>
    <div class="container p-2">
        <h5>Products</h5>
        <hr>
        <div class="row">
            <?php
            $product_sql = "SELECT * FROM `products` WHERE `user_id`='$user_id'";
            $product_result = mysqli_query($conn, $product_sql);

            while ($product_row = mysqli_fetch_assoc($product_result)) {
                $product_id = $product_row['product_id'];
                $product_title = $product_row['title'];
                $product_description = $product_row['description'];
                $product_price = $product_row['expectedprice'];
                $product_photos = unserialize($product_row['photos']);
                $product_location = $product_row['location'];
                $product_sold = $product_row['sold'];
                $product_auction = $product_row['aution'];
                echo '<div class="col"><div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">';
                foreach ($product_photos as $key => $photo) {
                    echo '<div class="carousel-item w-100 ' . ($key == 0 ? 'active' : '') . '" style="max-width: 52%; max-height: 30%;">
                  <img src="' . $photo . '" class="d-block img-fluid" alt="..." style="max-width: 100%; max-height: 100%;">
              </div>';
                }
                echo '</div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="top: 7%; transform: translateY(-50%);transform: translateX(-39%);">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="top: 54%; transform: translateY(-50%);right:44%;">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
              </button>
              </div>';
                echo '<div class="card" style="width: 18rem;">
              <div class="card-body">
              <h5 class="card-title">' . $product_title . '</h5>
              <p class="card-text">' . $product_description . '</p>
              <p class="card-text">' . $product_price . '</p>
              <a href="product.php?productid=' . $product_id . '" class="btn btn-primary">View Product</a>
              </div>
              </div></div>';
            }
            ?>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="imgContaniner d-flex">
                        <img src="assets/images/olx_logo.png" alt="" style="width: 20%;" class="mx-auto">
                    </div>
                </div>
                <div class="modal-body">
                    <form action="editProfile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="profilePhoto" class="form-label">Change Profile Photo</label>
                            <input type="file" class="form-control" id="profilePhoto" name="profilePicture">
                        </div>
                        <div class="mb-3">
                            <label for="mobileNumber" class="form-label">Change Mobile Number</label>
                            <input type="text" name="mobileNumber" id="mobileNumber" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="download">
        <img src="assets/images/footar.jpg" class="images" />

        <div class="text">
            <h1>TRY THE OLX APP</h1>
            <p>
                Buy, sell and find just about anything using <br />
                the app on your mobile.
            </p>
        </div>
        <div class="download_store">
            <p>GET YOUR APP TODAY</p>
            <img src="assets/images/play store.png" alt="" />
        </div>
    </div>

    <hr />
    <div class="Main_footer">
        <div class="footer">
            <div class="footer_box">
                <h2>POPULAR CATEGORIES</h2>
                <p>Cars</p>
                <p>Flats for rent</p>
                <p>Mobile Phone</p>
                <p>Jobs</p>
            </div>
            <div class="footer_box">
                <h2>TRENDING SEARCHES</h2>
                <p>Bikes</p>
                <p>Watches</p>
                <p>Books</p>
                <p>Dogs</p>
            </div>
            <div class="footer_box">
                <h2>ABOUT EMPG</h2>
                <p>OLX Blog</p>
                <p>Careers</p>
                <p>Contact Us</p>
                <p>OLX for Business</p>
            </div>
            <div class="footer_box">
                <h2>Help</h2>
                <p>Sitemap</p>
                <p>Terms of use</p>
                <p>Privacy Policy</p>
            </div>
        </div>
    </div>

    <!-- ______________________________footer 2_______________________________________ -->

    <div class="footer2">
        <p>JUET in India .&copy; 2006-2024 OLX</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>