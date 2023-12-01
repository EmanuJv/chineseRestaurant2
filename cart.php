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

    <!-- Main content -->
    <main>
        <div class="order-container">
            <div class="cta-up-cart">
                <h2 class="thanks-title">Thanks</h2>
                <p class="yourOrder-txt">Your Order:</p>
            </div>
        </div>

        <!--Buttons to cancel or pay the order -->
        <div class="orderBtns-container">
            <a href="./menu.php" class="btn-order-modal btn">Cancel Order</a>
            <a href="#" class="btn-order-modal btn">PayOut</a>
        </div>
    </main>
</body>
</html>
