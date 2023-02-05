<?php
require_once('../php/connect.php');
$cart_id = $_GET['cart_id'];
$sql = "DELETE FROM `cart` WHERE cart_id = $cart_id";
if (mysqli_query($conn, $sql)) {
    echo '<script>';
    echo "window.location=document.referrer + '?do=del_success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location=document.referrer + '?do=del_failed';";
    echo '</script>';
}
mysqli_close($conn);
?>