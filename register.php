<?php
require_once './database.php';
$message = "";


if (isset($_POST["register"])) {
    //validate if user already registered
    $validateUsername = $database->select("tb_customers", "*", [
        "username" => $_POST["username"]
    ]);

    if (count($validateUsername) > 0) {
        $message = "This username is already registered";
    } else {
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT, ['cost' => 12]);
        $database->insert("tb_customers", [
            "fullname" => $_POST["fullname"],
            "username" => $_POST["username"],
            "pass" => $pass,
            "email" => $_POST["email"]
        ]);

         header("location: menu.php?id=".$_POST["register"]);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body class="backgroundRegister">

    <header>
        <nav class="top-nav">
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>

            <p class="nav-title">Shípǔ</p>

            <!--mobile nav btn (camping extracted)-->

            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span>

                </span>
            </label>


            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.php">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.php">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.php">CART</a></li>
                <li><a class="nav-list-link" href="./register.php">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.php">LOGIN</a></li>
                <?php 
                session_start();
                if (isset($_SESSION["isLoggedIn"])){
                    echo "<li><a class='nav-list-link' href='index.php'>".$_SESSION["fullname"]."</a></li>";
                    echo "<li><a class='nav-list-link' href='logOut.php'>Logout</a></li>";
                }else {
                    echo " <li><a class='nav-list-link' href='./login.php'>Login</a></li>";
                }
                ?>
            </ul>


        </nav>
    </header>
    <main>

        <div class='register-container'>
            <h3 class='register-welcome'>Welcome!</h3>

            <form method="post" action="register.php" class="register-form">

                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='fullname'>Fullname</label>
                    </div>
                    <div>
                        <input id='fullname' class='inpt-register' type='text' name='fullname'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='email'>Email Address</label>
                    </div>
                    <div>
                        <input id='email' class='inpt-register' type='text' name='email'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='username'>Username</label>
                    </div>
                    <div>
                        <input id='username' class='inpt-register' type='text' name='username'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='pass'>Password</label>
                    </div>
                    <div>
                        <input id='password' class='inpt-register' type='password' name='password'>
                    </div>
                </div>
                <div class='btn-forms-info'>
                    <div>
                        <input class='inpt-register btn-login btn' type='submit' value="REGISTER">
                    </div>
                    <p>
                        <?php echo $message; ?>
                    </p>
                    <input type="hidden" name="register" value="1">
                </div>

                <a class="link-login" href="./login.php">already have an account?</a>
            </form>
        </div>

    </main>
</body>

</html>