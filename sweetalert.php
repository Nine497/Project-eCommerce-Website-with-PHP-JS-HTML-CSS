<?php
if (isset($_GET['do'])) {
    if ($_GET['do'] == 'del_success') {
        echo '<script type="text/javascript">
            Swal.fire({
                title: "ลบข้อมูลเสร็จสิ้น!",
                text: "ลบข้อมูลเสร็จสิ้น!",
                type: "success"
            });
            setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'del_failed') {
        echo '<script type="text/javascript">
          Swal.fire({
              title: "เกิดข้อผิดพลาด!",
              text: "ลบข้อมูลไม่สำเร็จ!",
              type: "error"
          });
          setTimeout(function(){
            window.location.href = window.location.href.split("?")[0];
          }, 2000);
          </script>';
    } else if ($_GET['do'] == 'regis_failed') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "สมัครสมาชิกไม่สำเร็จ",
                  text: "ชื่อผู้ใช้ถูกใช้แล้ว โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'regis_success') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "สมัครสมาชิกสำเร็จ",
                  text: "การสมัครสมาชิกสำเร็จ",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'login') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "กรุณาเข้าสู่ระบบ",
                  text: "กรุณาเข้าสู่ระบบหรือสมัครสมาชิกก่อนใช้งาน",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'changed') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "สำเร็จ",
                  text: "การแก้ไขข้อมูลสำเร็จ",
                  type: "success"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'OldPass') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "ไม่สำเร็จ",
                  text: "รหัสผ่านเดิมไม่ถูกต้อง โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'NewPass') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "ไม่สำเร็จ",
                  text: "รหัสผ่านใหม่ไม่ตรงกัน โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'buy_failed') {
        echo '<script type="text/javascript">
        Swal.fire({
            title: "คำสั่งซื้อล้มเหลว",
            text: "เกิดปัญหาในการประมวลผลคำสั่งซื้อของคุณ กรุณาลองอีกครั้ง",
            type: "error"
        })        
        setTimeout(function(){
            window.location.href = window.location.href.split("?")[0];
          }, 2000);
          </script>';
    } else if ($_GET['do'] == 'emptyshipping') {
        echo '<script type="text/javascript">
        Swal.fire({
            title: "คำสั่งซื้อล้มเหลว",
            text: "คุณต้องเลือกวิธีการจัดส่งก่อนส่งคำสั่งซื้อของคุณ",
            type: "error"
        })        
        setTimeout(function(){
            window.location.href = window.location.href.split("?")[0];
          }, 2000);
          </script>';
    } else if ($_GET['do'] == 'cart_success') {
        echo '<script type="text/javascript">
            Swal.fire({
                title: "เพิ่มไปยังรถเข็นเรียบร้อย",
                icon:"success",
                text: "เพิ่มไปยังรถเข็นเรียบร้อย",
                type: "success"
            });
            setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'cart_failed') {
        echo '<script type="text/javascript">
            Swal.fire({
                title: "เกิดข้อผิดพลาด",
                icon:"error", 
                text: "ไม่สามารถเพิ่มไปยังรถเข็นได้",
                type: "error"
            });
            setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'Loginincorrect') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "เข้าสู่ระบบไม่สำเร็จ",
                  icon:"error",
                  text: "รหัสผ่านหรือชื่อผู้ใช่ไม่ถูกต้อง โปรดลองใหม่อีกครั้ง",
                  type: "error"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    } else if ($_GET['do'] == 'Logincorrect') {
        echo '<script type="text/javascript">
              Swal.fire({
                  title: "เข้าสู่ระบบสำเร็จ",
                  icon:"success",
                  type: "success"
              })        
              setTimeout(function(){
                window.location.href = window.location.href.split("?")[0];
              }, 2000);
              </script>';
    }
}
?>