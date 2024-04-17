<?php
session_start();
$user_id=$_SESSION['user_id'];
include 'assets/_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $expectedprice=$_POST['price'];
    $location=$_POST['location'];
    $phonenumber=$_POST['mobilenumber'];
    $uploadedFiles = [];
    if(isset($_FILES['photos'])) {
        $uploadedFiles = [];
        foreach ($_FILES['photos']['tmp_name'] as $key => $tempFilePath) {
            $fileName = $_FILES['photos']['name'][$key];
            $fileError = $_FILES['photos']['error'][$key];
            if ($fileError == UPLOAD_ERR_OK) {
                $uniqueFileName = uniqid() . '_' . $fileName;
                $targetFilePath = "uploads/" . $uniqueFileName;
                if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                    $uploadedFiles[] = $targetFilePath;
                } else {
                    echo "Error uploading file $fileName<br>";
                }
            } else {
                echo "Error uploading file $fileName<br>";
            }
        }
        $serializedFiles = serialize($uploadedFiles);
        echo $serializedFiles;
    } else {
        echo "No files uploaded<br>";
    }
    $sql="INSERT INTO `products`(`title`,`description`,`expectedprice`,`photos`,`location`,`phonenumber`,`user_id`)VALUES('$title','$description','$expectedprice','$serializedFiles','$location','$phonenumber','$user_id')";
    $sql_result=mysqli_query($conn,$sql);
    if($sql_result){
        header('location:profile.php?productadd=true');
    }
    else{
        echo mysqli_error($conn);
    }
}
?>