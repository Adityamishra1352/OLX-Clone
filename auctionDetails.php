<?php
session_start();
include 'assets/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $reason=$_POST['reasonforacutioning'];
    $expectedprice=$_POST['expectedprice'];
    $endTime=$_POST['endtime'];
    $startTime=$_POST['starttime'];
    $minimumprice=$_POST['minimumprice'];
    $product_id=$_POST['product_id'];
    $sql="INSERT INTO `auctions`(`product_id`,`expectedprice`,`endtime`,`starttime`,`minimumprice`,`reason`) VALUES ('$product_id','$expectedprice','$endTime','$startTime','$minimumprice','$reason')";
    $result=mysqli_query($conn,$sql);
    if($result){
        $product_sql="UPDATE `products` SET `aution`=1 WHERE `product_id`='$product_id'";
        $product_result=mysqli_query($conn,$product_sql);
        if($product_result){
            unset($_SESSION['auctionUser']);
            header('location:product.php?productid='.$product_id.'&auction=true');
        }
    }else{
        echo mysqli_error($conn);
    }
}
?>