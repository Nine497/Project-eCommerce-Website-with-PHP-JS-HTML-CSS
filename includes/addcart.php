<?php
session_start();
require_once '../php/connect.php';

date_default_timezone_set("Asia/Bangkok");

error_reporting(~E_NOTICE);

if (!isset($_SESSION['mem_id'])) {
    header("Location: ../index.php?do=login");
    exit;
}

$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$mem_id = $_SESSION['mem_id'];
$datetime = date("Y-m-d H:i:s");
$product_count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);

if (!$product_id || !$product_count) {
    header("Location: ../stores.php?do=failed");
    exit;
}

$sqlse = "SELECT product_price FROM product WHERE product_id = $product_id";
$resultse = mysqli_query($conn, $sqlse);

if (!$resultse) {
    header("Location: ../stores.php?do=failed");
    exit;
}

$rowse = mysqli_fetch_array($resultse);
$product_price = $rowse['product_price'];

$sql = "INSERT INTO cart (cart_id, product_id, mem_id, product_price, cart_date, order_count) VALUES ('', $product_id, $mem_id, $product_price, '$datetime', $product_count)";
$res = mysqli_query($conn, $sql);

if (!$res) {
    header("Location: ../stores.php?do=cart_failed");
    exit;
}

header("Location: ../stores.php?do=cart_success");
exit;
?>