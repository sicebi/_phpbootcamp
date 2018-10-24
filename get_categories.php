<?php
    $filename = "categories.json";
    $categories = file_get_contents($filename);
    echo $categories;
?>