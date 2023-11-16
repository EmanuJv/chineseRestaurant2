<?php 
    /***
     * 0. include database connection file
     * 1. receive form values from post and insert them into the table (match table field with values from name atributte)
     * 2. for the destination_image insert the value "destination-placeholder.webp"
     * 3. redirect to destinations-list. php after complete the insert into
     */

     require_once '../database.php';

     // Reference: https://medoo.in/api/select
     $category = $database->select("tb_categories","*");

     $item = $database->select("tb_dishes","*");

     // Reference: https://medoo.in/api/select
     $people = $database->select("tb_group_categories","*");

     if($_POST){
        // Reference: https://medoo.in/api/insert
        $database->insert("tb_dishes",[
            "dish_name"=>$_POST["dish_name"],
            "description"=>$_POST["description"],
            "dish_image"=> "destination-placeholder.webp",
            "id_cat_group"=>$_POST["id_cat_group"],
            "featured"=>$_POST["featured"],
            "price"=>$_POST["price"],
            "id_category"=> $_POST["id_category"]
        ]);
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dish</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="container">
        <h2>Add New Dish</h2>
        <form method="post" action="add-dish.php">
        
            <div class="form-items">
                 <label for="id_category">Category Dish</label>
                <select name="id_category" id="id_category">
                <?php 
                    foreach($category as $category_name){
                    echo "<option value='".$category_name["id_category"]."'>".$category_name["category_name"]."</option>";
                    }
                 ?>
                </select>
            </div>

            <div class="form-items">
                <label for="dish_name">Dish Name</label>
                <input id="dish_name" class="textfield" name="dish_name" type="text">
            </div>
            <div class="form-items">
                <label for="description">Dish Description</label>
                <textarea id="description" name="description" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-items">
                <label for="dish_image">Dish Image</label>
                <img id="preview" src="../imgs/destination-placeholder.webp" alt="Preview">
                <input id="dish_image" type="file" name="dish_image" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="id_cat_group">People</label>
                <select name="id_cat_group" id="id_cat_group">
                    <?php 
                        foreach($people as $peoples){
                            echo "<option value='".$peoples["id_cat_group"]."'>".$peoples["cat_group_name"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="featured">Featured</label>
                <select id="featured" class="boxSelect" name="featured">
                    <option value="1" <?php echo $item[0]["featured"] ? 'selected' : ''; ?>>Yes</option>
                    <option value="0" <?php echo !$item[0]["featured"] ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
            <div class="form-items">
                <label for="price">Dish Price</label>
                <input id="price" class="textfield" name="price" type="text">
            </div>
            
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Add New Destination">
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