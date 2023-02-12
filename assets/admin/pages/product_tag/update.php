<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php

//echo '<pre>',print_r ($_POST),'<pre>';
$product_tag_name = $_POST['product_tag_name'];
$product_tag_id = $_POST['product_tag_id'];
$sql = "UPDATE `product_tag` SET`product_tag_name` = '$product_tag_name' WHERE `product_tag_id` = '$product_tag_id'";
if (mysqli_query($conn, $sql)) {
    echo '<script>';
    echo "window.location='index.php?do=update_success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='index.php?do=update_success';";
    echo '</script>';
}
//echo '<pre>'.print_r($_POST),'<pre>';

?>