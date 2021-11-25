<?php
require_once 'models/commentsModel.php';
require_once 'api/apiView.php';
include_once('helpers/loginHelper.php');



class ApiCommentsController
{
    private $commentsModel;
    private $view;
    private $data;
    private $loginHelper;



    function __construct()
    {
        $this->commentsModel = new CommentsModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
        $this->loginHelper = new LoginHelper();
    }


    private function getData()
    {
        return json_decode($this->data);
    }



    public function getAllCommentsByProduct($params = null)
    {
        $producId = $params[':ID'];
        $comments = $this->commentsModel->getCommentsByProductId($producId);
        if ($comments) {
            $this->view->response($comments, 200);
        } else {
            $this->view->response("Comentarios del producto id=$producId not found", 404);
        }
    }


    public function getCommentById($params = null)
    {
        $user_id = $this->loginHelper->getCurrentUserId();
        $id = $params[':ID'];
        $comment = $this->commentsModel->getCommentById($id);
        if ($comment) {
            $this->view->response($comment, 200);
        } else {
            $this->view->response("Comentario id=$id not found", 404);
        }
    }


    public function addComment($params = null)
    {
        $user_id = $this->loginHelper->getCurrentUserId();
        if (!$user_id) {
            $this->view->response("Debe iniciar sesión", 401);
        } else {
            $data = $this->getData();

            $score = $data->score;
            $comment = $data->comment;
            $product_id = $data->product_id;

            if ($score != '' && $comment != '' && $product_id != '') {
                $id = $this->commentsModel->insertComment($comment, $score, $user_id, $product_id);


                $comment = $this->commentsModel->getCommentById($id);

                if ($comment) {
                    $this->view->response($comment, 200);
                } else {
                    $this->view->response("El comentario  no fue creado", 400);
                }
            } else {
                $this->view->response("error", 204);
            }
        }
    }


    public function removeComment($params = null)
    {
        $id = $params[':ID'];
        $comment = $this->commentsModel->getCommentById($id);

        if ($comment) {
            $this->commentsModel->deleteComment($id);
            $this->view->response("Comment id=$id remove succesfully", 204);
        } else {
            $this->view->response("Comment id=$id not found", 404);
        }
    }
}
