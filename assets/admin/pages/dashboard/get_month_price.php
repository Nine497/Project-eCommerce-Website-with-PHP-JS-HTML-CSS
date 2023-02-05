<?php
include_once('../../connect.php');

if (isset($_POST['month'])) {
    $selectedMonth = $_POST['month'];
    $query = "SELECT SUM(payment_price) as payment_price FROM payment  WHERE payment_status = 'ชำระเรียบร้อย' AND MONTH(payment_date) = '$selectedMonth'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['payment_price'] !== null) {
        $payment_price = str_replace(",", "", $row['payment_price']);
        $payment_price = floatval($payment_price);
        echo number_format($payment_price, 2, '.', ',');
    } else {
        echo '0.00';
    }
}
?>