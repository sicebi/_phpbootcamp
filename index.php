<?php
    require("get_products.php");
    require("decode_data.php");
    session_start();

    #   GET NUMBER OF PRODUCTS IN CART  #
    if (isset($_SESSION['cart']))
        $cart_size = count($_SESSION['cart']);
    else
        $cart_size = 0;
    
    # CHECK IF USER IS LOGGED IN    #
    if (isset($_SESSION["email"]) && isset($_SESSION["password"]))
        $show_login = false;
    else
        $show_login = true;

    #   GET LATEST PRODUCTS #
    $latest_products = decode_data($products);
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
    <h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;">Latest</h1>
    <div class="latest">
        <?php
            for($i = 0; $i < 4; $i++)
            {
                $prod = $latest_products[$i];
                echo "<div class='product'>";
                echo "<p>",$prod['title'],"</p>";
                echo "<div class='image'><img src=",$prod['img_url'],"></div>";
                echo "<div class='price'><h2>R", $prod['price'],"</h2></div>";
                echo "<div class='add-to-cart'><a href='add_to_cart.php?productid=",$prod['id'],"'>Add to cart</a></div>";
                echo "</div>";
            }
        ?>
    </div>
    <h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;">Categories</h1>
    <div class="categories">
        <div class="red">
            <a href="catalogue.php?id=red">
                <img src="red-dress.jpg">
            </a>
            <h3>Red</h3>
        </div>
        <div class="white">
            <a href="catalogue.php?id=white">
                <img src="white-dress.jpg">
            </a>
            <h3>White</h3>
        </div>
        <div class="green">
            <a href="catalogue.php?id=green">
                <img src="green-dress.jpg">
            </a>
            <h3>Green</h3>
        </div>                
        <div class="yellow">
            <a href="catalogue.php?id=yellow">
                <img src="yellow-dress.jpg">
            </a>
            <h3>Yellow</h3>
        </div>  
        <div class="pink">
            <a href="catalogue.php?id=pink">
                <img src="pink-dress.jpg">
            </a>
            <h3>Pink</h3>
        </div>
        <div class="brown">
            <a href="catalogue.php?id=brown">
                <img src="brown-dress.jpg">
            </a>
            <h3>Brown</h3>
        </div>
        <div class="orange">
            <a href="catalogue.php?id=orange">
                <img src="orange-dress.jpg">
            </a>
            <h3>Orange</h3>
        </div>
        <div class="black">
            <a href="catalogue.php?id=black">
                <img src="black-dress.jpg">
            </a>
            <h3>Black</h3>
        </div>                                                            
    </div>
</div>
</body>
</html>