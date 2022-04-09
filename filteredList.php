<?php
    session_start();
    $database_name = "test1";
    include 'vars.php';
    $con = mysqli_connect("localhost", "root", $sqlpwd, $database_name);
    $_SESSION['thisGlobal'] = "testing global";

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
        <title>Speki-Demo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../img/climbIcon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
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
                <div class="search small-search" id="search-div"> <input type="search" class="input" id="search" style="" name="searchInput" placeholder="Search" /> <button id="button" type="submit"><i class="fa fa-search"></i></button>
</div>
    <script>
        $(document).ready(function(){
            // $(".search").hover(function(){
            //     $(this).removeClass("small-search");
            // });
            // if($(".search").hover() || $(".search").val()){
            //     $(this).removeClass("small-search");
            // }
            // if($(".search").val()){
            //     $(this).removeClass("small-search");
            // }

            $("#search-div").mouseenter( function(){
                    $(this).removeClass("small-search");
                })

            $("#search-div").mouseleave(function(){
                if($("#search").val() != ''){
                    $(this).addClass("small-search");
                }
            });
            //     .mouseleave(funciton(){
            //         if($("#search").val().length == 0){
            //             $(this).addClass("small-search");
            //         }
            //     }
            // );
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
    



        <section class="py-5">
    
    <div class="px-4 px-lg-5 mt-5 wow fadeInLeft" style="animation-name: fadeInLeft;">
        
        <div class="flex-row flex-nowrap justify-content-start product-grid">
        <?php
                $query = "SELECT * FROM testtable WHERE tag = '".(string)$_GET["prodTag"]."'";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0){
                    $counter = 0;
                    $set_ = "active";
                    while($row = mysqli_fetch_array($result)){
            ?> 


            <div class="col mb-5">

                <div class="product-list">

                    <!-- Product image-->
                    <a class="h-100" style="aspect-ratio:2/2.5" href="productDetail.php?productID=<?php echo $row["id"]?>"><img src="<?php echo $row["picturePath"]; ?>" class="img-fitted" style="aspect-ratio:2/2.5"></a>
                    <!-- Product details-->
                    <div class="card-body d-flex flex-column pt-4">
                        <div class="text-center mt-auto">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $row["productName"]; ?></h5>
                            <!-- Product price-->
                        </div>
                    </div>
                    <!-- Product actions-->
                    <!-- <div class="pb-1 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                href="productDetail.php?productID=<?php echo $row["id"]?>">Product</a>
                        </div>
                    </div> -->
                </div>
            </div>

            <?php 
                $counter = $counter + 1;    
            
        }
            }
                ?>

        </div>
        
    </div>
    
        </section>


        
        <!-- Footer-->

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
