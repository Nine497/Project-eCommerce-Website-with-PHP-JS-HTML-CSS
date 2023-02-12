<?php include_once('../authen.php');
include('../../connect.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>การจัดการข่าวสาร</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/responsive/responsive.bootstrap4.min.css"><!-- responsive-->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sarabun', sans-serif;
    }
  </style>
</head>
<style>
</style>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar & Main Sidebar Container -->
    <?php include_once('../includes/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>การจัดการข่าวสาร</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">แดชบอร์ด</a></li>
                <li class="breadcrumb-item"><a href="../news">การจัดการข่าวสาร</a></li>
                <li class="breadcrumb-item active">เพิ่มข่าวสาร</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title d-inline-block">เพิ่มข่าวสาร</h3>
          </div>
          <!-- /.card-header -->
          <form role="form" action="insert.php" method="post" enctype="multipart/form-data" id="formRegister">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="mem_fname">เพิ่มรูปภาพข่าวสาร</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file" id="customFile">
                    <label class="custom-file-label" for="customFile">เลือกไฟล์</label>
                  </div><br>
                  <figure class="figure text-center d-none mt-2">
                    <img id="imgUpload" class="figure-img img-fluid rounded" style="max-width:50%">
                  </figure>
                </div>
                <table>
                  <div class="form-group col-md-2">
                    <label for="news_title">หัวข้อข่าวสาร</label>
                    <input type="text" class="form-control" id="news_title" name="news_title">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="news_date">วันที่ข่าวสาร</label>
                    <input type="date" class="form-control" id="news_date" name="news_date">
                  </div>
                  <div class="card-footer col-md-12">
                    <a href="index.php" class="btn btn-warning float-left">ย้อนกลับ</a>
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="เพิ่มข่าวสาร">
                  </div>
                </table>
              </div>
            </div>
          </form>

          <div class="card-body">
          </div>


          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer -->
    <?php include_once('../includes/footer.php') ?>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../../../../node_modules/jquery-datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/responsive/dataTables.responsive.min.js"></script> <!-- responsive-->
  <script src="../../../../node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
  <!--เรียกjquery.validate -->

</body>

</html>
<script>
  $('.custom-file-input').on('change', function () {
    var fileName = $(this).val().split('\\').pop()
    $(this).siblings('.custom-file-label').html(fileName)
    if (this.files[0]) {
      var reader = new FileReader()
      $('.figure').addClass('d-block')
      reader.onload = function (e) {
        $('#imgUpload').attr('src', e.target.result)
      }
      reader.readAsDataURL(this.files[0])
    }
  })
  //formRegister
  $(document).ready(function () {
    $('#formRegister').validate({
      rules: {
        file: 'required',
        customFile: 'required',
        news_title: 'required',
        news_date: 'required',
      },
      messages: {
        file: 'กรุณาเลือกไฟล์ก่อน',
        customFile: 'กรุณาเลือกไฟล์ก่อน',
        news_title: 'โปรดกรอก หัวข้อข่าว',
        news_date: 'โปรดเลือก วันที่ลงข่าว',
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
</script>