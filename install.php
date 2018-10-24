<?php
    #   CREATE DATABASE FOR USER ACCOUNTS   #
    $file = fopen("people.json", "w") or die("Could not create people.json");
    fwrite($file,"[]");//store an empty array
    fclose($file);
    #***************************************#

    #   CREATE DATABASE FOR CATEGORIES   #
    $file = fopen("categories.json", "w") or die("Could not create categories.json");
    fwrite($file,"[]");//store an empty array
    fclose($file);
    #***************************************#

    #   CREATE DATABASE FOR USER ORDERS   #
    $file = fopen("orders.json", "w") or die("Could not create orders.json");
    fwrite($file,"[]");//store an empty array
    fclose($file);
    #***************************************#    
?>