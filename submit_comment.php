<?php
session_start();
include 'assets/_dbconnect.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($data['content']) && !empty($data['content'])) {
        $content = mysqli_real_escape_string($conn, $data['content']);
        $product_id = $data['productid'];
        $sql = "INSERT INTO comments (comment, user_id, product_id) VALUES ('$content', '{$_SESSION['user_id']}', '$product_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(['success' => true]);
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