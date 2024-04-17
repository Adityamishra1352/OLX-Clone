<?php
session_start();
include 'assets/_dbconnect.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($data['content']) && !empty($data['content'])) {
        $content = mysqli_real_escape_string($conn, $data['content']);
        $product_id = $data['auctionid'];
        $sql = "INSERT INTO auctioncomments (bid, user_id, auction_id) VALUES ('$content', '{$_SESSION['user_id']}', '$product_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $comment_sql="SELECT * FROM `auctioncomments` WHERE `bid`='$content' AND `user_id`='{$_SESSION['user_id']}'";
            $comment_result=mysqli_query($conn,$comment_sql);
            $commentRow=mysqli_fetch_assoc($comment_result);
            $user_sql="SELECT * FROM `users` WHERE `user_id`='{$_SESSION['user_id']}'";
            $user_result=mysqli_query($conn,$user_sql);
            $userRow=mysqli_fetch_assoc($user_result);
            echo json_encode(['success' => true,'profilePicture'=>$userRow['profilePicture'],'name'=>$userRow['name'],'time'=>$commentRow['time']]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error inserting comment']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Comment content is required']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>