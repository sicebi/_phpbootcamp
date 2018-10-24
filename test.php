<?php
    $filename = "categories.json";
   $categories = file_get_contents($filename);
   echo $categories, "helloss";
   $cat_arr = json_decode($categories, true);
   var_dump($cat_arr);
   $name = "name";
   $surname = "Surname";

   $new_entery = array("name" => $name, "surname" => $surname);
   array_push($cat_arr,$new_entery);
   echo "<br>";
   var_dump($cat_arr);
   echo json_encode($cat_arr);
?>