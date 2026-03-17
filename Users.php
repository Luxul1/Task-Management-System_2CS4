<?php

header("Content-Type: application/json");
require_once "../database/connect.php";
require_once "../Model/Usermodel.php";

$database = new database();
$pdo = $database->getConnection();
$users = new users($pdo);

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case "GET":
        $data = $users->RetrieveAssignedTask($_GET['user_id'] ?? null);
        echo json_encode($data);

        $data = $users->RetrieveUsers($_GET['user_id'] ?? null);
        echo json_encode($data);
        break;


    case "POST":
        $data = $users->CreateUser(
            $input['first_name'] ?? null,
            $input['last_name'] ?? null,
            $input['email'] ?? null,
            $input['role'] ?? null,
        );

        if($data){
            echo json_encode(["message" => "User Created."]);
        }
        else{
            echo json_encode(["message" => "User Creation Failed."]);
        }
        break;

    case "PUT":
            parse_str($_SERVER['QUERY_STRING'], $query);
            $input = json_decode(file_get_contents("php://input"), true);

                 $data = $users->UpdateUser(
                    $query['user_id'] ?? null,
                    $input['first_name'] ?? null,
                    $input['last_name'] ?? null,
                    $input['email'] ?? null,
                    $input['role'] ?? null
                );

            echo json_encode([
                "message" => $data ? "Update successful" : "Update failed"
            ]);
        break;

    case "DELETE":
        parse_str($_SERVER['QUERY_STRING'], $query);
        $user_id = $query['user_id'] ?? null;

        $success = $users->deleteuser($user_id);

        if ($success){
            echo json_encode(["message" => "Task deleted"]);
        } else {
            echo json_encode(["message" => "Delete failed or ID not found"]);
        }
        break;


}
?>