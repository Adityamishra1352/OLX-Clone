<?php session_start();
include 'assets/_dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Online Trading Platform</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/olx.css" />
</head>

<body>
  <!--___________________________________________Navbar________________________________________________-->
  <div class="header" id="header">
    <div class="img-container">
      <img id="reloadAdsImage" src="assets/images/olx_logo.png" alt="" style="cursor: pointer" />
      <img onclick="showAndHideNavbarOnSmallDevices()" class="hamb" src="assets/images/hamb.png" alt="" />
    </div>
    <div onclick="showAndHideLocationList()" class="location-box">
      <div class="select-location">
        <p id="text">Select Your Location</p>
        <i id="move-icon" class="fa-solid fa-chevron-down"></i>
      </div>
      <ul class="option-box" id="list">
        <li class="option" onclick="selectLocation('See ads in all India')">
          <i class="fa-solid fa-location-dot blue"></i>
          <p class="blue">See ads in all India</p>
        </li>
        <hr />
        <li class="option" onclick="selectLocation('Delhi ,India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Delhi ,India</p>
        </li>
        <li class="option" onclick="selectLocation('Madhya Pradesh, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Madhya Pradesh, India</p>
        </li>
        <li class="option" onclick="selectLocation('Uttar Pradesh, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Uttar Pradesh, India</p>
        </li>
        <li class="option" onclick="selectLocation('Goa, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Goa, India</p>
        </li>
        <li class="option" onclick="selectLocation('Punjab, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Punjab, India</p>
        </li>
        <li class="option" onclick="selectLocation('Hyderabad, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Hyderabad, India</p>
        </li>
        <li class="option" onclick="selectLocation('Gujrat, India')">
          <i class="fa-solid fa-location-dot"></i>
          <p>Gujrat, India</p>
        </li>
      </ul>
    </div>
    <div class="search-container">
      <div class="search-box">
        <input oninput="displayAvailableKeywords()" onclick="searchInputOutlineAqua()" type="text" class="search"
          id="search-box" placeholder="Find Cars, Mobile Phones and more..." />
        <p><i class="fa-solid fa-magnifying-glass"></i></p>
      </div>
      <div class="search-div" id="search-div" style="display: none">
        <ul id="keyword-list">
        </ul>
      </div>
    </div>
    <div class="container" id="parentNavbar">
      <!-- <div id="showads" class="myAdDiv">
        <img class="myAdImg" src="assets/images/myAdIcon.svg" alt="" />
        <p>My Ads</p>
      </div> -->
      <div class="login-button">
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
          $user_id = $_SESSION['user_id'];
          $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
          $result = mysqli_query($conn, $sql);
          $rowUser = mysqli_fetch_assoc($result);
          $firstName = explode(' ', $rowUser['name'])[0];
          echo '<p onclick="window.location.href=`profile.php`" style="margin-left:10px;">Hello ' . $firstName . '</p>';
        } else {
          echo '<p class="loginText" onclick="window.location.href=`register.php`">Login/Signup</p>';
        }
        ?>

      </div>
      <?php
      if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
        echo '<p class="sell_button">
        <button class="sellWrapper" onclick="window.location.href=`addpost.php`">
          <i class="fa-regular fa-plus" style="margin-right:2px;"></i>
          <p>SELL</p>
        </button>
      </p><p class="logoutBtn" onclick="window.location.href=`logout.php`">Logout</p>';
      } else{
        echo '<p class="sell_button">
        <button class="sellWrapper" onclick="window.location.href=`register.php?sell=true`">
          <i class="fa-regular fa-plus" style="margin-right:2px;"></i>
          <p>SELL</p>
        </button>
      </p>';
      }
      ?>
      
    </div>
  </div>
  <!--___________________________________________Navbar 2________________________________________________-->
  <div class="navbar2-parent">
    <div class="navbar2">
      <ul>
        <!-- <h5 id="showads">Show My Ads Only</h5> -->
        <h5>All CATEGORIES</h5>
        <i class="fa-solid fa-chevron-down move-icon"></i>
        <li>Mobile Phones</li>
        <li>Cars</li>
        <li>Motorcycles</li>
        <li>Houses</li>
        <li>TV-Video-Audio</li>
        <li>Tablets</li>
        <li>Land & Plots</li>
        <li onclick="window.location.href=`auctions.php`" style="cursor:pointer;">Auctions</li>
      </ul>
    </div>
  </div>

  <!--___________________________________________Top image________________________________________________-->

  <div class="top_image">
    <img src="assets/images/top.jpg" alt="" />
  </div>
  <!-- ___________________________________________Product________________________________________________  -->
  <div class="product">
    <!-- rows will be added here through javascript and each row has 4 post boxes. -->
    <!-- Loader element -->
    <div class="loader" id="loader"></div>
  </div>

  <!-- _______________________________________download picture__________________________________ -->

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

  <!-- ______________________________footer_______________________________________ -->

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

  <!-- <script src="js/init-firebase.js"></script> -->
  <script src="assets/js/olx.js"></script>
</body>

</html>