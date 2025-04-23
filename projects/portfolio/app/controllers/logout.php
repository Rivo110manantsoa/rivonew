<?php 

class Logout extends Controller {
    public function index() {
        $User = $this->load_model("User_model");
        $User->logout();
    }
}