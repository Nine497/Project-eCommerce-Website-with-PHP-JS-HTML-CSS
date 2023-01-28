<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php

//echo '<pre>',print_r ($_POST),'<pre>';
echo $mem_image;
$mem_id=$_POST['mem_id'];
$mem_username=$_POST['mem_username'];
$mem_fname=$_POST['mem_fname'];
$mem_lname=$_POST['mem_lname'];
$mem_email=$_POST['mem_email'];
$mem_tel=$_POST['mem_tel'];
$mem_address=$_POST['mem_address'];
$mem_status=$_POST['mem_status'];
$sql="UPDATE `members` SET `mem_fname` = '$mem_fname', `mem_lname` = '$mem_lname', `mem_email` = '$mem_email', `mem_tel` = '$mem_tel',`mem_status`= '$mem_status',`mem_address` = '$mem_address' WHERE `mem_id` = $mem_id;";
if(mysqli_query($conn,$sql)){
    echo '<script>';
    echo "window.location='index.php?do=success';";
    echo '</script>';
}else{
    echo '<script>';
    echo "window.location='index.php?do=failed';";
    echo '</script>';
}
    //echo '<pre>'.print_r($_POST),'<pre>';

?>