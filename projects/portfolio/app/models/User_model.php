<?php 
    class User_model extends Database {
        private $error = "";

        public function signup($POST){
            $data = [];
            $data['name'] = trim($POST['name']);
            $data['email'] = trim($POST['email']);
            $data['password'] = trim($POST['password']);
            $data['role'] = "admin";
            $password = trim($POST['password2']);

            if (empty($data['name']) && !preg_match("/^[a-zA-Z_-]+$/",$data['name'])) {
                $this->error .= "Please enter a valid name <br>";
            }

            if (empty($data['email']) && !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email'])) {
                $this->error .= "Please enter a valid email <br>";
            }

            if (empty($data['password'])) {
                $this->error .= "Please enter a valid password <br>";
            }
            if (empty($password)) {
                $this->error .= "Please confirm your password <br>";
            }
            if (strlen($data['password']) < 3) {
                $this->error .= "Password must be at least 4 characters long! <br>";
            }

            if ($data['password'] != $password) {
                $this->error .= "Password not match!";
            }

            if ($this->error == "") {
                $data['password'] = hash('sha1',$data['password']);

                $sql = "INSERT INTO users (name,email,password,role) VALUES (:name,:email,:password,:role)";
                $result = $this->runQuery($sql,$data);
                // var_dump($result);die;
                if ($result) {
                    header("Location: " . ROOT . "login");
                    die;
                }
            }

            $_SESSION['error'] = $this->error;
        }

        
        public function signin($POST){
            $data = [];
            $data['email'] = trim($POST['email']);
            $data['password'] = trim($POST['password']);

            if (empty($data['email']) && !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email'])) {
                $this->error .= "Please enter a valid email <br>";
            }

            if (empty($data['password'])) {
                $this->error .= "Please enter a valid password <br>";
            }

            if (strlen($data['password']) < 3) {
                $this->error .= "Password must be at least 4 characters long! <br>";
            }

            if ($this->error == "") {
                $data['password'] = hash('sha1',$data['password']);

                $sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
                $result = $this->runQuery($sql,$data);
                // var_dump($result);die;
                if (is_array($result)) {
                    $_SESSION['user'] = $result[0]->email;
                    header("Location: " . ROOT . "home_admin");
                    die;
                }
            }

            $_SESSION['error'] = $this->error;
        }


        public function logout() {
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }

            header("Location: " . ROOT . "login");
            die;
        }
        

        public function check_user($redirect=false,$allowed=[]) {
            if (count($allowed) > 0) {
                $dat['user'] = $_SESSION['user'];
                $sql = "select * from users where email=:user limit 1";
                $result = $this->runQuery($sql,$dat);

                if (is_array($result)) {
                    $result = $result[0];
                    if (in_array($result->role,$allowed)) {
                        return $result;
                    }
                }

                header("Location: " . ROOT . "login");
                die;
            } else {
                if (isset($_SESSION['user'])) {
                    $array['user'] = $_SESSION['user'];
                    $sql = "select * from users where email=:user limit 1";
                    $result = $this->runQuery($sql,$array);

                    if (is_array($result)) {
                        return $result[0];
                    }

                } 

                if ($redirect) {
                    header("Location: " . ROOT . "login");
                    die;
                }
            }

            return false;
            
        }


    }