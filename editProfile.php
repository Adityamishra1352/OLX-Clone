<?php
include 'assets/_dbconnect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['profilePicture']['tmp_name'];
        $fileName = $_FILES['profilePicture']['name'];
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetFilePath = "uploads/profilePictures/" . $uniqueFileName;
        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            $location = $_POST['location'];
            $mobileNumber = $_POST['mobileNumber'];
            $user_id=$_SESSION['user_id'];
            $sql="UPDATE `users` SET `location`='$location',`profilePicture`='$targetFilePath',`mobilenumber`='$mobileNumber' WHERE `user_id`='$user_id'";
            $result=mysqli_query($conn,$sql);
            if($result){
                header('location:profile.php?editProfile=true');
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
