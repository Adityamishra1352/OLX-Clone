<?php
include 'assets/_dbconnect.php';
if(isset($_GET['auctionid'])) {
    $auction_id = $_GET['auctionid'];
    $max_bid_sql = "SELECT MAX(bid) AS max_bid FROM auctionComments WHERE auction_id = '$auction_id'";
    $max_bid_result = mysqli_query($conn, $max_bid_sql);

    if($max_bid_result) {
        $row = mysqli_fetch_assoc($max_bid_result);
        $max_bid = $row['max_bid'];
        echo json_encode(['success' => true, 'maxBid' => $max_bid]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch maximum bid amount']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Auction ID not provided']);
}

mysqli_close($conn);
?>
