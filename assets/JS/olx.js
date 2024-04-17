let parentNavbar = document.getElementById("parentNavbar");
let locationList = document.getElementById("list");
let move_icon = document.getElementById("move-icon");
function showAndHideNavbarOnSmallDevices() {
    let hamburgerImage = document.querySelector('.hamb');
    hamburgerImage.src = "images/close.png";
    parentNavbar.classList.toggle("active");
    locationList.classList.remove("show");
    const searchDiv = document.getElementById("search-div");
    if (searchDiv.style.display === "block") {
      searchDiv.style.display = "none";
    }
    if (!parentNavbar.classList.contains("active")) {
      move_icon.classList.remove("rotate");
      hamburgerImage.src = "images/hamb.png";
    }
    searchInput.value = "";
  }
  function showAndHideLocationList() {
    locationList.classList.toggle("show");
    move_icon.classList.toggle("rotate");
  }