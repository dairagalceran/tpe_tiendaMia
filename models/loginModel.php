<?php


class LoginModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tienda;charset=utf8', 'root', '');
    }
    function getAll(){
        $query = $this->db->prepare('SELECT id, name, email, is_admin FROM users');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
 
     function register($name, $email, $hashedPassword){
        $query = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (? , ?, ?)');
        $query->execute([$name, $email,$hashedPassword]);
 
    }

    function getUserByEmail($userEmail){
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$userEmail]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
   
    function getUsersAdmin(){
        $query = $this->db->prepare('SELECT * FROM users WHERE is_Admin = ?');
        $query->execute([1]);
        $isAdmin = $query->fetch(PDO::FETCH_OBJ);
        return $isAdmin;
    }

    function delete($id){
        $query = $this->db->prepare('DELETE FROM users WHERE id=?');
        $query->execute([$id]);
    }

    function editRol($id, $isAdmin){
        $query = $this->db->prepare('UPDATE users SET  is_admin = 1, WHERE id = ?');
        $query->execute([ $isAdmin, $id]);
        return $id;
    }
  
}