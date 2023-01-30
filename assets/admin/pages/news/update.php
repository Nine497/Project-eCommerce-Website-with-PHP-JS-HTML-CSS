<?php
//  echo "<pre>";
//  print_r($_POST); //เช็คการส่งค่าแบบARRAY
//  print_r($_FILES);
// echo "</pre>";
?>
<?php
require_once('../../connect.php');
if (isset($_POST['submit'])) {
    $news_id = $_REQUEST['new_id']; ////รับค่า REQUEST
    $news_image1 = $_POST['new_image1']; //รับค่า POST
    $new_title = $_POST['new_title'];
    $new_date = $_POST['new_date'];
    $imgUpload = $_FILES['file']; //รับค่า FILE
    $imgUpload_file = $_FILES['file']['name'];
    $temp = explode('.', $_FILES['file']['name']);
    $new_name = round(microtime(true) * 9999) . '.' . end($temp);
    $url = '../../../../assets/image/news/' . $new_name;

    if (isset($news_image1) != $imgUpload_file) { //ค่าเหมือนกัน เช่น aa.jpg aa.jpg
        $sql = "UPDATE `news` SET `new_title` = '$new_title', `new_date` = '$new_date' WHERE `new_id` = $news_id";
        $result = $conn->query($sql) or die($conn->error);
        if ($result) {
            echo '<script>';
            echo "window.location='index.php?do=success';";
            echo '</script>';
        }

    } else {
        $news_image1 = $new_name; //เปลี่ยนค่า
        if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
            $sql = "UPDATE `news` SET `new_image` = '$news_image1', `new_title` = '$new_title', `new_date` = '$new_date' WHERE `new_id` = $news_id";
            $result = $conn->query($sql) or die($conn->error);
            if ($result) {
                $_SESSION['news_image1'] = $new_name;
                echo '<script>';
                echo "window.location='index.php?do=success';";
                echo '</script>';
            }

        } else {

        }

    }

} else {
    echo '<script>';
    echo "window.location='index.php?do=failed';";
    echo '</script>';
}
?>