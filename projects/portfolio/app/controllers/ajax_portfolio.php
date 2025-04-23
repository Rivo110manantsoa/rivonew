<?php 
class Ajax_portfolio extends Controller {
    public function index() {
        if (count($_POST) > 0) {
            $data = (object)$_POST;
        } else {
            $data = file_get_contents("php://input");
            $data = json_decode($data);
        }

        $portfolio = $this->load_model("Info_data");
        // show($data);
        if (is_object($data) && isset($data->data_type)) {
            if ($data->data_type == "add_portfolio") {
                $portfolio->insert($data,$_FILES);
                if ($_SESSION['error'] != "") {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_portfolio";
                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Portfolio add successfully";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_portfolio";
                    echo json_encode($arr);
                }
                
            } else if($data->data_type == "edit_portfolio") {
                $portfolio->update($data,$_FILES);
                $arr['message'] = "Portfolio updated successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit_portfolio";
                echo json_encode($arr);
            } else if($data->data_type == "delete_portfolio") {
                $portfolio->delete_portfolio($data->id);
                $arr['message'] = "Portfolio deleted successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete_portfolio";
                echo json_encode($arr);
            }else if ($data->data_type == "add_about_me") {
                // show($data->data_type);
                $portfolio->add_about_me($data);
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
            } else if($data->data_type == "edit_about_me") {
                $portfolio->update_about_me($data);
                $arr['message'] = "About me updated successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit_about_me";
                echo json_encode($arr);
            } else if($data->data_type == "delete_about_me") {
                $portfolio->delete_about_me($data->id);
                $arr['message'] = "About_me deleted successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete_about_me";
                echo json_encode($arr);
            } else if($data->data_type == "delete_contact") {
                $portfolio->delete_contact($data->id);
                $arr['message'] = "Contact deleted successfully";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete_contact";
                echo json_encode($arr);
            }

        }
        
    }
}