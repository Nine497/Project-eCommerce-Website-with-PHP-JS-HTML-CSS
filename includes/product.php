<?php include("php/connect.php"); ?>

<?php
if (!isset($_GET['product_tag'])) {
  $sql = "SELECT * FROM `product` ";
} else {
  $sql = "select * from product where `product_tag` =  '" . $_GET['product_tag'] . "'  ";
}
$res = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<div class="container" style=" min-height: 100%;
  display: flex;
  flex-wrap: wrap;">
  <br><br><br><br><br>
  <?php include('cateta.php') ?>
  <div id="result">
    <div class="row">
      <?php while ($row = mysqli_fetch_array($res)) { ?>
        <div class="col-sm-4 mt-3">
          <div class="card shadow-sm" style="width: 330px; height:480px;">
            <img src="assets/image/store/<?php echo $row["product_image"] ?>" class="card-img-top" alt="Product image"
              style="height:280px; width:330px">
            <div class="card-body" style="  position: relative;">
              <h5 class="card-title text-primary">
                <?php echo $row["product_name"]; ?>
              </h5>
              <p class="card-text text-secondary">
                <?php echo (strlen($row["product_detail"]) > 40) ? substr($row["product_detail"], 0, 37) . '...' : $row["product_detail"]; ?>
              </p>

              <p class="card-text text-success">
                <?php echo number_format($row['product_price'], 2) ?>บาท
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <form action="details_product.php" method="post" style="  position: absolute;bottom: 10px;left: 10px;">
                  <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
                  <input type="submit" value="Show Details" class="btn btn-primary btn-sm" style="font-size: 0.8em;">
                </form>
                <form action="includes/addcart.php" method="post" style=" position: absolute;bottom: 10px;right: 10px;">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                  <input type="hidden" name="count" value="1">
                  <?php if ($row['product_count'] != 0) {
                    echo '<button type="submit" class="btn btn-danger btn-sm" name="addcart" style="font-size: 0.8em;">';
                    echo 'Add To Cart <i class="fas fa-shopping-cart fa-1x"></i>';
                    echo '</button>';
                  } else {
                    echo '<button type="submit" class="btn btn-danger btn-sm" name="addcart" style="font-size: 0.8em;" disabled>';
                    echo 'สินค้าหมด <i class="fas fa-shopping-cart fa-1x"></i>';
                    echo '</button>';
                  }
                  ?>
                </form>

              </div>
            </div>
          </div>
          <br><br><br>
        </div>
      <?php } ?>
      <!--- /col-md4 --->
    </div>
    <!-- /model -->
  </div>
  <!--- /card-deck--->
</div>
<!-- Bootstrap core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>