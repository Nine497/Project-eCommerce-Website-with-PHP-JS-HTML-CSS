<style>
  /* Tags sale red*/
  .shopping-mall-tag {
    border-top-right-radius: .1875rem;
    border-bottom-right-radius: .1875rem;
    padding: 2px 6px;
    position: absolute;
    left: -4px;
    top: 6px;
    background-color: rgb(208, 1, 27);
    color: #fff;
  }

  .shopping-mall-tag::before {
    content: '';
    background-color: rgb(208, 1, 27);
    position: absolute;
    left: 0;
    bottom: -.1875rem;
    border-bottom: .1875rem solid currentColor;
    border-right: .1875rem solid transparent;
  }

  /* ----------------------- */
  /* Tags sale greenew*/
  .shopping-mall-tagn {
    border-top-right-radius: .1875rem;
    border-bottom-right-radius: .1875rem;
    padding: 2px 6px;
    position: absolute;
    left: -4px;
    top: 35px;
    background-color: rgb(44, 169, 3);
    color: #fff;
  }

  .shopping-mall-tagn::before {
    content: '';
    background-color: rgb(44, 169, 3);
    position: absolute;
    left: 0;
    bottom: -.1875rem;
    border-bottom: .1875rem solid currentColor;
    border-right: .1875rem solid transparent;
  }

  /* ----------------------- */
  .fonts {
    font-size: 23px;
  }

  .card {
    width: 300px;
    height: 500px;
  }

  .box {
    line-height: 14pt;
    height: 56pt;
    overflow: hidden;
  }

  .modal-xl {
    max-width: 850px !important;
  }

  .imgm {
    max-width: 100%;
    width: 300px;
  }

  .imgd {
    max-width: 100%;
    width: 95px;
  }

  .display-5 {
    font-size: 25px;
  }

  .card-5 {
    box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
  }
</style>

<?php
include_once('./php/connect.php');
$sql = "SELECT * FROM product ORDER BY product_id DESC LIMIT 3";
$res = mysqli_query($conn, $sql);
?>
<!-- Show Shop -->
<div class="container"><br>
  <h3>
    <center>New Collection</center>
  </h3><br>
  <div id="result">
    <div class="row">
      <?php while ($row = mysqli_fetch_array($res)) { ?>
        <div class="col-sm-4 mt-3">
          <div class="card shadow-sm" style="width: 330px; height: 520px;">
            <img src="assets/image/store/<?php echo $row["product_image"] ?>" class="card-img-top" alt="Product image">
            <div class="card-body">
              <h5 class="card-title text-primary">
                <?php echo $row["product_name"]; ?>
              </h5>
              <p class="card-text text-secondary">
                <?php echo (strlen($row["product_detail"]) > 100) ? substr($row["product_detail"], 0, 97) . '...' : $row["product_detail"]; ?>
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