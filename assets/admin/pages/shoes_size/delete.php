<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
    $shoes_id=$_GET['shoes_id'];
    $sql="DELETE FROM `shoes_size` WHERE shoes_id = $shoes_id";
   
    if (mysqli_query($conn, $sql)) {
        echo '<script> alert("ลบข้อมูลเสร็จสิ้น!")</script>'; 
        header('Refresh:0; url=index.php');
        echo '<script>';
        echo "window.location='index.php?do=success';";
        echo '</script>';
	} else {
        echo "Error deleting record: " . mysqli_error($connect);
        header('Refresh:0; url=index.php');
        echo '<script>';
        echo "window.location='index.php?do=failed';";
        echo '</script>';
	}
	mysqli_close($conn);
?>