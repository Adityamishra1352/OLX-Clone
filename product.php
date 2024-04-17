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

        .comments-section {
            height: 12rem;
            overflow-y: auto;
            overflow-x: auto;
            /* Enable vertical scrolling */
            padding-right: .5rem;
            /* Add some padding to avoid overlapping with scrollbar */
        }
    </style>
    <?php
    $authenticateUser = 0;
    if (isset($_SESSION['auctionUser']) && $_SESSION['auctionUser'] == true) {
        $authenticateUser = 1;
    }
    ?>
    <script>
        var authenticateUser = <?php echo $authenticateUser; ?>;
        if (authenticateUser == 1) {
            window.onload = function () {
                var auctionModalvariable = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                auctionModalvariable.show();
            }
        }
        console.log(authenticateUser);
    </script>
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

                    <?php
                    $product_id = $_GET['productid'];
                    $product_auction_sql = "SELECT * FROM `products` WHERE `product_id`='$product_id'";
                    $product_auction_result = mysqli_query($conn, $product_auction_sql);
                    $product_auction_row = mysqli_fetch_assoc($product_auction_result);
                    if ($_SESSION['user_id'] == $product_auction_row['user_id'] && $product_auction_row['aution']==0) {
                        echo '<li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginagainModal" style="cursor:pointer">
                            Auction the product
                        </a>
                        </li>';
                    }
                    ?>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php 
    if(isset($_GET['auction']) && $_GET['auction']==true){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The product is set to be auctioned!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Make this product available for auction</h1>
                </div>
                <div class="modal-body">
                    <form action="auctionDetails.php" method="post">
                        <div class="mb-3">
                            <label for="reasonforauctioning" class="form-label">Reason for auctioning:</label>
                            <input type="text" class="form-control" id="reasonforauctioning" name="reasonforacutioning">
                        </div>
                        <div class="mb-3">
                            <label for="expectedprice" class="form-label">Expected Price:</label>
                            <input type="number" class="form-control" id="expectedprice" placeholder="Rs." name="expectedprice">
                        </div>
                        <div class="mb-3">
                            <label for="expectedprice" class="form-label">Minimum Price:</label>
                            <input type="number" class="form-control" id="expectedprice" placeholder="Rs." name="minimumprice">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Auction Start Time:</label>
                            <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="starttime">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Auction End Time:</label>
                            <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="endtime">
                            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="loginagainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your password to continue:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="auctionLogin.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            <input type="hidden" name="productid" value="<?php echo $product_id; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="toast position-fixed top-2 end-0" id="commentAddition" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header">
            <img src="assets/images/olx_logo.png" class="rounded me-2" alt="..." style="width:10%;">
            <strong class="me-auto">OLX</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Comment Added Succesfully!!
        </div>
    </div>
    <?php
    include 'assets/_dbconnect.php';
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['productid'])) {
            $product_id = $_GET['productid'];
            $sql = "SELECT * FROM `products` WHERE `product_id`='$product_id'";
            $result = mysqli_query($conn, $sql);
            $product_row = mysqli_fetch_assoc($result);
            $product_title = $product_row['title'];
            $product_description = $product_row['description'];
            $product_price = $product_row['expectedprice'];
            $product_photos = unserialize($product_row['photos']);
            $product_location = $product_row['location'];
            $product_sold = $product_row['sold'];
            $product_auction = $product_row['aution'];
        }
    }
    ?>
    <div class="container p-2 row">
        <div class="col-md-6">
            <?php
            echo '<div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">';
            foreach ($product_photos as $key => $photo) {
                echo '<div class="carousel-item ' . ($key == 0 ? 'active' : '') . '">
                <img src="' . $photo . '" class="d-block w-100" alt="...">
              </div>';
            }
            echo '</div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
              </button>
              </div>
              ';
            ?>
        </div>

        <div class="col-md-6" data-bs-spy="scroll">
            <div class="description-block">
                <h2>Description</h2>
                <?php
                echo '<h3>' . $product_title . '</h3>
                <h3 class="text-secondary">' . $product_price . '</h3><span class="text-secondary fs-6">' . $product_description . '</span>';
                ?>
                <!-- <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, neque totam vel molestiae
                    at velit recusandae repellat possimus voluptatem fuga assumenda reiciendis. Laudantium quia
                    dolore provident hic earum voluptatem minima?</span><br> -->

            </div>
            <div class="comments-section mt-2 pt-2 pb-2 border border-black rounded" style="height:12rem;">
                <div class="comment-div">
                    <?php
                    $product_id = $_GET['productid'];
                    $comment_sql = "SELECT * FROM `comments` WHERE `product_id`='$product_id'";
                    $comments_result = mysqli_query($conn, $comment_sql);
                    while ($commentRow = mysqli_fetch_assoc($comments_result)) {
                        $comment_user_id = $commentRow['user_id'];
                        $comment_user_sql = "SELECT * FROM `users` WHERE `user_id`='$comment_user_id'";
                        $comment_user_result = mysqli_query($conn, $comment_user_sql);
                        $user_comment_row = mysqli_fetch_assoc($comment_user_result);
                        $user_profile_photo = $user_comment_row['profilePicture'];
                        if ($user_profile_photo == NULL) {
                            $user_profile_photo = 'uploads/profilePictures/default.jpg';
                        }
                        echo '<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="width:100%">
                        <div class="toast-header">
                            <img src="' . $user_profile_photo . '" class="rounded me-2" alt="..." style="width:5%">
                            <strong class="me-auto">' . $user_comment_row["name"] . '</strong>
                            <small>' . $commentRow['time'] . '</small>
                        </div>
                        <div class="toast-body">
                            ' . $commentRow['comment'] . '
                        </div>
                    </div>
                    ';
                        // echo '<div class="comment container m-1 p-1" style="width:100%;">';
                        // echo '<span class="text-secondary">' . $commentRow['comment'] . '</span>';
                        // echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="commentContent"></textarea>
                <label for="floatingTextarea">Comments</label>
            </div>
            <button id="submitComment" class="btn btn-outline-success mt-2">Submit</button>
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
        <script>
            document.getElementById('submitComment').addEventListener('click', function () {
                var commentContent = document.getElementById('commentContent').value.trim();
                var productId = <?php echo json_encode($_GET['productid']); ?>;

                if (commentContent === '') {
                    return;
                }

                fetch('submit_comment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        content: commentContent,
                        productid: productId
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const addcommentToast = document.querySelector("#commentAddition");
                            addcommentToast.classList.add("show");
                            var commentDiv = document.querySelector('.comment-div');
                            var newComment = document.createElement('div');
                            newComment.classList.add('toast', 'show');
                            newComment.setAttribute("role", "alert");
                            newComment.setAttribute("aria-live", "assertive");
                            newComment.setAttribute("atomic", "true");
                            newComment.setAttribute("style", "width:100%");
                            var toastHeader = document.createElement('div');
                            toastHeader.classList.add('toast-header');
                            newComment.innerHTML = '<span class="text text-secondary">' + commentContent + '</span>';
                            commentDiv.prepend(newComment);
                            document.getElementById('commentContent').value = '';
                        } else {
                            console.error('Comment submission failed', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        </script>
</body>

</html>