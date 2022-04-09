<?php
    session_start();
    $database_name = "test1";
    $con = mysqli_connect("localhost", "root", "", $database_name);
    $_SESSION['thisGlobal'] = "testing global";
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = [];
    }
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
                echo '<script>window.location = "index.php"</script';
            }
            else{
                echo '<script>alert("Product is already in Cart")</script>';
                echo '<script>window.location = "index.php"</script>';
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
                    echo '<script>window.location = "Cart.php"</script';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"><img src = "assets/transparentLogo.png" style="width:200px; height:200px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" style="." id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left:19rem !important;">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="filteredList.php?prodTag=mens">Mens</a></li>
                            <li><a class="dropdown-item" href="filteredList.php?prodTag=womens">Womens</a></li>
                        </ul>
                    </li>
                </ul>

                <form method="POST" action="searchPage.php">
                    <label>Search</label>
                    <input type="search" id="searchInput" name="searchInput" value="">
                    <input class="btn btn-outline-dark" type="submit" value="Go" style="margin-right:3px;">
                </form>
                <form action="cart.php" class="d-flex">
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
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="py-5 bg-dark bg-image-full" style="background-image: url('assets/back1.jpg');">
        <div class="text-center text-gray">
            <h1 class="display-4 fw-bolder">GYM Kulture</h1>
            <p class="lead fw-normal text-gray-50 mb-0">With this shop hompeage template</p>
        </div>
    </header>
    <!-- Section for products-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h3>Top Mens</h3>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = "SELECT * FROM testtable";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0){
                    $counter = 0;
                    $set_ = "active";?>

                <?php while($row = mysqli_fetch_array($result)){
                        if($row["tag"] == "mens"){
                           
                        
                ?>


                <div class="col mb-5">

                    <div class="card h-100">

                        <!-- Product image-->
                        <img src="<?php echo $row["picturePath"]; ?>" class="img-responsive">
                        <!-- Product details-->
                        <div class="card-body d-flex flex-column pt-4">
                            <div class="text-center mt-auto">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $row["productName"]; ?></h5>
                                <!-- Product price-->
                                <h5>$<?php echo $row["price"]; ?></h5>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="pb-1 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                    href="productDetail.php?productID=<?php echo $row["id"]?>">Product</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $counter = $counter + 1;    
                }
            }
                }
                    ?>

            </div>
        </div>
        <section class="py-5 bg-dark bg-image-full" style="background-image: url('assets/card2.png');">
            <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
            <div style="height: 200px;"></div>
        </section>
        <div class="container px-4 px-lg-5 mt-5">
        <h3>Top Womens</h3>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = "SELECT * FROM testtable";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0){
                    $counter = 0;
                    $set_ = "active";?>

                <?php while($row = mysqli_fetch_array($result)){
                        if($row["tag"] == "womens"){
                           
                        
                ?>


                <div class="col mb-5">

                    <div class="card h-100">

                        <!-- Product image-->
                        <img src="<?php echo $row["picturePath"]; ?>" class="img-responsive">
                        <!-- Product details-->
                        <div class="card-body d-flex flex-column pt-4">
                            <div class="text-center mt-auto">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $row["productName"]; ?></h5>
                                <!-- Product price-->
                                <h5>$<?php echo $row["price"]; ?></h5>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="pb-1 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                    href="productDetail.php?productID=<?php echo $row["id"]?>">Product</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $counter = $counter + 1;    
                }
            }
                }
                    ?>

            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>