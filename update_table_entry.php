<?php
include 'assets/_dbconnect.php';
if(isset($_GET['auctionid'])) {
    $auction_id = $_GET['auctionid'];
    $data = json_decode(file_get_contents('php://input'), true);
    $maxBid = $data['maxBid'];
    $userId = $data['userId'];
    $update_sql = "UPDATE auctions SET auction_amount = '$maxBid', customer_id = '$userId' WHERE auction_id = '$auction_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if($update_result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update table']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Auction ID not provided']);
}
mysqli_close($conn);
?>
