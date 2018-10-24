<?php
    require("check_user.php");
    session_start();

    #   GET NUMBER OF PRODUCTS IN CART  #
    if (isset($_SESSION['cart']))
        $cart_size = count($_SESSION['cart']);
    else
        $cart_size = 0;
            
    $error_message = "";
    $success_message = "";
    if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["password"]))
    { 
//        $_SESSION["email"] = $_POST["email"];
//        $_SESSION["password"] = $_POST["password"];
//        header("Location:$_SERVER[HTTP_REFERER]");
        $filename = "people.json";
        $people = file_get_contents($filename);

        #   FORMAT JSON DATA INTO AN ASSOCIATIVE ARRAY  #
        $people_list = json_decode($people, true);

        #   CHECK IF EMAIL ALREADY EXISTS   #
        if (email_exists($people_list, $_POST["email"]) == 1)
        {
            $error_message = "Email already exists.";
        }
        else
        {
            #   IF EMAIL DOES NOT EXIST CONTINUE CREATING ACCOUNT   #

            #   CREATE NEW PERSON   #
            $new_person = array("firstName" => $_POST["firstName"], "lastName" => $_POST["lastName"], "email" => $_POST["email"], "password" => $_POST["password"]);

            #   JOIN NEW PERSON INTO LIST   #
            array_push($people_list, $new_person);

            #   PREPARE DATA TO BE STORED BACK AS JSON  #
            $prepared_json_data = json_encode($people_list);

            #   OPEN FILE TO STORE DATA     #
            $file = fopen("people.json", "w") or die("Could not open database");

            #   WRITE DATA TO FILE      #
            fwrite($file,$prepared_json_data);
            fclose($file);
            $success_message = "Account created successfully! <a href='login.php'>Login here</a>";
        }
    }
    else
        $error_message = "All inputs are required.";
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
    <title>Shop - Signup</title>
</head>
<body>
<div class="header">
    <h1 class="logo"><a href="index.php">Shoopy</a></h1>
    <ul class="right-links">
        <li><a href="cart.php">Cart( <?php echo $cart_size ?> )</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</div>
<div class="login-card">
    <?php if(strlen($success_message) > 0) echo "<p class='ok'>", $success_message, "</p>";?>
    <?php if(strlen($error_message) > 0) echo "<p class='error'>", $error_message, "</p>";?>
    <form action="signup.php" method="post">
        <div>
            <input class="form-inputs" type="text" name="firstName" placeholder="First Name" required>
        </div>        
        <div>
            <input class="form-inputs" type="text" name="lastName" placeholder="Last Name" required>
        </div>        
        <div>
            <input class="form-inputs" type="email" name="email" placeholder="Enter Email" required>
        </div>
        <div>
            <input class="form-inputs" type="password" name="password" placeholder="Enter Password" required>
        </div>
        <div>
            <input class="form-inputs" type="password" name="confirmPassword" placeholder="Confirm Password" onkeyup = "confirm_password(e)" required>
        </div>
        <button class="login-button" type="submit">Sign up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
<script src="shop.js"></script>
</body>
</html>