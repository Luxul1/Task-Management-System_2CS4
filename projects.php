<?php
header("Content-Type: application/json");
require_once "../database/connect.php";
require_once "../Model/ProjectsModel.php";

$database = new database();
$pdo = $database->getConnection();
$projects = new ProjectsModel($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case "GET":
        if (isset($_GET['project_id'])) {
            echo json_encode($projects->getProjects($_GET['project_id']));
        } else {
            echo json_encode($projects->getProjects());
        }
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['project_name'], $data['status'], $data['description'])) {

            $id = $projects->createProject($data['project_name'], 
            $data['status'], 
            $data['description']);

            echo json_encode(["message" => "Project created", "project_id" => $id]);
        } else {
            echo json_encode(["error" => "Missing fields"]);
        }
        break;

    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['project_id'], $data['project_name'], $data['status'], $data['description'])) {
            $projects->updateProject($data['project_id'], 
            $data['project_name'], 
            $data['status'], 
            $data['description']);
            echo json_encode(["message" => "Project updated"]);
        } else {
            echo json_encode(["error" => "Missing fields"]);
        }
        break;

    case "DELETE":
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['project_id'])) {
            $projects->deleteProject($data['project_id']);
            echo json_encode(["message" => "Project deleted"]);
        } else {
            echo json_encode(["error" => "Missing project_id"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
}