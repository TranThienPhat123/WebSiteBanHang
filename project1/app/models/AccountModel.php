<?php 
class AccountModel {
    private $conn;
    private $table_name = "accounts";

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAccountByUsername($username){
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function updateProfile($username, $email, $phone, $avatar = null) {
        $query = "UPDATE account SET email = :email, phone = :phone";
        if ($avatar) {
            $query .= ", avatar = :avatar";
        }
        $query .= " WHERE username = :username";
    
        $stmt = $this->conn->prepare($query);
    
        $email = htmlspecialchars(strip_tags($email ?? ''));
        $phone = htmlspecialchars(strip_tags($phone ?? ''));
    
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':username', $username);
        if ($avatar) {
            $stmt->bindParam(':avatar', $avatar);
        }
    
        return $stmt->execute();
    }

    public function save($username, $fullName, $email, $phone, $avatar, $password){
        $query = "INSERT INTO " . $this->table_name . " 
            (username, fullname, email, phone, avatar, password) 
            VALUES (:username, :fullname, :email, :phone, :avatar, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
