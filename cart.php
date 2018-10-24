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

    function exists_in_cart($id)
    {
        print_r($cart);
        foreach($cart as $prod_in_cart);
        {
            if($prod_in_cart["id"] == $id)
                return 1;
        }
        return 0;
    }
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
    <title>Shop - Cart</title>
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
    <div class="content cart">
        <?php
            for($i = 0; $i < count($all_products); $i++)
            {
                $found = 0;
                $prod_quantity = 0;
                $prod = $all_products[$i];
                
                foreach($cart as $e)
                {
                    if($e['id'] == $prod['id'])
                    {
                        $prod_quantity = $e['quantity'];
                        $found = 1;
                        break;
                    }
                }
                if ($found == 1)
                {
                    $found = 0;
                    echo "<div class='item'>";
                    echo "<div class='product'>";
                    echo "<p>",$prod['title'],"</p>";
                    echo "<div class='image'><img src=",$prod['img_url'],"></div>";
                    echo "<div class='price'><h2>R", $prod['price'],"</h2></div>";
                    echo "</div>";
                    echo "<div class='product_info'>";
                    echo "<h3>Quantity: ", $prod_quantity ,"</h3>";
                    echo "<a class='add' href='add_to_cart.php?action=add&productid=",$prod['id'],"'>+</a>";
                    echo "<a class='dec' href='add_to_cart.php?action=dec&productid=",$prod['id'],"'>-</a>";
                    echo "<p><strong>Total: R ",$prod['price'] * $prod_quantity,"<strong></p>";
                    echo "</div></div>";
                    $total = $total + $prod['price'] * $prod_quantity;
                }
            }
        ?>
        <h1 style="margin:20px;"><strong>TOTAL: R <?php echo $total?></strong></h1>
        <?php
            if (!$show_login)
            {
                echo "<p><a class='archive-order' href='archive_order.php'>Archive Order</a></p>";
            }
            else
            {
                echo "<p>You need to login to archive your order. <a href='login.php'>Login Here</a></p>";
            }
        ?>
    </div>
</body>
</html>