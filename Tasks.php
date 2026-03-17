<?php

header("Content-Type: application/json");
require_once "../database/connect.php";
require_once "../Model/Taskmodel.php";

$database = new database();
$pdo = $database->getConnection();
$task = new Task($pdo);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case "GET":
            $data = $task->RetrieveTasks($_GET['task_id'] ?? null);
            echo json_encode($data); 
        break;

    case "POST":
        $success = $task->CreateTask(
            $input['task_name'] ?? null,
            $input['status'] ?? null,
            $input['user_id'] ?? null,
            $input['project_id'] ?? null,
            $input['due_date'] ?? null
        );

        if ($success) {
            echo json_encode(["message" => "Task created"]);
        } else {
            echo json_encode(["message" => "Task creation failed."]);
        }

        break;

        case "PUT":

            parse_str($_SERVER['QUERY_STRING'], $query);
            $input = json_decode(file_get_contents("php://input"), true);

            $task_id = $query['task_id'] ?? null;

            if(!$task_id){
                echo json_encode(["message" => "task_id is required"]);
                exit;
            }

                $success = $task->UpdateTask(
                    $input['task_id'] ?? null,
                    $input['task_name'] ?? null,
                    $input['status'] ?? null,
                    $input['user_id'] ?? null
                );

            
            if($success)
                echo json_encode(["message" =>  "Update successful"]);
            else
                echo json_encode(["message" =>  "Update failed."]);

        break;

    case "DELETE":
        parse_str($_SERVER['QUERY_STRING'], $query);
        $task_id = $query['task_id'] ?? null;

        $success = $task->DeleteTask($task_id);

        if ($success){
            echo json_encode(["message" => "Task deleted"]);
        } else {
            echo json_encode(["message" => "Delete failed or ID not found"]);
        }
        break;

}
