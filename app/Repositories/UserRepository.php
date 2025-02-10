/*<?php
/*require_once __DIR__ . '/../../config/database.php';

class UserRepository{
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findByToken($token){
        $sql = "SELECT * FROM api_detran_usuarios WHERE token = :token LIMIT 1";
        $stmt =$this->db->prepare($sql);
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}*/
?>