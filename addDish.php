<?php 
    require_once 'database.php';
    // Reference: https://medoo.in/api/where
    if($_GET){
        $data = $database->select("tb_dishes","*",[
            "dish_name"=>$_GET["dish_name"]
        ]);
    }
   
?>
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dish</title>
    <link rel="stylesheet" href="./css/themes/admins.css"> 
</head>
<body class="backgroundRegister">
    <div class="addDish-container">
        <h2>Add New Dishes</h2>
        <form method="post" action="addDish.php" >
    <div class="form-items">
        <label for="dish_name">Dish Name</label>
        <input id="dish_name" class="textfield" name="dish_name" type="text">
    </div>

    <div class="form-items">
        <label for="dish_image">Dish Image</label>
        <img id="preview" src="./imgs/destination-placeholder.webp" alt="Preview">
        <input id="dish_image" type="file" name="dish_image" onchange="readURL(this)">
    </div>
   
    <div class="form-items">
        <label for="description">Description</label>
        <textarea id="description" name="description" id="" cols="30" rows="10"></textarea>
    </div>
   
    <div class="form-items">
        <label for="price">Price</label>
        <input id="price" class="textfield" name="price" type="text">
    </div>
    <div class="form-items">
        <input class="submit-btn" type="submit" value="Add New Dish">
    </div>
</form>
    </div>

    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>
    
</body>
</html>