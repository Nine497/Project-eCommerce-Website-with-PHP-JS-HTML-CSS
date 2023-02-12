<?php
require_once('../php/connect.php');
$order_id = $_GET['order_id'];
$sql = "UPDATE `orders` SET order_status = 4 WHERE order_id = $order_id";

$order_number = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `order_number` FROM `orders` WHERE `order_id` = $order_id"))['order_number'];
$order_details = mysqli_query($conn, "SELECT `product_id`, `order_count_detail` FROM `order_detail` WHERE `order_number` = '$order_number'");


while ($order_detail = mysqli_fetch_assoc($order_details)) {
    $product_id = $order_detail['product_id'];
    $order_count_detail = $order_detail['order_count_detail'];

    $update_sql = "UPDATE `product` SET `product_count` = `product_count` + $order_count_detail WHERE `product_id` = $product_id";
    $result = mysqli_query($conn, $update_sql);

    if (!$result) {
        die("Error updating product count: " . mysqli_error($conn));
    }
}

if (mysqli_query($conn, $sql)) {
    echo '<script>';
    echo "window.location=document.referrer + '?do=cancel_success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location=document.referrer + '?do=cancel_failed';";
    echo '</script>';
}
mysqli_close($conn);
?>