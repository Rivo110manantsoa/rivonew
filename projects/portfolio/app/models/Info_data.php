<?php

class Info_data extends Database {
   
// portfolio
    public function insert($POST, $FILES) {
        $_SESSION['error'] = "";
        $arr['title'] = ucwords($POST->title);
        $arr['description'] = ucwords($POST->description);
        $arr['link'] = strtolower($POST->link);
        $arr['date'] = date("Y-m-d H:i:s");
    
        // Validation
        if (empty($arr['title'])) {
            $_SESSION['error'] .= "Please enter a valid title. <br>";
        }
        
        if (empty($arr['description'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }

        if (empty($arr['link'])) {
            $_SESSION['error'] .= "Please enter a valid link. <br>";
        }
    
        $arr['image1'] = "";
        $arr['image2'] = "";
        $arr['image3'] = "";
        $arr['image4'] = "";
        $arr['image5'] = "";
    
        $sizeMax = 20 * 1024 * 1024; // Limite en bytes (20 Mo)
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
        $folder = "portfolio_uploads/";
    
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    
        foreach ($FILES as $key => $img) {
            if ($img['error'] == 0 && in_array($img['type'], $allowed)) {
                if ($img['size'] < $sizeMax) {
                    // Générer un nom unique pour chaque image
                    $ext = pathinfo($img['name'], PATHINFO_EXTENSION); // Récupérer l'extension
                    $uniqueName = uniqid("img_", true) . "." . $ext;    // Générer un nouveau nom
                    $dest = $folder . $uniqueName;
    
                    // Déplacer le fichier vers le dossier de destination
                    move_uploaded_file($img['tmp_name'], $dest);
    
                    // Assigner le chemin à l'élément approprié
                    $arr[$key] = $dest;
                } else {
                    $_SESSION['error'] .= $key . " is too large. ";
                }
            }
        }
    
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "INSERT INTO portfolios (title, description,link,date, image1, image2, image3, image4, image5) 
                    VALUES (:title, :description,:link,:date, :image1, :image2, :image3, :image4, :image5)";
            $check = $this->runQuery($sql, $arr);
    
            if ($check) {
                return true;
            }
        }
    
        return false;
    }

    public function update($POST, $FILES) {
        $_SESSION['error'] = "";
        $arr['id'] = (int)$POST->id;
        $arr['title'] = ucwords($POST->title);
        $arr['description'] = ucwords($POST->description);
        $arr['link'] = strtolower($POST->link);

        // Validation des entrées
        if (empty($arr['title'])) {
            $_SESSION['error'] .= "Please enter a valid title. <br>";
        }
        if (empty($arr['description'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }


        $imgs = "";

        $sizeMax = 20 * 1024 * 1024; // Limite en bytes (20 Mo)
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
        $folder = "portfolio_uploads/";

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Récupérer les données existantes du portfolio
        $cportf = $this->runQuery("SELECT * FROM portfolios WHERE id=:id", ['id' => $POST->id]);

        // Gestion des nouvelles images
        foreach ($FILES as $key => $value) {
            if ($value['error'] == 0 && in_array($value['type'], $allowed)) {
                if ($value['size'] < $sizeMax) {
                    // Générer un nom unique pour chaque image
                    $ext = pathinfo($value['name'], PATHINFO_EXTENSION);
                    $uniqueName = uniqid("img_", true) . "." . $ext;
                    $dest = $folder . $uniqueName;

                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($value['tmp_name'], $dest)) {
                        // Supprimer l'ancienne image associée à cette clé (si elle existe)
                        $current_img = $cportf[0]->$key; // Récupérer l'image actuelle
                        $img_root = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']) . $current_img;

                        if (!empty($current_img) && file_exists($img_root)) {
                            remove_image($img_root);
                        }

                        // Assigner le chemin de la nouvelle image
                        $arr[$key] = $dest;
                        $imgs .= ", " . $key . "=:" . $key;
                    } else {
                        $_SESSION['error'] .= "Failed to upload image: " . $key . ".<br>";
                    }
                } else {
                    $_SESSION['error'] .= $key . " is too large. <br>";
                }
            }
        }

        // Mise à jour des données dans la base de données
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "UPDATE portfolios SET title=:title, description=:description,link=:link $imgs WHERE id=:id"; 
            return $this->runQuery($sql, $arr);
        } else {
            return false;
        }
    }

    public function get_portfolios() {
        $limit = 10;
        $offset = Page::get_offset($limit);
        
        $sql = "SELECT * FROM portfolios ORDER BY id DESC LIMIT $limit OFFSET $offset";
        return $this->runQuery($sql);
    }
   
    public function get_portfolios_views() {        
        $sql = "SELECT * FROM portfolios ORDER BY id DESC";
        return $this->runQuery($sql);
    }
   
    public function delete_portfolio($id) {
        $id = (int)$id;
    
        $curSql = "SELECT * FROM portfolios WHERE id=:id";
        $cportf = $this->runQuery($curSql, ['id' => $id]);
    
        if ($cportf) {
            $images = ['image1','image2','image3','image3','image4','image5'];
            $old_path = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']);

            foreach ($images as $key) {
                $current_img = $cportf[0]->$key;
                $img_root = $old_path . $current_img;
                // Supprimez l'image si elle existe et n'est pas un répertoire
                remove_image($img_root);
            }

            $sql = "DELETE FROM portfolios WHERE id=:id";
            return $this->runQuery($sql, ['id' => $id]);
        }

        return false;
    }

    public function get_details($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM portfolios WHERE id=:id LIMIT 1";
        return $this->runQuery($sql, ['id' => $id]);
    }

    public function search_portfolio($SEARCH) {
        $find = htmlspecialchars(htmlentities(trim($SEARCH['search'])));
        $sql = "SELECT * FROM portfolios WHERE title LIKE '%".$find."%'";
        return $this->runQuery($sql);
    }

    // comment request
    public function insert_comment($POST) {
        $_SESSION['error'] = "";
        $_SESSION['success'] = "";
        $data['portfolio_id'] = (int)$POST['portfolio_id'];
        $data['name'] = ucfirst(trim($POST['name']));
        $data['message'] = ucfirst(trim($POST['message']));

        // show($data);

        // validation
        if (empty($data['name'])) {
            $_SESSION['error'] .= "Please enter your name first";
        }

        if (empty($data['message'])) {
            $_SESSION['error'] .= "Please enter your comment";
        }

        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "INSERT INTO portfolio_comments (name,message,portfolio_id) VALUES (:name,:message,:portfolio_id)";
            $result = $this->runQuery($sql,$data);

            if ($result) {
                $_SESSION['success'] .= "Message sent successfully";
            }
        } else {
            $_SESSION['error'] .= "An error occured!";
        }
    }

