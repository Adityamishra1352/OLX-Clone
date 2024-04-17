<?php
session_start();
include 'assets/_dbconnect.php'; 
$user_id=$_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $user_result=mysqli_query($conn,$user_sql);
    $user_row=mysqli_fetch_assoc($user_result);
    $password=$_POST['password'];
    $product_id=$_POST['productid'];
    if(password_verify($password,$user_row['password'])){
        $_SESSION['auctionUser']=true;
        header('location:product.php?productid='.$product_id);
    }
}
?>