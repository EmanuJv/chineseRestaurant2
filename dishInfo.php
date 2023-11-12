<?php
    require_once './database.php';
    
    if($_GET){
        // Reference: https://medoo.in/api/where
        /*$item = $database->select("tb_destinations","*",[
            "id_destination"=>$_GET["id"]
        ]);*/

        // Reference: https://medoo.in/api/select
        // Note: don't delete the [>] 
        $item = $database->select("tb_dishes",[
            "[>]tb_group_categories"=>["id_cat_group" => "id_cat_group"],
            "[>]tb_categories"=>["id_category" => "id_category"]
        ],[
            "tb_dishes.id_dish",
            "tb_dishes.dish_name",
            "tb_dishes.dish_image",
            "tb_dishes.category",
            "tb_dishes.featured",
            "tb_dishes.description",
            "tb_dishes.capacity",
            "tb_dishes.price",
            "tb_dishes.id_category",
            "tb_dishes.id_cat_group",
            "tb_categories.category_name",
            "tb_categories.category_description",
        ],[
            "id_dish"=>$_GET["id"]
        ]);

        //

        // Reference: https://medoo.in/api/select
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
            <a href="./index.html"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!-- Mobile Menu Button (Controlled by Checkbox) -->
            <input class="mobile-cb" type="checkbox">3
            <label class="mobile-btn">
                <span></span>
            </label>

            <!-- navigation list -->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.html">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.html">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.html">CART</a></li>
                <li><a class="nav-list-link" href="./register.html">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.html">LOGIN</a></li>
            </ul>
        </nav>
    </header>

    

    <!-- main content  -->
    <main>
        <div class="dishInfo-container">
            <h2>Sweet and Sour Chicken</h2> <!-- dish title -->
            
            <!-- info and Image container -->
            <div class="infoImageDish">
                <img class="infoImage" src="./imgs/menu/appetizerTwo.png" alt="appetizer">
                <!-- Image-->
                <p>Sweet and Sour Chicken is a classic in Chinese cuisine that harmoniously blends contrasting flavors into one dish. Tender chicken pieces are </p>
                <!-- description -->
            </div>

            <!-- Dish details -->
            <div class="dishInfoDetails">
                <h5>Main Dish</h5> 
                <h5>Related Dishes</h5>
                <h5>Featured Dish</h5> 
                <img class="icon-persons" src="./imgs/familiar.png" alt="familiar">

            </div>

            <!-- Price and button -->
            <div class="infoPrice">
                <p>$12</p> 
                <a href="./menu.html" class="btn-order-dish btn">Go To Menu</a> 
                <a href="#" class="btn-order-dish btn">Add To Cart!</a> 
            </div>
        </div>
    </main>
</body>
</html>
