<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLX-Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand m-4 mt-0 mb-0 d-flex justify-content-center" href="index.php">
                <i class="fa-solid fa-arrow-left mt-2"></i>
                <img src="assets/images/olx_logo.png" alt="Logo" width="60" height="44"
                    class="d-inline-block align-text-top" style="cursor:pointer;margin-left:5px;">
            </a>
        </div>
    </nav>

    <nav aria-label="breadcrumb" style="margin-left: 5px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sell Product</li>
        </ol>
    </nav>
    <div class="container border border-rounded border-black p-2"
        style="display:flex;align-items:center;justify-content:center; width:80%;margin-top:10px;">
        <form method="post" action="sellproduct.php" style="width:90%;" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Add Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" required>
                <div id="titleHelp" class="form-text">Mention the key features of your item(e.g. brand,model,age,type)
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required
                    aria-describedby="descriptionHelp">
                <div id="descriptionHelp" class="form-text">Include condition,features and reason for selling.</div>
            </div>
            <div class="mb-3">
                <label for="expectedprice" class="form-label">Expected Price</label>
                <input type="number" placeholder="Rs |" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <h6>UPLOAD UP TO 10 PHOTOS</h6>
                <label for="photo_1" class="photo" style="padding: 10px;border:2px solid gray;"><img
                        src="assets/images/icon.svg" alt=""><input required type="file" name="photos[]" class="form-control"
                        id="photo_1" style="
                width:20%;
                visibility:hidden;
                  position: absolute;
                  left: 50px;
                  right: 50px;
                " multiple /></label>
            </div>
            <div class="mb-3">
                <label for="locationList">Location:</label>
                <select class="form-select" id="locationList" name="location">
                    <option selected>Choose Region</option>
                    <option value="delhi">Delhi,India</option>
                    <option value="rewa">Rewa, India</option>
                    <option value="bulandshahr">Bulandshahr,India</option>
                    <option value="mumbai">Mumbai,India</option>
                    <option value="amritsar">Amritsar,India</option>
                    <option value="goa">Goa,India</option>
                </select>
            </div>
            <div class="mb-3">
            <label for="mobilenumber" class="form-label">Mobile Number</label>
                <input type="text" placeholder="+91 |" class="form-control" required id="number" name="mobilenumber">
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>