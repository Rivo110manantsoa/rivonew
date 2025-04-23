<?php

class Home extends Controller {

    public function index() {
        $data['page'] = "Home";

        $portf = $this->load_model("info_data");
        $data['rows'] = $portf->get_portfolios();

        $this->load_view("index",$data);
    }

    public function details($id) {
       if (isset($_SESSION['error'])) {
            $_SESSION['error'] = $_GET[$_SESSION['error']] ?? null;
       }
       
       if (isset($_SESSION['success'])) {
            $_SESSION['success'] = $_GET[$_SESSION['success']] ?? null;
       }

        $data['page'] = "Home";

        $portf = $this->load_model("info_data");
        $row = $portf->get_details($id);

        if ($row) {
            $data['row'] = $row[0];
        }


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $portf->insert_comment($_POST);
        
            // redirect("home/details/" . $id);
        } else {
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }

        $data['comments'] = $portf->get_comments($id);
        
        $this->load_view("details",$data);
        
    }

    public function blog_details($id) {
       if (isset($_SESSION['error'])) {
            $_SESSION['error'] = $_GET[$_SESSION['error']] ?? null;
       }
       
       if (isset($_SESSION['success'])) {
            $_SESSION['success'] = $_GET[$_SESSION['success']] ?? null;
       }

        $data['page'] = "Home";

        $portf = $this->load_model("info_data");
        $row = $portf->get_blog_details($id);

        if ($row) {
            $data['row'] = $row[0];
        }


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $portf->insert_blog_comment($_POST);
        
            // redirect("home/details/" . $id);
        } else {
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }

        $data['comments'] = $portf->get_blog_comments($id);
        
        $this->load_view("blog_details",$data);
        
    }

    public function about() {
        $data['page'] = "About";
        $about = $this->load_model("info_data");
        $data['rows'] = $about->get_about_me();

        $data['reviews'] = $about->get_reviews();

        // show( $data['reviews']);
        $this->load_view("about",$data);
    }

    public function contact() {
        $data['page'] = "Contact";
        $contact = $this->load_model("info_data");
        
        if (isset($_SESSION['error'])) {
            $_SESSION['error'] = $_GET[$_SESSION['error']] ?? null;
        }
        
        if (isset($_SESSION['success'])) {
                $_SESSION['success'] = $_GET[$_SESSION['success']] ?? null;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $contact->insert_contact($_POST);
        } else {
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }
        
        // show($data['rows']);
        $this->load_view("contact",$data);
    }

    public function portfolio() {
        $data['page'] = "Portfolio";

        $portf = $this->load_model("info_data");
        $data['portfolios'] = $portf->get_portfolios_views();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data['portfolios'] = $portf->search_portfolio($_POST);
        }

        $this->load_view("portfolio",$data);
    }

    public function blog() {
        $data['page'] = "Blog";

        $portf = $this->load_model("info_data");
        $data['blogs'] = $portf->get_blogs_views();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data['blogs'] = $portf->search_blog($_POST);
        }

        $this->load_view("blog",$data);
    }
}