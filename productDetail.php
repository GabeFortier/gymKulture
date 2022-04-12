<?php
    session_start();
    $database_name = "test1";
    include 'vars.php';
    $con = mysqli_connect("localhost", "root", $sqlpwd, $database_name);
    $product_id = (string)$_GET['productID'];
    if(isset($_POST["add"])){
        if(isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"], "product_id");
            if(!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_aray = array(
                    'product_id' => $_GET["id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"]
                );
                $_SESSION["cart"][$count] = $item_aray;
                echo '<script>window.location = "productDetail.php?productID=$_GET["id"]"</script';
            }
            if(in_array($_GET["id"], $item_array_id)){
                $foundKey = array_search($_GET["id"], array_column($_SESSION["cart"],'product_id'));
                $_SESSION["cart"][$foundKey]["item_quantity"] += $_POST["quantity"];
            }
            else{
                echo '<script>alert("Product is already in Cart")</script>';
                echo '<script>window.location = "productDetail.php?productID=$_GET["id"]"</script>';
            }
        }
        else{
            $item_aray = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["cart"][0] = $item_aray;
        }
    }
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["cart"] as $keys => $value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been removed.")</script>';
                    echo '<script>window.location = "productDetail.php?productID=$_GET["id"]"</script';
                }
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/details.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<title>Speki-Demo</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="../img/climbIcon.png" />
<!-- <style>
    img{
            align-content: center;
            height: 259px;
            width: 195px;
            object-fit: fill;
        }
    .imagePlace{
        padding-left:20%;
    }
    </style> -->

<!-- Navigation-->
<nav class="navbar sticky-top navbar-light" style="background:rgb(255,255,255,0);">
        <div class="px-4 px-lg-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" style="text-align: left;" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="text-align:left;">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="searchPage.php">All Products</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="filteredList.php?prodTag=mens">Mens</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="filteredList.php?prodTag=womens">Womens</a></li>
                    </li>
                </ul>
          
            </div>
        </div>
        
    <a class="nav-link nav-item" href="../index.html"><img src="./assets/trasnparent2_lgo2.png"></a>
    <div style="display:flex; flex-direction: column-reverse; align-items: flex-end; justify-content: center;">  
                <form method="POST" id="search" action="searchPage.php" class="mobile-form">
                <div class="search small-search"> <input type="search" class="input" id="search" style="" name="searchInput" placeholder="Search" /> <button id="button" type="submit"><i class="fa fa-search"></i></button>
</div>
    <script>
        $(document).ready(function(){
            $(".search").hover(function(){
                $(this).toggleClass("small-search");
            });
        });
    </script>
                    
                </form>
                <form action="cart.php" id="nav-cart" class="" style="padding-bottom: 5px;">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php
                                $cartCount = 0;
                                if($_SESSION["cart"] == null){
                                    echo "0";
                                }
                                else{
                                    foreach($_SESSION["cart"] as $key => $value){
                                        $cartCount += $_SESSION["cart"][$key]["item_quantity"];
                                    }
                                    echo $cartCount;
                                }
                            ?></span>
                    </button>
                </form>
                <script>
                    $(document).ready(function(){
                        if($(window).width() < 786){
                            $("#nav-search").css({"display":"flex","flex-direction":"column","align-content":"center","flex-wrap":"wrap","justify-content":"center","align-items":"center"});
                            $("#nav-cart").css({"display":"flex","flex-direction":"column","align-content":"center","flex-wrap":"wrap","justify-content":"center","align-items":"center"});
                            $("#go-btn").css({"margin-top":"5px","margin-bottom":"5px"});
                        }
                    });
                </script></div>
    </nav>
    
        <?php
                $query = "SELECT * FROM testtable WHERE id = '".$product_id."'";
                $result = mysqli_query($con, $query);
                if($result == false){
                    echo "result failed";
                }
                else{
                    $row = mysqli_fetch_array($result);
                }
            ?> 
<div class="container" style="margin-top:5px;">


  
    <!-- Portfolio Item Row -->
    <div class="row" style="padding-bottom:5px">
        <!-- Portfolio Item Heading -->
        <h1 class="my-4"><?php echo $row["productName"]; ?>
        </h1>
      <div class="col-md-8 imagePlace">
        <img class="card zoom img-responsive" src="<?php echo $row["picturePath"]; ?>" alt="" style="aspect-ratio:2/2.5;max-height:316px; max-width:420px;">
      </div>
  
      <div class="col-md-4">
        <h3 class="my-3"><?php echo $row["productName"]?></h3>
        <p><?php echo $row["DISC"]?></p>
        <h3 class="my-3">Product Details</h3>
        <ul>
          <li>Lorem Ipsum</li>
          <li>Dolor Sit Amet</li>
          <li>Consectetur</li>
          <li>Adipiscing Elit</li>
        </ul>
        <form method="post" action="productDetail.php?productID=<?php echo $row["id"]; ?>&action=add&id=<?php echo $row["id"]; ?>">
            <div>
                <input type="text" name="quantity" class="form-control" value="1" style="margin-bottom: 2px;">
                <input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                <input type="submit" name="add" style="padding-top: 5px;" class="btn btn-dark mt-auto"
                value="Add to Cart">
            </div>
                </form>
      </div>
  
    </div>
    <!-- /.row -->
  
    <!-- Related Projects Row -->
    <h3 class="my-4">Related Products</h3>
    
    <div class="row">
    <?php
                $query1 = "SELECT * FROM testtable WHERE tag = '".$row["tag"]."' && id != '".$product_id."'";
                $result1 = mysqli_query($con, $query1);
                if(mysqli_num_rows($result1) > 0){
                    $counter = 0;
                    $set_ = "active";?>

                <?php while($row1 = mysqli_fetch_array($result1)){
                           
                        
                ?>
      <div class="col-md-3 col-sm-6 mb-4" >
      <h4 class="my-4"><?php echo $row1["productName"]; ?>
        </h4>
        <a href="productDetail.php?productID=<?php echo $row1["id"]?>">
              <img class="img-fluid card" src="<?php echo $row1["picturePath"]; ?>" style="aspect-ratio:2/2.5; height:243px;" alt="">
            </a>
      </div>
  
      <!-- <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
              <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
            </a>
      </div>
  
      <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
              <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
            </a>
      </div>
  
      <div class="col-md-3 col-sm-6 mb-4">
        <a href="#">
              <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
            </a> -->
      <!-- </div> -->
      <?php 
                    $counter = $counter + 1;    
                }
            
                }
                    ?>
    </div>
    <!-- /.row -->
  
  </div>
  <!-- /.container -->


</html>

