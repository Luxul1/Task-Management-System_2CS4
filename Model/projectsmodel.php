<?php
require_once "../database/connect.php";


class ProjectsModel{
    private $pdo;


    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    // Get all projects or one project by ID
    public function getProjects($project_id = null) {
        if ($project_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE project_id = ?");
            $stmt->execute([$project_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    // Create a project
    public function createProject($name, $status, $description) {
        $stmt = $this->pdo->prepare("  
            INSERT INTO projects (project_name, status, description, created_at)
            VALUES (?, ?, ?, NOW())");
        $stmt->execute([$name, $status, $description]);
        return $this->pdo->lastInsertId();
    }


    // Update a project
    public function updateProject($project_id, $name, $status, $description) {
        $stmt = $this->pdo->prepare(
            "UPDATE projects
             SET project_name = ?,
             status = ?,
             description = ?
             WHERE project_id = ?");
        return $stmt->execute([$name, $status, $description, $project_id]);
    }


    // Delete a project
    public function deleteProject($project_id) {
        $stmt = $this->pdo->prepare("DELETE FROM projects WHERE project_id = ?");
        return $stmt->execute([$project_id]);
    }
}
