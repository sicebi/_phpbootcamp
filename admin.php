<?php
    require("get_products.php");
    require("get_orders.php");
    require("get_people.php");
    require("decode_data.php");

    $all_products = decode_data($products);
    $all_orders = decode_data($orders);
    $all_people = decode_data($people);

    #   DELETING PEOPLE AND PRODUCTS    #

    function delete_person($id){}
    function delete_product($id){
       /* $new_arr = array();
        foreach($all_products as $prod)
        {
            if ($prod['id'] != $id)
                array_push($new_arr, $prod);
        }
        $all_products = $new_arr;
        //print_r($all_products);
        #   PREPARE DATA TO BE STORED BACK AS JSON  #
        /*$prepared_json_data = json_encode($all_products);

        #   OPEN FILE TO STORE DATA     #
        $file = fopen("products.json", "w") or die("Could not open database");

        #   WRITE DATA TO FILE      #
        fwrite($file,$prepared_json_data);
        fclose($file);*/
    }
    //function delete_person($email){}

    //function add_what($what){}
    function delete_what($what)
    {
        switch($what)
        {
            case "prod":
                delete_product($_GET['id']);
            break;
            case "person":
                delete_person($_GET['email']);
            break;        
        }
    }
    function modify_what($what){}
        
    switch($_GET['action'])
    {
        case "add":
            add_what($_GET['what']);
        break;
        case "del":
            delete_what($_GET['what']);
        break;        
        case "mod":
            modify_what($_GET['what']);
        break;        
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
    <title>Shop - Admin</title>
</head>
<body>
<div class="header">
    <h1 class="logo"><a href="admin.php">Shoopy Admin Panel</a></h1>
</div>

<script src="shop.js"></script>
<h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;">People</h1>
<div class="people">
    <?php
    foreach($all_people as $person)
    {
        echo "<div class='person'>";
        echo "<div class='profile-photo'><img src='profile.png'></div>";
        echo "<div class='personal-info'>";
        echo "<p>Name: ", $person['firstName'], "</p>";
        echo "<p>Surname: ", $person['lastName'], "</p>";
        echo "<p>Email: ", $person['email'], "</p>";
        echo "</div>";
        echo "<div class='remove'><a href='admin.php?action=del&what=person&email=",$person['email'],"'>Remove</a></div>";
        echo "</div>";
    }
    ?>
</div>

<h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;">Orders</h1>
<div class="orders">

</div>

<h1 style="text-align:center; padding:25px; font-family: 'Kumar One Outline', cursive;">Products</h1>
<div class="products">
    <?php
        foreach($all_products as $prod)
        {
            echo "<div class='product'>";
            echo "<p>",$prod['title'],"</p>";
            echo "<div class='image'><img src=",$prod['img_url'],"></div>";
            echo "<div class='price'><h2>R", $prod['price'],"</h2></div>";
            echo "<div class='remove'><a href='admin.php?action=del&what=prod&id=",$prod['id'],"'>Remove</a></div>";
            echo "</div>";
        }
    ?>
</div>

</body>
</html>