<?php
require_once "../database/connect.php";
require_once "../Model/Taskmodel.php";
class users extends Model{
    protected $conn;
    public function __construct($pdo){
        $this->conn = $pdo;
    }


public function RetrieveAssignedTask($user_id = null){
    if($user_id !== null){
        // Get tasks for a specific user
        $stmt = $this->conn->prepare("
            SELECT t.task_id, u.first_name, u.last_name, p.project_name,
                   t.task_name, t.status, t.due_date
            FROM tasks t
            JOIN users u
                ON t.user_id = u.user_id
            JOIN projects p
                ON t.project_id = p.project_id
            WHERE u.user_id = ?
            ORDER BY p.project_name
        ");
        $stmt->execute([$user_id]);
    } else {
        // Get tasks for all users
        $stmt = $this->conn->prepare("
            SELECT t.task_id, u.first_name, u.last_name, p.project_name,
                   t.task_name, t.status, t.due_date
            FROM tasks t
            JOIN users u ON t.user_id = u.user_id
            JOIN projects p ON t.project_id = p.project_id
            ORDER BY p.project_name
        ");
        $stmt->execute();
    }


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function RetrieveUsers($user_id = null){
        if($user_id !== null){
            $stmt = $this->conn->prepare("
                SELECT * FROM users
                WHERE user_id = ?
                ");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
             $stmt = $this->conn->prepare("
                SELECT * FROM users
                ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}


public function CreateUser($first_name = null, $last_name = null, $email = null, $role = null){
        if (!isset($first_name, $last_name, $email, $role)) {
            return false;
        }
        $stmt = $this->conn->prepare(
            "INSERT INTO users(first_name, last_name, email, role)
            VALUES(?,?,?,?)"
        );
        if (!$stmt) return false;
    return $stmt->execute([$first_name, $last_name, $email, $role]);
}


public function UpdateUser($user_id = null, $first_name = null, $last_name = null, $email = null, $role = null){
        if (!isset($user_id, $first_name, $last_name, $email, $role)) {
            return false;
        }




    $stmt = $this->conn->prepare(
        "UPDATE users
         SET first_name = ?, last_name = ?, email = ?, role = ?
         WHERE user_id = ?"
    );
    if (!$stmt) return false;
    return $stmt->execute([$first_name, $last_name, $email, $role]);
}


public function deleteuser($user_id = null){
        if (!$user_id) return false;


        $stmt = $this->conn->prepare(
            "DELETE FROM tasks WHERE task_id = ?"
        );
        if (!$stmt) return false;


        $success = $stmt->execute([$user_id]);
        return ($success && $stmt->rowCount() > 0);
}
}  


?>

