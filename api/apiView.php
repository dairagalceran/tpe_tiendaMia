<?php

class ApiView {

    public function response($data, $code = 200) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $code . " " . $this->requestStatus($code));
        if($data){
        echo json_encode($data);
      }
    }

    /**
     * Devuelve el texto asociado a un codigo de respuesta HTTP
     */
    private function requestStatus($code){
        $status = array(
          200 => "OK",
          204 => "No content",
          404 => "Not found",
          500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
      }
}