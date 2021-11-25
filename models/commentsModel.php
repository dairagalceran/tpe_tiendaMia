<?php

class CommentsModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_tienda; charset=utf8', 'root', '');
    }

    function getCommentById($id)
    {
        $query = $this->db->prepare('SELECT `c`.* FROM  `comments` c  WHERE  c.id = ?');
        $query->execute(array($id));
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    function getCommentsByProductId($producId)
    {
        $query = $this->db->prepare('SELECT `c`.score , `c`.created_at, `u`.name as user_name, p.name, `c`.comment, c.id FROM `products` p INNER JOIN `comments` c INNER JOIN `users`u WHERE `c`.id_user = `u`.id AND c.id_product = p.id AND id_product = ? ORDER BY c.created_at DESC');
        $query->execute(array($producId));
        $commentsByProduct = $query->fetchAll(PDO::FETCH_OBJ);
        return $commentsByProduct;
    }

    function insertComment($comment, $score, $user_id, $product_id)
    {
        $query = $this->db->prepare('INSERT INTO `comments`(`comment`, `score`, `id_user`, `id_product`) VALUES (?,?,?,?)');
        $query->execute([$comment, $score, $user_id, $product_id]);
        $commentId = $this->db->lastInsertId();
        return $commentId;
    }

    function deleteComment($id)
    {
        $query = $this->db->prepare('DELETE  FROM  `comments`  WHERE id= ?');
        $query->execute([$id]);
    }
}
