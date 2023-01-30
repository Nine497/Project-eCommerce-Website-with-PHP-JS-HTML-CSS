<?php include_once('../authen.php') ?>
<?php
include_once('../../connect.php');
$sql = "SELECT * FROM news";
$res = mysqli_query($conn, $sql);
?>
<style>
  .successa {

    color: #fff;

    background-color: #28a745;
    border-radius: 35px;

    padding: 5px;
  }

  .infos {

    color: #fff;
    background-color: #17a2b8;
    border-radius: 35px;
    border: 1px solid rgba(23, 162, 184, 0.75);
    padding: 5px;

  }
</style>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stores Management</title>
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
  <script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="../../../../node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <?php
  if (isset($_GET['do'])) {
    if ($_GET['do'] == 'success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "แก้ไขข้อมูลข่าวสารร้านค้าเสร็จสิ้น",
            icon: "success",
            text: "การแก้ไขข้อมูลข่าวสารร้านค้าสำเร็จ",
            type: "success"
        })        
        </script>';
    }else if ($_GET['do'] == 'failed') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "แก้ไขข้อมูลข่าวสารร้านค้าไม่สำเร็จ",
            icon: "error",
            text: "การแก้ไขข้อมูลข่าวสารร้านค้าไม่สำเร็จ โปรดลองใหม่อีกครั้ง",
            type: "error"
        })        
        </script>';
    } else if ($_GET['do'] == 'delete_success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "ลบข้อมูลข่าวสารร้านค้าสำเร็จ",
            icon: "success",
            text: "การลบข้อมูลข่าวสารร้านค้าสำเร็จ",
            type: "success"
        })        
        </script>';
    } else if ($_GET['do'] == 'delete_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "ลบข้อมูลข่าวสารร้านค้าไม่สำเร็จ",
            icon: "error",
            text: "การลบข้อมูลข่าวสารร้านค้าไม่สำเร็จ โปรดลองใหม่อีกครั้ง",
            type: "error"
        })        
        </script>';
    } else if ($_GET['do'] == 'insert_success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "เพิ่มข้อมูลข่าวสารร้านค้าสำเร็จ",
            icon: "success",
            text: "การเพิ่มข้อมูลข่าวสารร้านค้าสำเร็จ",
            type: "success"
        })        
        </script>';
    } else if ($_GET['do'] == 'insert_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
          title: "เพิ่มข้อมูลข่าวสารร้านค้าไม่สำเร็จ",
          icon: "error",
          text: "การเพิ่มข้อมูลข่าวสารร้านค้าสำเร็จ",
          type: "error"
        })        
        </script>';
    }
  }
  ?>
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
              <h1>News Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">News Management</li>
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
            <h3 class="card-title d-inline-block">News List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped w-100 ">
              <thead>
                <tr>
                  <th>ID.</th>
                  <th>Images</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th><a href="form_insert.php" class="btn btn-info"><i class="fas fa-plus-square"></i> Add News</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($res)) { ?>
                  <tr>
                    <td>
                      <?php echo $row['new_id']; ?>
                    </td>
                    <td><img src="../../../image/news/<?php echo $row['new_image'] ?>"
                        class="img-fluid d-block mx-auto rounded-circle" width="80"></td>
                    <td>
                      <?php echo $row['new_title']; ?>
                    </td>
                    <td>
                      <?php echo $row['new_date']; ?>
                    </td>
                    <td>
                      <a href="form-edit.php?new_id=<?php echo $row['new_id']; ?>"
                        class="btn btn-sm btn-warning text-white">
                        <i class="fas fa-edit"></i> edit
                      </a>
                      <a class="btn btn-sm btn-danger text-white" onclick="deleteNews(<?php echo $row['new_id'] ?>)">
                        <i class="fas fa-trash-alt"></i> Delete
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
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


  <script>
    $(function () {
      $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true
      });
    });
  </script>

  <script>
    function deleteNews(new_id) {
      Swal.fire({
        title: 'Delete News',
        text: "Are you sure you want to delete this News?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: 'No, I am not sure'
      }).then((result) => {
        if (result.value) {
          window.location.href = "delete.php?new_id=" + new_id;
        }
      })
    }
  </script>

</body>

</html>