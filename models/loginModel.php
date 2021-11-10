<?php


class LoginModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tienda;charset=utf8', 'root', '');
    }
    function getAll(){
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
 
     function register($email, $hashedPassword){
        $query = $this->db->prepare('INSERT INTO users (email, password) VALUES (? , ?)');
        $query->execute([$email,$hashedPassword]);
 
    }

    function getUserByEmail($userEmail){
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$userEmail]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
    function delete($id){
        $query = $this->db->prepare('DELETE FROM users WHERE id=?');
        $query->execute([$id]);
    }

    function updateUser($id, $email, $hashedPassword, $isAdmin){
        $query = $this->db->prepare('UPDATE users SET email = ?, password = ?, is_admin = ?, WHERE id = ?');
        $query->execute([$email, $hashedPassword, $isAdmin,$id]);
    }
}