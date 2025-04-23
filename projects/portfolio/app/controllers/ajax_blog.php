<?php 
class Ajax_blog extends Controller {
    public function index() {
        if (count($_POST) > 0) {
            $data = (object)$_POST;
        } else {
            $data = file_get_contents("php://input");
            $data = json_decode($data);
        }

        $blog = $this->load_model("Info_data");
        // show($data);
        if (is_object($data) && isset($data->data_type)) {
            if ($data->data_type == "add_blog") {
                $blog->insert_blogs($data,$_FILES);
                if ($_SESSION['error'] != "") {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_blog";
                    echo json_encode($arr);
                } else {
                    $arr['message'] = "blog add successfully";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_blog";
                    echo json_encode($arr);
                }
                
            } else if($data->data_type == "edit_blog") {
                // show($data);
                $blog->update_blogs($data,$_FILES);
                $arr['message'] = "blog updated successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit_blog";
                echo json_encode($arr);
            } else if($data->data_type == "delete_blog") {
                $blog->delete_blog($data->id);
                $arr['message'] = "blog deleted successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete_blog";
                echo json_encode($arr);
            } if ($data->data_type == "add_about_me") {
                // show($data->data_type);
                $blog->add_about_me($data);
                if ($_SESSION['error'] != "") {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_about_me";
                    echo json_encode($arr);
                } else {
                    $arr['message'] = "about_me add successfully";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_about_me";
                    echo json_encode($arr);
                }
                
            } 

        }
        
    }
}