<?php
session_start();
include 'assets/_dbconnect.php';
if (!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] != true) {
  header('location:assets/403.php');
}
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
    .product_description {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .comments-section::-webkit-scrollbar {
      width: 5px;
    }

    .comments-section::-webkit-scrollbar-track {
      background: transparent;
    }

    .comments-section::-webkit-scrollbar-thumb {
      background-color: #212121;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/olx_logo.png" alt="Logo" width="60" height="44"
          class="d-inline-block align-text-top" style="cursor:pointer;margin-left:5px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
  <?php
  $auction_id = $_GET['auctionid'];
  $auction_sql = "SELECT * FROM `auctions` WHERE `auction_id`='$auction_id'";
  $auction_result = mysqli_query($conn, $auction_sql);
  $auctionRow = mysqli_fetch_assoc($auction_result);
  $auction_endtime = $auctionRow['endtime'];

  $product_id = $auctionRow['product_id'];
  $product_sql = "SELECT * FROM `products` WHERE `product_id`='$product_id'";
  $product_result = mysqli_query($conn, $product_sql);
  $productRow = mysqli_fetch_assoc($product_result);
  $product_photos = unserialize($productRow['photos']);
  $product_title = $productRow['title'];
  $product_description = $productRow['description'];
  $startTime = $auctionRow['starttime'];
  $endTime = $auctionRow['endtime'];
  $formatted_startTime = date("H:i, j F Y", strtotime($startTime));
  $formatted_endTime = date("H:i, j F Y", strtotime($endTime));
  ?>
  <div class="row container">
    <div class="product_description container col-md-6">

      <div class="card text-center text-bg-dark" style="width:100%;">
        <div class="card-header">
          Auction Starts On: <?php echo $formatted_startTime; ?>

        </div>
        <div class="corousel_container">
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
        <div class="card-body">
          <h5 class="card-title"><?php echo $product_title; ?></h5>
          <p class="card-text"><?php echo $product_description; ?></p>
          <p class="card-text">Minimum Bid Amount: <?php echo "Rs. " . $auctionRow['minimumprice']; ?></p>
          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
          <p class="card-text"><?php echo $productRow['location']; ?></p>
        </div>
        <div class="card-footer text-body-light">
          Auction end on: <?php echo $formatted_endTime; ?>
        </div>
      </div>
    </div>
    <div class="comments_container col-md-6 container">
      <div class="comments-section mt-2 pt-2 pb-2 border border-black rounded" style="height:30rem;overflow-y:auto">
        <div class="maximumBidAmount "
          style="border-bottom:1px solid black; display:flex;justify-content:center;align-items:center;">
          Current Bid Amount: Rs. 323213
        </div>
        <div class="commentsContainer" style="overflow-y:auto;">
          <div class="comment-div">
            <?php
            $auction_id = $_GET['auctionid'];
            $comment_sql = "SELECT * FROM `auctionComments` WHERE `auction_id`='$auction_id' ORDER BY `time` DESC";
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
              echo '<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="width:100%;">
                        <div class="toast-header">
                            <img src="' . $user_profile_photo . '" class="rounded me-2" alt="..." style="width:5%">
                            <strong class="me-auto">' . $user_comment_row["name"] . '</strong>
                            <small>' . $commentRow['time'] . '</small>
                            </div>
                        <div class="toast-body">
                            ' . $commentRow['bid'] . '
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
      </div>
      <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="commentContent"></textarea>
        <label for="floatingTextarea">Enter Bid Amount:</label>
      </div>
      <button id="submitComment" class="btn btn-outline-success mt-2">Submit</button>
    </div>
  </div>
  <div class="modal fade" id="auctionEndedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Auction for <?php echo $product_title;?> has ended.</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Thank you for participating!!</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      var endTime = new Date("<?php echo $auction_endtime; ?>");
      if (new Date() > endTime) {
        var auctionEndedModal = new bootstrap.Modal(document.getElementById('auctionEndedModal'), {
          keyboard: false
        });
        auctionEndedModal.show();
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    function updateMaxBidAmount() {
      var auctionId = <?php echo json_encode($_GET['auctionid']); ?>;
      fetch('get_max_bid.php?auctionid=' + auctionId)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            var maxBidElement = document.querySelector('.maximumBidAmount');
            maxBidElement.textContent = 'Current Bid Amount: Rs. ' + data.maxBid;
            console.log(data.success);
          } else {
            console.error('Failed to fetch maximum bid amount');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    updateMaxBidAmount();
    document.getElementById('submitComment').addEventListener('click', function () {
      var commentContent = document.getElementById('commentContent').value.trim();
      var auctionId = <?php echo json_encode($_GET['auctionid']); ?>;

      if (commentContent === '') {
        return;
      }

      fetch('submit_bid.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          content: commentContent,
          auctionid: auctionId
        }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            updateMaxBidAmount();
            var commentDiv = document.querySelector('.comment-div');
            var newComment = document.createElement('div');
            newComment.classList.add('toast', 'show');
            newComment.setAttribute("role", "alert");
            newComment.setAttribute("style", "width:100%;")
            newComment.setAttribute("aria-live", "assertive");
            newComment.setAttribute("aria-atomic", "true");
            newComment.innerHTML = `
                    <div class="toast-header">
                        <img src="${data.profilePicture}" class="rounded me-2" alt="Profile Picture" style="width:5%">
                        <strong class="me-auto">${data.name}</strong>
                        <small>${data.time}</small>
                    </div>
                    <div class="toast-body">${commentContent}</div>
                `;
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