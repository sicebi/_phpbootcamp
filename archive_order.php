<?php
    require("get_orders.php");
    require("decode_data.php");    
    session_start();
    $all_orders = decode_data($orders);
    $cart = $_SESSION['cart'];
    $user = $_SESSION['email'];
    $new_order = array("user" => $user, "cart" => $cart);
    array_push($all_orders, $new_order);
    print_r($all_orders);
    #   PREPARE DATA TO BE STORED BACK AS JSON  #
    $prepared_json_data = json_encode($all_orders);
            
    #   OPEN FILE TO STORE DATA     #
    $file = fopen("orders.json", "w") or die("Could not open database");

    #   WRITE DATA TO FILE      #
    fwrite($file,$prepared_json_data);
    fclose($file);
    $ref = $_SERVER["HTTP_REFERER"];
    #   RETURN BACK TO THE PREVIOUS PAGE    #
    header("Location: $ref");
?>