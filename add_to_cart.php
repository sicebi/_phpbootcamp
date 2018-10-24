<?php
    session_start();
    $cart = array();
    $found = false;
    $prod = array("id" => $_GET['productid'], "quantity" => 1);
    if (isset($_SESSION['cart']))
        $cart = $_SESSION['cart']; 
    
    #   CHECK IF CART HAS ALREADY BEEN ADDED TO CATT    #
    for($i = 0; $i < count($cart); $i++)
    {
        $prod_in_cart = $cart[$i];
        if($prod_in_cart["id"] == $_GET['productid'])
        {
            if ($_GET['action'] == "add")
            {
                $prod_in_cart["quantity"] = $prod_in_cart["quantity"] + 1;
                $cart[$i] = $prod_in_cart;
            }
            if ($_GET['action'] == "dec")
            {
                $prod_in_cart["quantity"] = $prod_in_cart["quantity"] - 1;
                if($prod_in_cart["quantity"] < 0) $prod_in_cart["quantity"] = 0;
                $cart[$i] = $prod_in_cart;
            }
            $found = true;
            break;
        }
    }

    if (!$found)
        array_push($cart, $prod);
    
    $_SESSION['cart'] = $cart;
    ///print_r($_SESSION['cart']);
    $ref = $_SERVER["HTTP_REFERER"];
    #   RETURN BACK TO THE PREVIOUS PAGE    #
    header("Location: $ref");
?>