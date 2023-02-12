<?php
include_once('../authen.php');
include_once('../../connect.php');

$product_tag_name = $_POST['product_tag_name'];
$product_tag_id = $_POST['product_tag_id'];
$product_tag_old = $_POST['product_tag_old'];

$updateProductTag = "UPDATE `product` SET `product_tag` = '$product_tag_name' WHERE `product_tag` = '$product_tag_old' ";
$updateProductTagResult = mysqli_query($conn, $updateProductTag);

$updateProductTagSql = "UPDATE `product_tag` SET `product_tag_name` = '$product_tag_name' WHERE `product_tag_id` = '$product_tag_id'";
$updateProductTagResult = mysqli_query($conn, $updateProductTagSql);

if ($updateProductTagResult) {
    echo '<script>';
    echo "window.location='index.php?do=update_success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='index.php?do=update_fail';";
    echo '</script>';
}

mysqli_close($conn);
?>