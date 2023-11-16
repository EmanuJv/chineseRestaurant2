<?php 
    /***
     * 0. include database connection file
     * 1. receive form values from post and insert them into the table (match table field with values from name atributte)
     * 2. for the destination_image insert the value "destination-placeholder.webp"
     * 3. redirect to destinations-list. php after complete the insert into
     */

     require_once '../database.php';

     if($_GET){
        $item = $database->select("tb_dishes","*",[
            "dish_id" => $_GET["id"],
        ]);
     }

     if($_POST){

       $data = $database->delete("tb_dishes",[
            "dish_id"=> $_POST["id"]
        ]);

        header("location: dish-list.php");
        
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dish</title>
    <link rel="stylesheet" href="./css/themes/admin.css">
</head>
<body>
    <div class="container">
        <h2>Delete Dish?</h2>
        <form form method="post" action="delete-dish.php"  enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $item[0]["dish_id"]; ?>">
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Delete Dish">
            </div>
        </form>
        <div class="form-items">
            <a class="admin-btn" href="./dish-list.php">Back</a>
        </div>
    </div>
</body>
</html>