<?php
require_once './database.php';
$message = "";

if ($_POST) {



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
            //get added user
            $newUser = $database->select("tb_customers", [
                "id_customer",
                "fullname"
            ], [
                "username" => $_POST["username"]
            ]);

            //start sessiona and create session variables
            session_start();
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["fullname"] = $newUser[0]["fullname"];

            //redirect to home page
            header("location: index.php");

            //header("location: menu.php?id=" . $_POST["register"]);
        }
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
    <main>

        <div class='register-container'>
            <h3 class='register-welcome'>Welcome!</h3>

            <form method="post" action="register.php" class="register-form">

                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='fullname'>Fullname</label>

                        <input id='fullname' class='inpt-register' type='text' name='fullname'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='email'>Email Address</label>

                        <input id='email' class='inpt-register' type='text' name='email'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='username'>Username</label>

                        <input id='username' class='inpt-register' type='text' name='username'>
                    </div>
                </div>
                <div class='form-items'>
                    <div>
                        <label class='lb-register' for='pass'>Password</label>
                        <input id='pass' class='inpt-register' type='password' name='pass'>
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