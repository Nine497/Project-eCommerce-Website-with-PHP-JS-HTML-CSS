<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
$new_id = $_GET['new_id'];
$sql = "DELETE FROM `news` WHERE new_id = $new_id";

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