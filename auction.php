<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Online Trading Platform - Buy and Sell for free anywhere in india with Online Trading Platform online
    classified</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/all.css">
</head>
<body class="w-100">
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand logo" href="#"><img src="img/Capture-removebg-preview.png" width="60px" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <div class="form-group has-search position-relative">
              <span class="fa fa-search form-control-feedback position-absolute"></span>
              <input type="text" class="form-control form-input" placeholder="Delhi, India">
            </div>
          </li>
          <li class="nav-item">
            <div class="form-group has-search">
              <input type="text" class="form-control form-input find-car"
                placeholder="Search Auction">
            </div>
          </li>
          <button type="button" class="btn login-link ml-5" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Login</button>

          <li class="nav-item">
            <a href="" class="nav-link"><button class="btn sell-btn sell"><i
                  class="fas fa-plus plus-icon"></i>&nbsp;Sell</button></a>
          </li>

      </div>
    </div>
  </nav>    
  <!-- mainpage -->
  <main class="mt-2 container mainpage row">
    <div class="col-md-6">
    <div id="carouselExampleFade" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="IMG/image_2.jfif" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="IMG/image_3.jfif" class="d-block w-100" alt="...">
      </div>
    <div class="carousel-item">
      <img src="IMG/image_4.jfif" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev" style="opacity:0">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="opacity:0">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    <div class="col-md-6" data-bs-spy="scroll">
      <div class="description-block">
      <h2>Description</h2>
      <h3>Maruti Alto</h3>
      <h3 class="text-secondary">Rs. 120000</h3>
      <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, neque totam vel molestiae at velit recusandae repellat possimus voluptatem fuga assumenda reiciendis. Laudantium quia dolore provident hic earum voluptatem minima?</span><br>
      <span class="text-secondary fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, excepturi eos odit dolorum iure velit eligendi aliquam nemo, veritatis assumenda quis saepe sapiente cupiditate officia repudiandae qui reiciendis maiores delectus.</span>
      </div>
      <div class="comments-section mt-2">
        <div class="comment-div">
          <div class="comment container m-1 p-1">
            <span class="text text-secondary">Lorem ipsum dolor quia ad, quae temporibus reprehenderit sequi velit quas et eligendi dolore, nobis sit facere veritatis atque?</span>
          </div>
          </div>
          <div class="form-floating">
  <textarea class="form-control comment-textarea" placeholder="  Your bid amount" id="floatingTextarea"></textarea>
</div>
            <button id="submit" class="btn btn-outline-success mt-2">Submit</button>
      </div>
    </div>
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Time for the bidding has ended please visit again later.</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
function showModal() {
  document.getElementById("exampleModal").style.display = "block";
}
let startTime = Date.now();

function checkTime() {
  let elapsedTime = Date.now() - startTime;

  if (elapsedTime > 2 * 60 * 1000) {
    showModal();
    clearInterval(intervalId);
  }
}
let intervalId = setInterval(checkTime, 1000);

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
