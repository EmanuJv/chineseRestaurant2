
<?php

 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_dishes","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish List</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
<a class='btn btn-order-dish' href='../menu.php'>Menu</a>
    <h2 class='.recipe-title'>List Dishes</h2>
    <table class="list-container">
        <?php
            foreach($items as $item){
                echo "<tr>";
                echo "<td class='recipe-title'>".$item["dish_name"]."</td>";
                //echo "<td>".$item["email"]."</td>";
                echo "<td><a href='edit-dish.php?id=".$item["dish_id"]."'>Edit</a> <a href='delete-dish.php?id=".$item["dish_id"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>