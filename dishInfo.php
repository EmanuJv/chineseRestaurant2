<?php
    require_once './database.php';

    $lang = "CH";

    $url_params = "";
    
    if($_GET){

        if(isset($_GET["lang"]) && $_GET["lang"] == "ch"){
            $item = $database->select("tb_dishes",[
                "[>]tb_categories"=>["id_category" => "id_category"]
            ],[
                "tb_dishes.dish_id",
                "tb_dishes.dish_name_ch",
                "tb_dishes.description_ch",
                "tb_dishes.dish_image",
                "tb_dishes.price",
                "tb_categories.category_name",
                "tb_categories.category_description",
            ],[
                "dish_id"=>$_GET["id"]
            ]);

            //references
            $item[0]["dish_name"] = $item[0]["dish_name_ch"];
            $item[0]["description"] =  $item[0]["description_ch"];

            $lang = "EN";
            $url_params = "?id=".$item[0]["dish_id"];
        }else{
            $item = $database->select("tb_dishes",[
                "[>]tb_categories"=>["id_category" => "id_category"]
            ],[
                "tb_dishes.dish_id",
                "tb_dishes.dish_name",
                "tb_dishes.dish_name_ch",
                "tb_dishes.description",
                "tb_dishes.description_ch",
                "tb_dishes.dish_image",
                "tb_dishes.price",
                "tb_categories.category_name",
                "tb_categories.category_description"
            ],[
                "dish_id"=>$_GET["id"]
            ]);

            $lang = "CH";
            $url_params = "?id=".$item[0]["dish_id"]."&lang=ch";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Info Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css"> 

    <!--This is the beginning of the header -->
</head>
<body class="backgroundDishInfo">
    <!-- Start of the body of page -->

    <!-- Page Header -->
    <header>
        <!-- Top navigation bar -->
        <nav class="top-nav">
            <!--Logo and title -->
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!-- Mobile Menu Button (Controlled by Checkbox) -->
            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>

            <!-- navigation list -->
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

    

    <!-- main content  -->
    <main>
        <?php 
             echo "<div class='dishInfo-container'>";
             echo "<a class='translate' href='dishInfo.php".$url_params."'>".$lang."</a>";
             echo "<h2>" . $item[0]["dish_name"] . "</h2>";
               echo "<div class='infoImageDish'>";
               echo "<img class='infoImage' src='./imgs/imgsSC/" . $item[0]["dish_image"] . "'>";
               echo "<p>".$item[0]["description"]."</p>";
               echo "</div>";
               echo "<div class='dishInfoDetails'>";
               echo "<h5>Main Dish</h5>";
               echo "<h5>Related Dishes</h5>";
               echo "<h5>Featured Dish</h5>";
               echo "</div>";
               echo "<div class='infoPrice'>";
               echo "<span>$".$item[0]["price"]."</span>";
               echo "<a class='btn btn-order-dish' href='menu.php'>Menu</a>";
               echo "<a class='btn btn-order-dish' href='cart.php?id=".$item[0]["dish_id"]."'>BUY</a>";
               echo "</div>";
               echo "</div>";
        ?>
            

    </main>
</body>
</html>
