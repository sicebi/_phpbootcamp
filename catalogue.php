<?php
    require("get_products.php");
    require("decode_data.php");
    session_start();

    $total = 0;
    #   GET NUMBER OF PRODUCTS IN CART  #
    if (isset($_SESSION['cart']))
    {   $cart_size = count($_SESSION['cart']);
        $cart = $_SESSION['cart'];
    }
    else
        $cart_size = 0;
        
    if (isset($_SESSION["email"]) && isset($_SESSION["password"]))
        $show_login = false;
    else
        $show_login = true;
    
    $all_products = decode_data($products);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Kumar+One+Outline" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Shop</title>
</head>
<body>
<div class="header">
    <h1 class="logo"><a href="index.php">Shoopy</a></h1>
    <ul class="right-links">
        <li><a href="cart.php">Cart( <?php echo $cart_size ?> )</a></li>
        <?php
            if ($show_login)
                echo "<li><a href='login.php'>Login</a></li>";
            else
                echo "<li><a href='logout.php'>Logout</a></li>";
        ?>
    </ul>
</div>
<div class="content landing-page">
    <div class="hero-content">
        <div class="hero-image">
            <img src="giphy.gif">
        </div>
        <div class="hero-text">
            <h1>Shoopy</h1>
            <p>SHOP THE FRESHEST FASHION FROM 500+ OF THE WORLD'S BEST BRANDS. ALWAYS OPEN, ALWAYS NEW</p>
        </div>
    </div>
    <h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;"><?php echo $_GET['id']?> dresses</h1>
    <div class="latest">
        <?php
            for($i = 0; $i < count($all_products); $i++)
            {
                $prod = $all_products[$i];                
                if ($prod["categories"] == $_GET['id'])
                {
                    echo "<div class='product'>";
                    echo "<p>",$prod['title'],"</p>";
                    echo "<div class='image'><img src=",$prod['img_url'],"></div>";
                    echo "<div class='price'><h2>R", $prod['price'],"</h2></div>";
                    echo "<div class='add-to-cart'><a href='add_to_cart.php?productid=",$prod['id'],"'>Add to cart</a></div>";
                    echo "</div>";
                }
            }
        ?>
    </div>

</body>
</html>