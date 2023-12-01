<?php
require_once './database.php';

$dish = [];

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        if ($decoded["language"] == "ch") {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name",
                "tb_dishes.description"
            ],[
                "dish_id" => $decoded["dish_id"]
            ]);
            $dish["name"] = $item[0]["dish_name"];
            $dish["description"] = $item[0]["description"];
        } else {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name_ch",
                "tb_dishes.description_ch"
            ],
                [
                "dish_id" => $decoded["dish_id"]
            ]);
            $dish["name"] = $item[0]["dish_name_ch"];
            $destination["description"] = $item[0]["description_ch"];
        }

        echo json_encode($dish);
    }
}
?>
