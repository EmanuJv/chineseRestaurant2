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
            //var_dump($user[0]["id_customer"]);
            if (password_verify($_POST["pass"], $user[0]["pass"])) {
                session_start();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["fullname"] = $user[0]["fullname"];
                //var_dump($_SESSION["fullname"]);

                if ($user[0]["type_user"] === 1) {
                    header("location: admin/dish-list.php");
                } else {
                    header("location: ./index.php?id=" . $_POST["username"]);
                }
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
                <?php
                session_start();
                if (isset($_SESSION["isLoggedIn"])) {
                    echo " <li><a class='nav-list-link' href='./history.php'>User history</a></li>";
                    echo "<li><a class='nav-list-link' href='./menu.php'>Menu</a></li>";
                    echo "<li><a class='nav-list-link' href='./cart.php'>Cart</a></li>";
                    echo "<li><a class='nav-list-link' href='./index.php'>" . $_SESSION["fullname"] . "</a></li>";
                    echo "<li><a class='nav-list-link' href='./logout.php'>Logout</a></li>";
                } else {
                    echo " <li><a class='nav-list-link' href='./history.php'>User history</a></li>";
                    echo "<li><a class='nav-list-link' href='./menu.php'>Menu</a></li>";
                    echo "<li><a class='nav-list-link' href='./cart.php'>Cart</a></li>";
                    echo "<li><a class='nav-list-link' href='./register.php'>Sing up</a></li>";
                    echo " <li><a class='nav-list-link' href='./login.php'>Login</a></li>";
                }
                ?>
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

                    <input id='username' class='inpt-register' type='text' name='username' required />
                </div>

                <div>
                    <label class='lb-register' for='pass'>Password</label>

                    <input id='pass' class='inpt-register' type='password' name='pass' required />
                </div>

                <div class="btn-forms-info">
                    <a class="link-login" href="recover-pass.php">have you forgotten your password?</a>

                    <input class='inpt-register btn-login btn' type='submit' value="LOGIN">

                    <p>
                        <?php echo $messageLogin; ?>
                    </p>

                    <input type="hidden" name="login" value="1">
                </div>

            </form>
        </div>
    </main>
</body>

</html>