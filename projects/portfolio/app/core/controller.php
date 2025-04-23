<?php 

class Controller {

    public function load_view($filename, $data = []) {
        if (is_array($data)) {
            extract($data);
        }
        
        if (file_exists("../app/views/" . strtolower($filename) . ".php")) {
            include "../app/views/" . strtolower($filename) . ".php";
        } else {
            include "../app/views/404.php";
        }
        
    }

    public function load_model($model) {
        if (file_exists("../app/models/" . ucfirst($model) . ".php")) {
            require_once "../app/models/" . ucfirst($model) . ".php";
            return $model = new $model();
        }

        return false;
    }
}