<style>
  .user-panel img {
    width: 6.4rem;
    height: auto;
  }

  .img-thumbnails {
    box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
    max-width: 100%;
  }
</style>

<?php
if (!isset($_SESSION["mem_id"])) {
  header("location: login.php");
  exit;
}
if ($_SESSION["mem_status"] != "admin") {
  header("location: login.php");
  exit;
}
$link = $_SERVER['REQUEST_URI'];
$link_array = explode('/', $link);
$name = $link_array[count($link_array) - 2];
?>
<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-primary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fa fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<?php
include('../../connect.php');
$sql9 = "select * from members where mem_id = '" . $_SESSION['mem_id'] . "'";
$res9 = mysqli_query($conn, $sql9);
$row9 = mysqli_fetch_array($res9);
?>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light text-center d-block">ระบบจัดการร้านค้า</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="info text-left">
        <a class="d-block h4 font-weight-bold">
          <?php echo $_SESSION['mem_fname'] ?>
          <?php echo $_SESSION['mem_lname'] ?>
        </a>
        <p class="d-block h6 mb-0 text-white" style="display:inline-block;">ตำแหน่ง :
          <?php if ($_SESSION['mem_status'] == "admin") {
            echo "Administrator";
          }
          ?>
        </p>
        <p class="d-block h6 mb-1 text-white" style="display:inline-block;">สถานะ : <i
            class="fas fa-circle text-success"></i> ออนไลน์</p>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../dashboard" class="nav-link <?php echo $name == 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>แดชบอร์ด</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../members" class="nav-link <?php echo $name == 'members' ? 'active' : '' ?>">
            <i class="fas fa-users-cog nav-icon"></i>
            <p>จัดการสมาชิก</p>
          </a>
        <li class="nav-item">
          <a href="../stores" class="nav-link <?php echo $name == 'stores' ? 'active' : '' ?>">
            <i class="fas fa-store nav-icon"></i>
            <p>จัดการสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../news" class="nav-link <?php echo $name == 'news' ? 'active' : '' ?>">
            <i class="fa fa-newspaper nav-icon"></i>
            <p>จัดการข่าวสาร</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../payment" class="nav-link <?php echo $name == 'payment' ? 'active' : '' ?>">
            <i class="far fa-credit-card"></i>
            <p>จัดการการชำระเงิน</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../product_tag" class="nav-link <?php echo $name == 'product_tag' ? 'active' : '' ?>">
            <i class="fa fa-shopping-cart"></i>
            <p>จัดการยี่ห้อสินค้า</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../logs" class="nav-link <?php echo $name == 'logs' ? 'active' : '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>User Logs</p>
            </a>
          </li> -->
        <!-- dropdown -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-cog fa-lg"></i>
            <p>
              เมนูคำสั่งซื้อ
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../orders" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>คำสั่งซื้อ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../order_detail" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>รายละเอียดคำสั่งซื้อ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../delivery" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>การจัดส่งคำสั่งซื้อ</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- dropdown -->
        <li class="nav-header dropdown">การตั้งค่าบัญชี</li>
        <li class="nav-item">
          <a href="../dashboard/logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>