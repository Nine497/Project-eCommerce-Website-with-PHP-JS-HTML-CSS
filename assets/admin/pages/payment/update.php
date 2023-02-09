<?php
include_once('../authen.php');
include_once('../../connect.php');

$payment_id = $_POST['payment_id'];
$payment_status = $_POST['status'];
$order_id = $_POST['order_id'];
if ($payment_status == "ชำระเรียบร้อย") {
    $update_sql1 = "UPDATE `payment` SET `payment_status` = 'ชำระเรียบร้อย' WHERE `payment_id` = $payment_id";
    $update1 = mysqli_query($conn, $update_sql1);
    $update_sql2 = "UPDATE `orders` SET `order_status` = 2 WHERE `order_id` = $order_id";
    if (mysqli_query($conn, $update_sql2)) {
        echo '<script>';
        header("Refresh:0");
        echo "window.location='index.php?do=updated_success';";
        echo '</script>';
    } else {
        header('Refresh:0');
        echo '<script>';
        echo "window.location='index.php?do=updated_failed';";
        echo '</script>';
    }
} else {
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

    $update_sql1 = "UPDATE `payment` SET `payment_status` = 'หลักฐานการโอนเงินผิด' WHERE `payment_id` = $payment_id";
    $update1 = mysqli_query($conn, $update_sql1);
    $update_sql2 = "UPDATE `orders` SET `order_status` = 6 WHERE `order_id` = $order_id";
    if (mysqli_query($conn, $update_sql2)) {
        echo '<script>';
        header("Refresh:0");
        echo "window.location='index.php?do=updated_success';";
        echo '</script>';
    } else {
        header('Refresh:0');
        echo '<script>';
        echo "window.location='index.php?do=updated_failed';";
        echo '</script>';
    }
}
?>