<?php

class CommentsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tienda; charset=utf8', 'root', '');
    }


    function getAll() {
        $query = $this->db->prepare('SELECT `p`.name as product, `p`.id as id_product, `c`.comment, `c`.score, `c`.id_user ,`c`.id , `u`.name FROM `comments` c INNER JOIN `products` p INNER JOIN `users` u WHERE `c`.id_user = `u`.id AND c.id_product = p.id');
        $query->execute();
        $comments = $query->fetchAll(PDO::FETCH_OBJ); 
        return $comments;
    }

    function getCommentById($id){
        $query = $this->db->prepare('SELECT `c`.score ,  u.name, p.name, `c`.comment FROM `products` p INNER JOIN `comments` c INNER JOIN `users`u WHERE `c`.id_user = `u`.id AND c.id_product = p.id AND c.id = ?');
        $query->execute(array($id));
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    function getCommentsByProductId($producId){
        $query = $this->db->prepare('SELECT `c`.score ,  u.name, p.name, `c`.comment FROM `products` p INNER JOIN `comments` c INNER JOIN `users`u WHERE `c`.id_user = `u`.id AND c.id_product = p.id AND id_product = ?');
        $query->execute(array($producId));
        $commentsByProduct = $query->fetch(PDO::FETCH_OBJ);
        return $commentsByProduct;

    }

    function insertComment($comment, $score, $user_id, $product_id){
        $query = $this->db->prepare('INSERT INTO `comments`(`comment`, `score`, `id_user`, `id_product`) VALUES (?,?,?,?)');
        $query->execute([$comment, $score, $user_id, $product_id]);
        $comment =$this->db->lastInsertId();
        return $comment;
    }

    function deleteComment($id){
        $query = $this->db->prepare('DELETE  FROM  `comments`  WHERE id= ?');
        $query->execute([$id]);   
    }
}