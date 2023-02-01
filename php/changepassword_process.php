<?php
require_once('connect.php');

if (isset($_POST['submit'])) {
    $oldpassword = $_POST['oldpassword'];
    $npassword = $_POST['npassword'];
    $repassword = $_POST['repassword'];

    if ($npassword == $repassword) {
        $sql = "SELECT * FROM members WHERE  mem_id = '" . $_SESSION["mem_id"] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (password_verify($oldpassword, $row['mem_password'])) {
            $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);
            $sql_pw = "UPDATE `members` SET 
                        `mem_password` = '" . $hashed_password . "'
                        WHERE mem_id ='" . $_SESSION["mem_id"] . "'";
            $result_pw = $conn->query($sql_pw) or die($conn->error);
            if ($result_pw) {
                echo '<script>';
                echo "window.location='../index.php?do=changed';";
                echo '</script>';
            }



        } else {
            echo '<script>';
            echo "window.location='../index.php?do=OldPass';";
            echo '</script>';
        }

    } else {
        echo '<script>';
        echo "window.location='../index.php?do=NewPass';";
        echo '</script>';
    }
} else {
    header('location:../index.php');
}

?>