<?php
    session_start();
    $database_name = "test1";
    include 'vars.php';
    $con = mysqli_connect("localhost", "root", $sqlpwd, $database_name);

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
                echo '<script>window.location = "Cart.php"</script';
            }
            else{
                echo '<script>alert("Product is already in Cart")</script>';
                echo '<script>window.location = "Cart.php"</script>';
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
                    echo '<script>window.location = "cart.php"</script>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <link href="css/styles.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
    <title>Speki-Demo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../img/climbIcon.png" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap');
        *{
            font-family: 'Titillium Web', sans-serif;
        } */

        .product{
            border: solid 1px #eaeaec;
            margin: -1px 19px 3px 1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;

        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #000;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #000;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
        
    </style>
</head>
<body>
    <script
    src="https://www.paypal.com/sdk/js?enable-funding=venmo&client-id=AeV8R6QqSCCMCzWhRXAD6VD9iJP8I2g3i25Diw0pIIa3dxMha2V0vH0qIhJFIaJjHOwuYtHR33aA6tMb"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
  </script>
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
    <!-- Header-->
   <!-- class: bg-image-full  style: background-image: url('assets/back1.jpg') -->
    
    <div class="cartContainer container" style="width: 60%;border: 1px solid gray; border-radius: 6%; padding: left 3px; padding: right 3px; margin-top: 5px; padding-top: 10px; margin-bottom: 10px">
        <div class="container" style="width: 65%;">
            <h2>Shopping Cart</h2>
            
            </div>
            
        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>
            
            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["product_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>$ <?php echo $value["product_price"]; ?></td>
                            <td>
                                $ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
            <tr>
                <td colspan="3">Total</td>
                <th>$ <?php echo number_format($total, 2); ?></th>
                <td></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <div id="paypal-button-container" class="d-flex justify-content-center"></div>
        <script type="text/javascript">
            paypal.Buttons({
                    style: {
                shape: 'pill',
                color: 'silver',
                layout: 'vertical',
                label: 'paypal',
                
                },
                createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                    amount: {
                        value: <?php echo number_format($total, 2);?>
                    }
                    }]
                });
                },
                onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                    }
                }).render('#paypal-button-container');
        </script>
        </div>
    </div>
</div>
<!-- Footer-->


</body>
</html>