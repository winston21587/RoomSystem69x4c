<?php
    require_once "Database.php";

    class Account extends Database{

        public $id = NULL;

        public $username = " ";
        public $email = " ";
        public $course = " ";
        public $section = " ";

        public $password = " ";


        public function login(){
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email',$this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($this->password,$user['password'])){
                $this->id = $user['id'];
                $this->username = $user['username'];
                $this->email = $user['email'];
                $this->course = $user['course'];
                $this->section = $user['section'];
                return true;
            }

            return false;
        }

        public function register(){
            $query = "INSERT INTO users (username,email,course,section,password)
            VALUES (:username,:email,:course,:section,:password)";
            $stmt = $this->pdo->prepare($query);
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':course', $this->course);
            $stmt->bindParam(':section', $this->section);
            $stmt->bindParam(':password', $this->password);
            return $stmt->execute();

        }
        public function CheckUnqEmail(){
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $this->email = htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(':email',$this->email);

            
            if($stmt->execute()){
                $temp = $stmt->fetch(PDO::FETCH_ASSOC);
                if(empty($temp)){
                    return true;
                }
            }
            return false ;
        }


    }


?>