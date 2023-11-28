<?php
require_once './database.php';
$message = "";
$messageLogin = "";

if ($_POST) {

    if (isset($_POST["login"])) {
        $user = $database->select("tb_customers", "*", [
            "username" => $_POST["username"]
        ]);

        if (count($user) > 0) {
            if (password_verify($_POST["pass"], $user[0]["pass"])) {
                session_start();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["username"] = $user[0]["username"];
                header("location: index.php");
            } else {
                $messageLogin = "wrong username or password";
            }
        } else {
            $messageLogin = "wrong username or password";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Restaurant</title>
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

            <!--Navigation list-->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.html">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.php">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.html">CART</a></li>
                <li><a class="nav-list-link" href="./register.php">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.php">LOGIN</a></li>
            </ul>


        </nav>
    </header>

    <!--Register-->


    <main>
        <div class="register-container">
            <h2 class="register-welcome">Welcome!</h2>

            <form method="post" action="login.php" class="register-form">
                <div>
                    <label class='lb-register' for='username'>Username</label>
                </div>
                <div>
                    <input id='username' class='inpt-register' type='text' name='username'>
                </div>


                <div>
                    <label class='lb-register' for='password'>Password</label>
                </div>
                <div>
                    <input id='password' class='inpt-register' type='password' name='password'>


                </div>

                <div class="btn-forms-info">
                    <a class="link-login" href="./register.php">have you forgotten your password?</a>

                    <input class='inpt-register btn-login btn' type='submit' value="LOGIN">

                    <p>
                        <?php echo $messageLogin; ?>
                    </p>

                    <input type="hidden" name="login" value="1">
                </div>
        </div>
        </form>
    </main>
</body>

</html>