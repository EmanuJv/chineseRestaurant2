<?php
require_once './database.php';

$message = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $user = $database->get("tb_customers", "*", ["username" => $username]);

    if ($user) {

        $new_password = bin2hex(random_bytes(8));

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT, ['cost' => 12]);

        $database->update("tb_customers", ["pass" => $hashed_password], ["username" => $username]);

        $message = "Your new password is: <strong>$new_password</strong> Save this password in a safe place.";

    } else {
        $message = "The username does not exist in our database.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<header class="">
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
                echo "<li><a class='nav-list-link' href='./menu.php'>Menu</a></li>";
                echo "<li><a class='nav-list-link' href='./index.php'>" . $_SESSION["fullname"] . "</a></li>";
                echo "<li><a class='nav-list-link' href='./logout.php'>Logout</a></li>";
            } else {
                echo "<li><a class='nav-list-link' href='./menu.php'>Menu</a></li>";
                echo "<li><a class='nav-list-link' href='./register.php'>Sing up</a></li>";
                echo " <li><a class='nav-list-link' href='./login.php'>Login</a></li>";
            }
            ?>
        </ul>


    </nav>




</header>

<body>


    <div class="hero-container">
        <div class="register-container">
            <?php if (!empty($message)): ?>
                <p>
                    <?php echo $message; ?>
                </p>
            <?php endif; ?>
            <form class="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class='lb-register' for="username">Username:</label>
                <input class='inpt-register' type="text" id="username" name="username" required>
                <button class='btn btn-order-dish' type="submit" name="submit">Recovery Password</button>

                <a class='btn btn-order-dish' href='menu.php'>Menu</a>
            </form>
        </div>
    </div>
</body>

</html>