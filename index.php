<?php error_reporting(~E_NOTICE); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css"> <!--เรียกfontawesome -->
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <title>WanThetDee Shop</title>
</head>
<style>
    body {
        background-color: white;

    }
</style>

<body>
    <?php
    if (isset($_GET['do'])) {
        if ($_GET['do'] == 'success') {
            echo '<script type="text/javascript">
            Swal.fire({
                title: "ลบข้อมูลเสร็จสิ้น!",
                text: "ลบข้อมูลเสร็จสิ้น!",
                type: "success"
            });
        </script>';
        } else if ($_GET['do'] == 'failed') {
            echo '<script type="text/javascript">
          Swal.fire({
              title: "เกิดข้อผิดพลาด!",
              text: "ลบข้อมูลไม่สำเร็จ!",
              type: "error"
          });
      </script>';
        } else if ($_GET['do'] == 'regis_failed') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "สมัครสมาชิกไม่สำเร็จ",
                  text: "ชื่อผู้ใช้ถูกใช้แล้ว โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              </script>';
        } else if ($_GET['do'] == 'regis_success') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "สมัครสมาชิกสำเร็จ",
                  text: "การสมัครสมาชิกสำเร็จ",
                  type: "error"
              })        
              </script>';
        } else if ($_GET['do'] == 'login') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "กรุณาเข้าสู่ระบบ",
                  text: "กรุณาเข้าสู่ระบบหรือสมัครสมาชิกก่อนใช้งาน",
                  type: "error"
              })        
              </script>';
        } else if ($_GET['do'] == 'changed') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "สำเร็จ",
                  text: "การแก้ไขข้อมูลสำเร็จ",
                  type: "success"
              })        
              </script>';
        } else if ($_GET['do'] == 'OldPass') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "ไม่สำเร็จ",
                  text: "รหัสผ่านเดิมไม่ถูกต้อง โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              </script>';
        } else if ($_GET['do'] == 'NewPass') {
            echo '<script type="text/javascript">
              Swal.fire({
                  title: "ไม่สำเร็จ",
                  text: "รหัสผ่านใหม่ไม่ตรงกัน โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              </script>';
        }
    }

    ?>
    <?php
    require_once 'config.php';
    include('includes/navbar.php') ?>
    <!-- The Modal -->
    <br><br> <br><br>

    <?php
    include('includes/slidephoto.php');
    ?>
    <br>
    <?php include('news.php'); ?>
    <?php include('includes/storemini.php'); ?>

    <?php
    include('includes/footer.php');

    ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script><!--เรียกjquery -->
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script><!--เรียกpopper -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script><!--เรียกbootstrap.min.js -->
    <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>

<script>
    //formRegister
    $(document).ready(function () {
        $('#formRegister').validate({
            rules: {
                mem_fname: 'required',
                mem_lname: 'required',
                mem_email: {
                    required: true,
                    email: true
                },
                mem_tel: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10
                },
                mem_username: {
                    required: true,
                    minlength: 4

                },
                mem_password: {
                    required: true,
                    minlength: 4
                },
                confirm_password: {
                    required: true,
                    minlength: 4,
                    equalTo: '#mem_password' //ให้มันเท่ากับ password
                },
                mem_address: {
                    required: true,
                },
            },
            messages: {
                mem_fname: 'โปรดกรอก ชื่อ',
                mem_lname: 'โปรดกรอก นามสกุล',
                mem_email: {
                    required: 'โปรดกรอก Email',
                    email: 'โปรดกรอกEmail ให้ถูกต้อง'
                },
                mem_tel: {
                    required: 'โปรดกรอก เบอร์โทรศัพท์',
                    number: 'โปรดกรอกตัวเลขเท่านั้น',
                    maxlength: 'คุณกรอกตัวเลขเกิน10ตัว',
                    minlength: 'คุณกรอกตัวเลขน้อยกว่า10ตัว',
                },
                mem_username: {
                    required: 'โปรดกรอก ชื่อผู้ใช้งาน',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',
                },
                mem_password: {
                    required: 'โปรดกรอก รหัสผ่าน',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',

                },
                confirm_password: {
                    required: 'โปรดกรอก รหัสผ่าน',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',
                    equalTo: 'โปรดกรอกรหัสผ่านให้ตรงกัน'
                },
                mem_address: {
                    required: 'โปรดกรอก ที่อยู่',
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback')
                error.insertAfter(element)
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid')
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid')
            }
        });
    })
    //changepassword
    $(document).ready(function () {
        $('#changepassword').validate({
            rules: {
                oldpassword: {
                    required: true,
                    minlength: 4
                },
                npassword: {
                    required: true,
                    minlength: 4
                },
                repassword: {
                    required: true,
                    minlength: 4,
                    equalTo: '#npassword' //ให้มันเท่ากับ password
                },
            },
            messages: {
                oldpassword: {
                    required: 'โปรดกรอก รหัสผ่านเก่า',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',

                },
                npassword: {
                    required: 'โปรดกรอก รหัสผ่านใหม่',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',

                },
                repassword: {
                    required: 'โปรดกรอก รหัสผ่านใหม่อีกครั้ง',
                    minlength: 'โปรดกรอกข้อมูลไม่น้อยกว่า4 ตัวอักษร',
                    equalTo: 'โปรดกรอกรหัสผ่านให้ตรงกัน'
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback')
                error.insertAfter(element)
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid')
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid')
            }
        });
    })
    function recaptchaCallback() {//เปิดปุ่มเมื่อมีการกันบอทแล้ว
        $('#submit').removeAttr('disabled');
    }
</script>