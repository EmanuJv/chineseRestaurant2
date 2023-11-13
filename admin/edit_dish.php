<?php 
    /*
     * 0. include database connection file
     * 1. receive form values from post and insert them into the table (match table field with values from name atributte)
     * 2. for the destination_image insert the value "destination-placeholder.webp"
     * 3. redirect to destinations-list. php after complete the insert into
     */

     require_once '../database.php';

     // Reference: https://medoo.in/api/select
     $item = $database->select("tb_dishes","*");

    // Reference: https://medoo.in/api/select
     $item = $database->select("tb_categories","*");

     // Reference: https://medoo.in/api/select
     $item = $database->select("tb_group_categories","*");

     $message = "";

     if($_GET){
        $item = $database->select("tb_dishes","*",[
            "dish_id" => $_GET["id"],
        ]);
     }

     if($_POST){

        $data = $database->select("tb_dishes","*",[
            "dish_id"=>$_POST["id"]
        ]);

        if(isset($_FILES["dish_image"]) && $_FILES["dish_image"]["name"] != ""){

            $errors = [];
            $file_name = $_FILES["dish_image"]["name"];
            $file_size = $_FILES["dish_image"]["size"];
            $file_tmp = $_FILES["dish_image"]["tmp_name"];
            $file_type = $_FILES["dish_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["dish_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpeg", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not valid";
                $message = "File type is not valid";
            }

            if(empty($errors)){
                $filename = strtolower($_POST["dish_name"]);
                $filename = str_replace(',', '', $filename);
                $filename = str_replace('.', '', $filename);
                $filename = str_replace(' ', '-', $filename);
                $img = "location-".$filename.".".$file_ext;
                move_uploaded_file($file_tmp, "../imgs/".$img);
            }
        }else{
            $img = $data[0]["dish_image"];
        }

        $database->update("tb_dishes",[
            "dish_name"=> $_POST["dish_name"],
            "dish_name_ch"=>$_POST["dish_name_ch"],
            "description"=>$_POST["description"],
            "description_ch"=>$_POST["description_ch"],
           // "category_id"=>$_POST["category_id"],
            //"dish_featured"=>$_POST["dish_featured"],
            //"people_category_id"=>$_POST["people_category_id"],
            "dish_image"=> $img,
            "price"=>$_POST["price"]
        ],[
            "dish_id" => $_POST["id"]
        ]);

        header("location: dish_list.php");
        
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination</title>
   <!-- <link rel="stylesheet" href="../css/themes/admin.css">-->
</head>
<body>
    <div class="container">
        <h2>Edit Destination</h2>
        <?php 
            echo $message;
        ?>
        <form method="post" action="edit_dish.php" enctype="multipart/form-data">
            <div class="form-items">
                <label for="dish_name">Dish Name</label>
                <input id="dish_name" class="textfield" name="dish_name" type="text" value="<?php echo $item[0]["dish_name"] ?>">
            </div>
            <div class="form-items">
                <label for="dish_name_fr">Dish Name Chinese</label>
                <input id="dish_name_ch" class="textfield" name="dish_name_ch" type="text" value="<?php echo $item[0]["dish_name_ch"] ?>">
            </div>
            <div class="form-items">
                <label for="description">Description</label>
                <textarea id="description" name="description" id="" cols="30" rows="10"><?php echo $item[0]["description"]; ?></textarea>
            </div>
            <div class="form-items">
                <label for="description_ch">Description Chinese</label>
                <textarea id="description_ch" name="description_ch" id="" cols="30" rows="10"><?php echo $item[0]["description_ch"]; ?></textarea>
            </div>
            <!-- <div class="form-items">
                <label for="category_id">Categories </label>
                <select name="category_id" id="category_id">
                  
                </select>
            </div> -->
            <!-- <div class="form-items">
                <label for="people_category_id">People Category</label>
                <select name="people_category_id" id="people_category_id">
                   
                </select>
            </div> -->
            
            <div class="form-items">
                <label for="dish_image">Image</label>
                <img id="preview" src="../imgs/<?php echo $item[0]["dish_image"]; ?>" alt="Preview">
                <input id="dish_image" type="file" name="dish_image" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="price">Price</label>
                <input id="price" class="textfield" name="price" type="text" value="<?php echo $item[0]["price"] ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $item[0]["dish_id"]; ?>">
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Update Destination">
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