<?php
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_dishes","*");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <nav class="top-nav">
            <a href="./index.html"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>

            <p class="nav-title">Shípǔ</p>

            <!--mobile nav btn (camping extracted)-->

            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span>

                </span>
            </label>

            <!--Navigation List-->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.html">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.html">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.html">CART</a></li>
                <li><a class="nav-list-link" href="./register.html">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.html">LOGIN</a></li>
            </ul>


        </nav>
    </header>

    <main>


        <div class="menu-bg-container">
            <h2 class="menuText">MENU</h2>
            <p class="phras-text">"Gastronomy is the art of using food to create happiness"</p>
        </div>

        <!--Appetizers-->

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Appetizers</h2>
        </div>

        <div class="menu">

        <?php

foreach ($items as $item) {
    if ($item["id_category"] == 1) {
    echo "<div class='food-items'>";
    echo "<img class='dish_image' src='./imgs/imgsSC/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
    echo "<div class='details'>";
    echo "<div class='details-sub'>";
    echo "<h5>" . $item["dish_name"] . "</h5>";
    echo "<h5 class='price'>$" . $item["price"] . "</h5>";
    echo "</div>";
    echo "<p>" . substr($item["description"], 0, 200) . "...</p>";
    echo "<a class='order-now' href='dishInfo.php?id=" . $item["dish_id"] . "'>Order NOW!</a>";
    echo "</div>";
    echo "</div>";
    }
    }
        ?>


        </div>

        <!--Appetizers-->

        

        <!--Main Dishes-->

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Main Dishes</h2>
        </div>

        <div class="menu">

        <div class="menu">

<?php

foreach ($items as $item) {
if ($item["id_category"] == 2) {
echo "<div class='food-items'>";
echo "<img class='dish_image' src='./imgs/imgsSC/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
echo "<div class='details'>";
echo "<div class='details-sub'>";
echo "<h5>" . $item["dish_name"] . "</h5>";
echo "<h5 class='price'>$" . $item["price"] . "</h5>";
echo "</div>";
echo "<p>" . substr($item["description"], 0, 200) . "...</p>";
echo "<a class='order-now' href='dishInfo.php?id=" . $item["dish_id"] . "'>Order NOW!</a>";
echo "</div>";
echo "</div>";
}
}
?>


</div>

        </div>
        <!--Main Dishes-->

        <!--Desserts-->

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Desserts</h2>
        </div>
        <div class="menu">

        <?php

foreach ($items as $item) {
if ($item["id_category"] == 3) {
echo "<div class='food-items'>";
echo "<img class='dish_image' src='./imgs/imgsSC/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
echo "<div class='details'>";
echo "<div class='details-sub'>";
echo "<h5>" . $item["dish_name"] . "</h5>";
echo "<h5 class='price'>$" . $item["price"] . "</h5>";
echo "</div>";
echo "<p>" . substr($item["description"], 0, 200) . "...</p>";
echo "<a class='order-now' href='dishInfo.php?id=" . $item["dish_id"] . "'>Order NOW!</a>";
echo "</div>";
echo "</div>";
}
}
?>

        </div>
        <!--Desserts-->


        <!--Beverages-->

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Beverages</h2>
        </div>

        <div class="menu">
            <div class="food-items">
                <img src="./imgs/menu/beverageOne.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

            <div class="food-items">
                <img src="./imgs/menu/BeverageTwo.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

            <div class="food-items">
                <img src="./imgs/menu/beverageThree.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

            <div class="food-items">
                <img src="./imgs/menu/beverageFour.png">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

            <div class="food-items">
                <img src="./imgs/menu/beverageFive.png">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

            <div class="food-items">
                <img src="./imgs/menu/beverageSix.png">
                <div class="details">
                    <div class="details-sub">
                        <h5>BBQ Sandwich</h5>
                        <h5 class="price"> $10 </h5>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus reiciendis nam non quia! Earum
                        eveniet quia minus nemo.</p>
                    <a href="./dishInfo.html">Order Now!</a>
                </div>
            </div>

        </div>
        <!--Beverages-->
        <div class="img-animated-container">
            <img class="img-animated" src="./imgs/menu/animatedPic.jpg" alt="Imagen Animada">
            <p class="menu-decoration-text">
                "Chinese food, with its ancient culinary traditions, is a magical journey that takes us through <br> an
                exquisite symphony of flavors and textures, where the balance between sweet and salty, spicy and soft,
                <br> becomes a dance on the palate that transports us to remote places and immerses us in the rich
                history and culture of this wonderful nation, reminding <br> us that food is much more than sustenance;
                it is a bridge that connects people, a form of artistic expression and a legacy that is passed <br> down
                from generation to generation, celebrating diversity and creativity in every bite."
            </p>
        </div>


    </main>


    <footer class="footer-container">
        <div class="footer-content">
            <section>
                <h3 class="footer-decoration">Shipú Online Restaurant</h3>
                <p>Welcome to Shipú, the groundbreaking virtual Chinese restaurant that brings the flavors of
                    China
                    to your doorstep! At Shipú, we combine authentic Chinese cuisine with modern culinary
                    techniques
                    to craft an array of delectable dishes that will transport you to the heart of China </p>
            </section>
            <div class="footer-schedule">
                <h3 class="footer-decoration">Schedule and Services</h3>
                <h4>Sunday to Thursday from 12:00 p.m. to 10:00 p.m. | Friday and Saturday from 12:00 p.m. to 11:00 p.m
                    <br> <br>
                    .Wi Fi <br>

                    .After Office <br>

                    .Spicy - Gluten Free - Vegetarian <br>

                    .A/C
                </h4>
            </div>
            <div class="footer-links">
                <section>
                    <h3 class="footer-decoration">Follow us on:</h3>
                    <div class="cta-app-container">
                        <a href="https://www.instagram.com"><img class="instagram" src="./imgs/instagram.png"
                                alt="instagram"></a>
                        <a href="https://www.facebook.com"><img class="facebook" src="./imgs/facebook.png"
                                alt="facebook"></a>
                        <a href="https://www.twitter.com"><img class="twitter" src="./imgs/twitter.png"
                                alt="twitter"></a>

                    </div>

                </section>
            </div>

        </div>
        <section class="download-app">
            <h3>Download our App</h3>
            <div class="cta-app-container">
                <a href="#"><img src="./imgs/app-store.png" alt="Our app from App Store"></a>
                <a href="#"><img src="./imgs/google-play.png" alt="Our app from Google Play"></a>
            </div>
        </section>
        <p class="footer-legal">&copy; 2023. All rights reserved.</p>
    </footer>
</body>

</html>