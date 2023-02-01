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
<div class="container ">

  <br><br><br><br><br>
  <?php include('cateta.php') ?>
  <div id="result">
    <div class="row">
      <?php while ($row = mysqli_fetch_array($res)) { ?>
        <div class="col-sm-4 mt-3">
          <div class="card shadow-sm">
            <img src="assets/image/store/<?php echo $row["product_image"] ?>" class="card-img-top" alt="Product image">
            <div class="card-body">
              <h5 class="card-title text-primary">
                <?php echo $row["product_name"]; ?>
              </h5>
              <p class="card-text text-secondary">
                <?php echo (strlen($row["product_detail"]) > 200) ? substr($row["product_detail"], 0, 197) . '...' : $row["product_detail"]; ?>
              </p>

              <p class="card-text text-success">
                <?php echo number_format($row['product_price'], 2) ?>บาท
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="font-size: 0.8em;"
                  data-target="#myModal<?php echo $row["product_id"]; ?>">
                  Show Details
                </button>
                <form action="includes/addcart.php" method="post">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                  <button type="submit" class="btn btn-danger btn-sm" name="addcart" style="font-size: 0.8em;">
                    Add To Cart <i class="fas fa-shopping-cart fa-1x"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
          <br><br><br>
        </div>
        <!-- The Modal -->
        <div class="modal fade" style="" id="myModal<?php echo $row["product_id"]; ?>">
          <div class="modal-dialog" style="max-width: 50%;  position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);">
            <div class="modal-content"> <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title">
                  <?php echo $row["product_name"]; ?>
                </h5>
                <button type="button" class="btn-close close" style="font-size: 2em;" data-dismiss="modal"
                  aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-5">
                    <!-- Gallery -->
                    <div id="js-gallery" class="gallery">
                      <!--Gallery Hero-->
                      <div class="gallery__hero">
                        <img class="img-fluid" src="assets/image/store/<?php echo $row["product_image"] ?>">
                      </div>
                    </div>
                    <!--.gallery-->
                    <!-- Gallery -->
                  </div>
                  <div class="col-sm-7">
                    <h3 class="text-primary">
                      <?php echo $row['product_name'] ?>
                    </h3>
                    <br>
                    <div class="text-secondary">
                      <?php echo $row['product_detail'] ?>
                    </div><br>
                    <h4 class="text-success">
                      <?php echo $price;
                      echo " ";
                      echo number_format($row['product_price'], 2);
                      echo " ";
                      echo $baht; ?>
                    </h4>
                    <br>
                  </div>
                </div>
                <form action="includes/addcart.php" method="post">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                  <button type="submit" class="btn btn-danger btn-block my-3" name="addcart">Add To Cart <i
                      class="fas fa-shopping-cart fa-1x"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>

      <?php } ?>
      <!--- /col-md4 --->
    </div>
    <!-- /model -->
  </div>
  <!--- /card-deck--->
</div>
<!--- /row--->
</div>
<!--- /result--->
</div>