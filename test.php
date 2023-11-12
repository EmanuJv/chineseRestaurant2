<?php
require_once 'database.php';

if ($_GET && isset($_GET["dishname"])) {
    $data = $database->select("tb_dishes", "*", array("dish_name" => $_GET["dish_name"]));


    if ($data) {
        $dish = $data[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Details</title>
</head>
<body>
    <h2>Dish Details</h2>
    <p>Name: <?php echo $dish["dish_name"]; ?></p>
    <img src="<?php echo $dish["dish_image"]; ?>" alt="Dish Image">
    <p>Description: <?php echo $dish["description"]; ?></p>
    <p>Price: $<?php echo $dish["price"]; ?></p>
</body>
</html>

<?php
    } else {
        echo "No se encontraron datos para el nombre proporcionado.";
    }
}
?>
