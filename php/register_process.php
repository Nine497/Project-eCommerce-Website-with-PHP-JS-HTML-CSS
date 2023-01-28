<?php 
    require_once('connect.php');
    require_once('../includes/function.php');
    if(isset($_POST['submit'])){
        //  echo '<pre>',print_r($_POST),'</pre>';

        //reCAPTCHA
        $mem_fname = $_POST['mem_fname'];
        $mem_lname = $_POST['mem_lname'];
        $mem_email = $_POST['mem_email'];
        $mem_tel = $_POST['mem_tel'];
        $mem_username = $_POST['mem_username'];
        $mem_password = $_POST['mem_password'];

        $mem_address = $_POST['mem_address'];
        $mem_create_at = date('Y-m-d');
        if(isset($_POST['submit'])){ 

                    $check_sql="SELECT * FROM members WHERE mem_username= '".$mem_username."' ";
                    $check_username= $conn->query($check_sql) or die($conn->error);
                
                    if(!$check_username->num_rows){
                        $hash_password= password_hash($mem_password, PASSWORD_DEFAULT);
                        $sql="INSERT INTO `members`VALUES ('','$mem_fname','$mem_lname','$mem_email','$mem_tel','$mem_address','$mem_username','$hash_password','$mem_create_at','user')";
                        $res=mysqli_query($conn,$sql);
                        echo '<script>';
                        echo "window.location='../index.php?do=regis_success';";
                        echo '</script>';
                    }else{
                        echo '<script>';
                        echo "window.location='../index.php?do=regis_failed';";
                        echo '</script>';
                    }
            } else{
                redirect('index');
        }

    }else{
        redirect('index');
    }
   
?>