    public function insert_blog_comment($POST) {
        $_SESSION['error'] = "";
        $_SESSION['success'] = "";
        $data['blog_id'] = (int)$POST['blog_id'];
        $data['name'] = ucfirst(trim($POST['name']));
        $data['message'] = ucfirst(trim($POST['message']));

        // show($data);

        // validation
        if (empty($data['name'])) {
            $_SESSION['error'] .= "Please enter your name first";
        }

        if (empty($data['message'])) {
            $_SESSION['error'] .= "Please enter your comment";
        }

        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "INSERT INTO blog_comments (name,message,blog_id) VALUES (:name,:message,:blog_id)";
            $result = $this->runQuery($sql,$data);

            if ($result) {
                $_SESSION['success'] .= "Message sent successfully";
            }
        } else {
            $_SESSION['error'] .= "An error occured!";
        }
    }

    public function get_comments($id) {
        $id = (int)$id;
        $sql = "SELECT portfolios.*, portfolio_comments.name,portfolio_comments.message FROM portfolios 
                JOIN portfolio_comments ON portfolio_comments.portfolio_id=portfolios.id WHERE portfolios.id=:id ORDER BY portfolio_comments.id DESC";
        return $this->runQuery($sql,['id' => $id]);
    }

    public function get_reviews() {
        $sql = "SELECT portfolios.*, portfolio_comments.name,portfolio_comments.message FROM portfolios 
                JOIN portfolio_comments ON portfolio_comments.portfolio_id=portfolios.id ORDER BY portfolio_comments.id DESC";
        return $this->runQuery($sql);
    }

    // about
    public function add_about_me($POST) {
        $_SESSION['error'] = "";
        $_SESSION['success'] = "";

        $arr['texts'] = htmlspecialchars($POST->texts);

        if (empty($arr['texts'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }
        
        if ($_SESSION['error'] == "" || !isset($_SESSION['error'])) {
            $sql = "insert into abouts (texts) values (:texts)";
            $ok = $this->runQuery($sql,$arr);

            if ($ok) {
                return true;
            }

        }

        return false;
    }
    public function update_about_me($POST) {
        $_SESSION['error'] = "";
        $_SESSION['success'] = "";

        $arr['id'] = (int)$POST->id;
        $arr['texts'] = htmlspecialchars($POST->texts);


        if (empty($arr['texts'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }
        
        if ($_SESSION['error'] == "" || !isset($_SESSION['error'])) {
            $sql = "update abouts set texts=:texts where id=:id";
            $ok = $this->runQuery($sql,$arr);

            if ($ok) {
                return true;
            }

        }

        return false;
    }

    public function show_about_me() {

        $sql = "SELECT * FROM abouts ORDER BY id DESC";
        return $this->runQuery($sql);
    }

   
    public function get_about_me() {
        $sql = "SELECT * FROM abouts ORDER BY id DESC LIMIT 1";
        return $this->runQuery($sql);
    }

    public function delete_about_me($id) {
        $id = (int)$id;    
        $sql = "DELETE FROM abouts WHERE id=:id";
        return $this->runQuery($sql, ['id' => $id]);
    }
    
    // blogs

    public function insert_blogs($POST, $FILES) {
        $_SESSION['error'] = "";
        $arr['title'] = ucwords($POST->title);
        $arr['description'] = ucwords($POST->description);
        $arr['date'] = date("Y-m-d H:i:s");
    
        // Validation
        if (empty($arr['title'])) {
            $_SESSION['error'] .= "Please enter a valid title. <br>";
        }
        if (empty($arr['description'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }
        
    
        $arr['image'] = "";
    
        $sizeMax = 20 * 1024 * 1024; // Limite en bytes (20 Mo)
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
        $folder = "blog_uploads/";
    
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    
        foreach ($FILES as $key => $img) {
            if ($img['error'] == 0 && in_array($img['type'], $allowed)) {
                if ($img['size'] < $sizeMax) {
                    // Générer un nom unique pour chaque image
                    $ext = pathinfo($img['name'], PATHINFO_EXTENSION); // Récupérer l'extension
                    $uniqueName = uniqid("img_", true) . "." . $ext;    // Générer un nouveau nom
                    $dest = $folder . $uniqueName;
    
                    // Déplacer le fichier vers le dossier de destination
                    move_uploaded_file($img['tmp_name'], $dest);
    
                    // Assigner le chemin à l'élément approprié
                    $arr[$key] = $dest;
                } else {
                    $_SESSION['error'] .= $key . " is too large. ";
                }
            }
        }
    
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "INSERT INTO blogs (title, description, image,date) 
                    VALUES (:title, :description, :image,:date)";
            // show($arr);die;
            $check = $this->runQuery($sql, $arr);
    
            if ($check) {
                return true;
            }
        }
    
        return false;
    }

    public function update_blogs($POST, $FILES) {
        $_SESSION['error'] = "";
        $arr['id'] = (int)$POST->id;
        $arr['title'] = ucwords($POST->title);
        $arr['description'] = ucwords($POST->description);

        // Validation des entrées
        if (empty($arr['title'])) {
            $_SESSION['error'] .= "Please enter a valid title. <br>";
        }
        if (empty($arr['description'])) {
            $_SESSION['error'] .= "Please enter a valid description. <br>";
        }

        $imgs = "";

        $sizeMax = 20 * 1024 * 1024; // Limite en bytes (20 Mo)
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
        $folder = "blog_uploads/";

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Récupérer les données existantes du portfolio
        $cportf = $this->runQuery("SELECT * FROM blogs WHERE id=:id", ['id' => $POST->id]);

        // Gestion des nouvelles images
        foreach ($FILES as $key => $value) {
            if ($value['error'] == 0 && in_array($value['type'], $allowed)) {
                if ($value['size'] < $sizeMax) {
                    // Générer un nom unique pour chaque image
                    $ext = pathinfo($value['name'], PATHINFO_EXTENSION);
                    $uniqueName = uniqid("img_", true) . "." . $ext;
                    $dest = $folder . $uniqueName;

                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($value['tmp_name'], $dest)) {
                        // Supprimer l'ancienne image associée à cette clé (si elle existe)
                        $current_img = $cportf[0]->$key; // Récupérer l'image actuelle
                        $img_root = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']) . $current_img;

                        if (!empty($current_img) && file_exists($img_root)) {
                            remove_image($img_root);
                        }

                        // Assigner le chemin de la nouvelle image
                        $arr[$key] = $dest;
                        $imgs .= ", " . $key . "=:" . $key;
                    } else {
                        $_SESSION['error'] .= "Failed to upload image: " . $key . ".<br>";
                    }
                } else {
                    $_SESSION['error'] .= $key . " is too large. <br>";
                }
            }
        }

        // Mise à jour des données dans la base de données
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "UPDATE blogs SET title=:title, description=:description $imgs WHERE id=:id"; 
            return $this->runQuery($sql, $arr);
        } else {
            return false;
        }
    }

    public function get_blogs() {
        $limit = 5;
        $offset = Page::get_offset($limit);
        
        $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT $limit OFFSET $offset";
        // show($sql);
        return $this->runQuery($sql);
    }

    
    public function get_blogs_views() {       
        $sql = "SELECT * FROM blogs ORDER BY id DESC";
        // show($sql);
        return $this->runQuery($sql);
    }

    public function delete_blog($id) {
        $id = (int)$id;
    
        $curSql = "SELECT * FROM blogs WHERE id=:id";
        $cportf = $this->runQuery($curSql, ['id' => $id]);
    
        if ($cportf) {
            $images = ['image'];
            $old_path = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']);

            foreach ($images as $key) {
                $current_img = $cportf[0]->$key;
                $img_root = $old_path . $current_img;
                // Supprimez l'image si elle existe et n'est pas un répertoire
                remove_image($img_root);
            }

            $sql = "DELETE FROM blogs WHERE id=:id";
            return $this->runQuery($sql, ['id' => $id]);
        }

        return false;
    }

    public function get_blog_details($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM blogs WHERE id=:id LIMIT 1";
        return $this->runQuery($sql, ['id' => $id]);
    }

    public function search_blog($SEARCH) {
        $find = htmlspecialchars(htmlentities(trim($SEARCH['search'])));
        $sql = "SELECT * FROM blogs WHERE title LIKE '%".$find."%'";
        return $this->runQuery($sql);
    }

    public function get_blog_comments($id) {
        $id = (int)$id;
        $sql = "SELECT blogs.*, blog_comments.name,blog_comments.message FROM blogs 
                JOIN blog_comments ON blog_comments.blog_id=blogs.id WHERE blogs.id=:id ORDER BY blog_comments.id DESC";
        return $this->runQuery($sql,['id' => $id]);
    }

    // contact 

    public function insert_contact($POST) {
        $_SESSION['error'] = "";
        $arr['name'] = ucwords($POST['name']);
        $arr['message'] = ucwords($POST['message']);
        $arr['subject'] = ucwords($POST['subject']);
        $arr['phone'] = ucwords($POST['phone']);
        $arr['email'] = ucwords($POST['email']);
        $arr['date'] = date("Y-m-d H:i:s");
    
        // Validation
        if (empty($arr['name'])) {
            $_SESSION['error'] .= "Please enter a valid name. <br>";
        }
        if (empty($arr['message'])) {
            $_SESSION['error'] .= "Please enter a valid message. <br>";
        }
        
    
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $sql = "INSERT INTO contacts (name, message, subject,phone,email,date) 
                    VALUES (:name, :message, :subject, :phone, :email, :date)";
            // show($arr);die;
            $check = $this->runQuery($sql, $arr);
    
            if ($check) {
                return true;
            }
        }
    
        return false;
    }

    public function delete_contact($id) {
        $id = (int)$id;    
        $sql = "DELETE FROM contacts WHERE id=:id";
        return $this->runQuery($sql, ['id' => $id]);
    }

    public function show_contact_me() {

        $sql = "SELECT * FROM contacts ORDER BY id DESC";
        return $this->runQuery($sql);
    }
}