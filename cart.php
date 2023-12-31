<?php
require_once './database.php';


$dish_details = [];
$updateCookie = false;

// Check if 'dishes' key exists in $_COOKIE
if (isset($_COOKIE['dishes'])) {
    $data = json_decode($_COOKIE['dishes'], true);

    // Check if json_decode was successful
    if ($data !== null) {
        if (isset($_GET["buy"]) && $_GET["buy"] >= 0 && $_GET["buy"] < count($data)) {
            // Check if the index is valid before using array_splice
            array_splice($data, $_GET["buy"], 1);
            $updateCookie = true;
        }

        $buy_details = $data;

        if ($updateCookie) {
            // Update the cookie only if necessary
            setcookie('dishes', json_encode($buy_details), time() + 72000);
        }
    } else {
        // Handle the case where JSON decoding fails
        echo "Error decoding JSON from cookie.";
    }
} else {
    // Handle the case where 'dishes' key is not present in $_COOKIE
    echo "'dishes' key not found in the cookie.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">


</head>

<body class="backgroundRegister">


    <header>
        <!-- top navigation bar -->
        <nav class="top-nav">
            <!-- Logo and title -->
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!--Mobile Menu Button (Controlled by Checkbox) -->
            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>

            <!-- Navigation list-->
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

    <!-- Main content -->
    <main>
        <div class="order-container">
            <div class="cta-up-cart">
                <h2 class="thanks-title">Thanks</h2>
                <p class="yourOrder-txt">Your Order:</p>
                <?php
                if ($buy_details == null) {
                    echo "<p>You need to order a dish first.</p>";
                } else {

                    echo "<table style='margin-top: 2rem;'>"
                        . "<tr class='activity-title'>"
                        . "<td>Dish Name</td>"
                        . "<td>Amount</td>"
                        . "<td>Price</td>"
                        . "<td>People</td>"
                        . "<td>Total</td>"
                        . "</tr>";

                    foreach ($buy_details as $index => $buy) {

                        $subtotal_dish = $buy["cost"];

                        $data = $database->select("tb_dishes", "*", ["dish_id" => $buy["id"]]);
                        echo "<tr><td></td></tr>";
                        echo "<tr>"
                            . "<td class='activity-title'>" . $data[0]["dish_name"] . "</td>"
                            . "<td>" . $buy["people"] . "</td>"
                            . "<td> $" . $subtotal_dish . "</td>"
                            . "</tr>";

                    }
                    echo "</table>";
                }
                ?>
            </div>
        </div>

        <!--Buttons to cancel or pay the order -->
        <div class='orderBtns-container'>
            <?php
            if ($buy_details != null)
                echo "<div><a class='btn-order-modal btn' href='menu.php'>PayOut</a></div>";

            ?>
            <div><a class='btn read-btn' href='menu.php'>Continue exploring dishes</a></div>
        </div>



    </main>
</body>

</html>