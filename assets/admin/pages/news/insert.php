
    <?php 
    require_once('../../connect.php');
    //echo '<pre>',print_r ($_POST),'<pre>';
    if(isset($_POST['submit'])){
        //echo '<pre>',print_r ($_FILES['file']),'<pre>';
        $file=$_POST['file'];
        $news_title=$_POST['news_title'];
        $news_date=$_POST['news_date'];
       $temp=explode('.',$_FILES['file']['name']);
        $new_namenews=round(microtime(true)*9999) . '.' . end($temp);
        $url='../../../../assets/image/news/'. $new_namenews;
        if(move_uploaded_file($_FILES['file']['tmp_name'],$url)){
            $sql="INSERT INTO `news` VALUES ('','$news_title','$new_namenews','$news_date')";
        $res= $conn->query($sql) or die($conn->error);
            if($res){
                $_SESSION['news_img'] = $new_namenews;
                echo '<script>';
                echo "window.location='index.php?do=insert_success';";
                echo '</script>';
            }else{
                echo '<script>';
                echo "window.location='index.php?do=insert_failed';";
                echo '</script>';
            }
        }

       
    }else{
        header('Location: ../../../../login.php');  
    }   
    ?>