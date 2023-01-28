<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
$mem_id = $_GET['mem_id'];
$sql = "DELETE FROM `members` WHERE mem_id = $mem_id";

if (mysqli_query($conn, $sql)) {
        echo '<script>';
        echo "window.location='index.php?do=delete_success';";
        echo '</script>';
} else {
        echo '<script>';
        echo "window.location='index.php?do=delete_failed';";
        echo '</script>';
}
mysqli_close($conn);
?>