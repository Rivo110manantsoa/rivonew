<?php 
    class register extends Controller{
        public function index() {
            $User = $this->load_model("User_model");
            $User->check_user(true,['admin']);
            
            $User = $this->load_model("User_model");
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $User->signup($_POST);
            }
            
            $this->load_view("admin/register");
        }
    }