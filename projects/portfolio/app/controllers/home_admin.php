<?php

class Home_admin extends Controller {

    // page d'accueil
    public function index() {
        $User = $this->load_model("User_model");
        $User->check_user(true,['admin']);

        $data['page'] = "Home";
        $this->load_view("admin/index",$data);
    }

    public function portfolio() {
        $User = $this->load_model("User_model");
        $User->check_user(true,['admin']);

        $data['page'] = "Portfolio";
        $portf = $this->load_model("info_data");
        $data['rows'] = $portf->get_portfolios();

        // show($data['rows']);
        $this->load_view("admin/portfolio",$data);
    } 

    public function blog() {
        $User = $this->load_model("User_model");
        $User->check_user(true,['admin']);

        $data['page'] = "Blog";
        $portf = $this->load_model("info_data");
        $data['rows'] = $portf->get_blogs();

        // show($data['rows']);
        $this->load_view("admin/blog",$data);
    }

    public function about() {
        $User = $this->load_model("User_model");
        $User->check_user(true,['admin']);
        
        $data['page'] = "About";
        $about = $this->load_model("info_data");
        $data['about_me'] = $about->show_about_me();

        $this->load_view("admin/about",$data);
    }

    public function contact() {
        $User = $this->load_model("User_model");
        $User->check_user(true,['admin']);
        
        $data['page'] = "Contact";
        $contact = $this->load_model("info_data");
        $data['contact_me'] = $contact->show_contact_me();

        $this->load_view("admin/contact",$data);
    }

}