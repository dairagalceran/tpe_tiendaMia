<?php
require_once 'models/commentsModel.php';
require_once 'api/apiView.php';


class ApiCommentsController {
    private $commentsModel;
    private $view;
    private $data;
  

    function __construct() {
        $this->commentsModel = new CommentsModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    
    private function getData() {
        return json_decode($this->data);
    }
 
       
    public function getAll() {
        $comments = $this->commentsModel->getAll();
        $this->view->response($comments,200);
     }
    /* 
     * Obtiene comentario dado un ID
     * 
     * $params arreglo asociativo con los parámetros del recurso
     */

    public function getAllCommentsByProduct($params = null) {
        $producId = $params[':ID'];
        $comments = $this->commentsModel->getCommentsByProductId($producId);
        if ($comments){
            $this->view->response($comments, 200);
        }
        else{
          $this->view->response("Comentarios del producto id=$producId not found", 404);
        }
    }

    public function getCommentById($params = null) {
        $id = $params[':ID'];
        $comment = $this->commentsModel->getCommentById($id);
        if ($comment){
            $this->view->response($comment, 200);
        }
        else{
          $this->view->response("Comentario id=$id not found", 404);
        }
    }

    public function addComment($params = null) {
        $data = $this->getData();

        $score= $data->score;
        $comment = $data->comment;
        $user_id = $data->user_id; //ver
        $product_id= $data->product_id; //ve

        $id = $this->commentsModel->insertComment($score, $comment, $user_id, $product_id);
        
        $comment = $this->commentsModel->getCommentById($id);
        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("El comentario  no fue creado", 500);
    }

    public function remove($params = null){
        $id = $params[':ID'];
        $comment = $this->commentsModel->getCommentById($id);
        
        if ($comment) {
            $this->commentsModel->deleteComment($id);
            $this->view->response(null, 204);
        } else {
            $this->view->response("Comment id=$id not found", 404);
        }
       
    }
}