<?php
require_once('../php/connect.php');
$order_id = $_GET['order_id'];
$sql = "UPDATE `orders` SET order_status = 4 WHERE order_id = $order_id";
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