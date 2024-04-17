<?php
session_start();
include 'assets/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql="SELECT * FROM `users` WHERE `email`='$email'";
    $fetch_email=mysqli_query($conn,$sql);
    if($num=mysqli_num_rows($fetch_email)){
        $rowLogin=mysqli_fetch_assoc($fetch_email);
        if(password_verify($password,$rowLogin['password'])){
            $user_id=$rowLogin['user_id'];
            $_SESSION['user_id']=$user_id;
            $_SESSION['loggedIn']=true;
            header('location:index.php?login=true');
        }
    }
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
        .loginBtn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-btn {
            padding: 13px 20px;
            width: 80%;
            cursor: pointer;
            background-color: #002f34;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            border: none;
            font-size: 15px;
        }

        .login-btn:hover {
            background-color: grey;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="imgContaniner d-flex">
                            <img src="assets/images/olx_logo.png" alt="" style="width: 20%;" class="mx-auto">
                        </div>
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                            <div class="loginBtn-container">
                                <button type="submit" class="btn login-btn">Login</button>
                            </div>
                            <div class="container d-flex justify-content-center mt-2">
                                <p>New User? <a href="login.php">REGISTER</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        window.onload = function () {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
        };
    </script>
</body>

</html>