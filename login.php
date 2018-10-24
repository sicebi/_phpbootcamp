<?php
    require("check_user.php");
    session_start();

    #   GET NUMBER OF PRODUCTS IN CART  #
    if (isset($_SESSION['cart']))
        $cart_size = count($_SESSION['cart']);
    else
        $cart_size = 0;    

    $error_message = "";
    if (isset($_SESSION["email"]) && isset($_SESSION["password"]))
        header("Location: index.php");
    if(isset($_POST["email"]) && isset($_POST["password"]))
    { 
        $filename = "people.json";
        $people = file_get_contents($filename);

        #   FORMAT JSON DATA INTO AN ASSOCIATIVE ARRAY  #
        $people_list = json_decode($people, true);

        #   CHECK IF USER EXISTS    #
        if (user_exists($people_list, $_POST["email"], $_POST["password"]) == 1)
        {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
            header("Location:$_SERVER[HTTP_REFERER]");
        }
        else
            $error_message = "Email or password incorrect.";
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
    <title>Shop - Login</title>
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
    <?php if (strlen($error_message) > 0) echo "<p class='error'>$error_message</p>" ?>
    <form action="login.php" method="post">
        <div>
            <input class="form-inputs" type="email" name="email" placeholder="Enter Email">
        </div>
        <div>
            <input class="form-inputs" type="password" name="password" placeholder="Enter Password">
        </div>
        <button class="login-button" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>