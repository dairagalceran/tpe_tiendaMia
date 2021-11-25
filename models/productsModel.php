<?php

class ProductsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tienda; charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }


    function getAllProducts() {
        $query = $this->db->prepare('SELECT `categories`.name as category, `categories`.id as category_id, `products`.name, `products`.price, `products`.size ,`products`.id 
        FROM `products`INNER JOIN `categories` WHERE `categories`.id = `products`.category_id
        ');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ); 
        return $products;
    }

    function getProduct($id){
        $query = $this->db->prepare('SELECT `categories`.name as category, `categories`.id as category_id, `products`.* FROM `products`INNER JOIN `categories` WHERE `categories`.id = `products`.category_id AND `products`.id = ?');
        $query->execute(array($id));
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }
  
    function getByCategory($id){
        $query = $this->db->prepare("SELECT `categories`.name as `category`, `categories`.id as category_id, `products`.name, `products`.price ,`products`.size,`products`.id FROM `products`INNER JOIN `categories` WHERE `categories`.id = `products`.category_id AND `products`.category_id =?");
        $query->execute(array($id));
        $product = $query->fetchAll(PDO::FETCH_OBJ);     
        return $product;
    }

    
    private function uploadImage($image){
        $extension = array_pop(explode('/',$image['type']));
        if ($extension == 'jpg') {
            $target = 'img/products/' . uniqid() . '.jpg';
        }
        elseif ($extension == 'jpeg') { 
            $target = 'img/products/' . uniqid() . '.jpg';
        }
        else {
            $target = 'img/products/' . uniqid() . '.png';
        }
        $moved = move_uploaded_file($image['tmp_name'], ROOT_FOLDER.$target);
        return $moved ? $target: NULL;
    }
    
    function insertProduct($productName, $size, $price, $category_id, $image = null){
        $pathImg = null;
        if ($image) {
            $pathImg = $this->uploadImage($image);
        }
        $query = $this->db->prepare('INSERT INTO products(`name`, `size`, `price`, `category_id`, `image`) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$productName, $size, floatval($price), $category_id, $pathImg]);
        return $this->db->lastInsertId(); 
    }
  

    function deleteProduct($id){
        $this->deleteImageFile($id);
        $query = $this->db->prepare('DELETE  FROM  `products`  WHERE id= ?');
        $query->execute([$id]);
        
    }

    function deleteImageFile($productId){
        $product = $this->getProduct($productId);
        if($product && $product->image){
            unlink($product->image);
        }
    }

    function deleteImage($id) {
        $this->deleteImageFile($id);
        $query = $this->db->prepare('UPDATE products SET image=? WHERE id=?');
        $query->execute([null, $id]);
    }

    
    function updateProduct($productId , $productName,$productPrice, $productSize, $category_id, $image= null){
        try{
            if($image){
                $pathImg = $this->uploadImage($image);
                $query = $this->db->prepare('UPDATE `products` SET `name`= ?,`price`= ?,`size`= ?,`category_id`= ? ,`image`=? WHERE `id`= ?');
                $query->execute([ $productName, floatval($productPrice), $productSize, $category_id, $pathImg, $productId ]);
                
            }
            else{
                $query = $this->db->prepare('UPDATE `products` SET `name`= ?,`price`= ?,`size`= ?,`category_id`= ?  WHERE `id`= ?');
                $query->execute([ $productName, floatval($productPrice), $productSize, $category_id, $productId ]);
            }
        }
        catch (PDOException $error) {
            echo "Línea de error:  " .$error->getLine();
        }
    }

}
    
        

