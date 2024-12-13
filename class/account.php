<?php
    require_once "Database.php";

    class Account extends Database{

        public $id = NULL;

        public $username = NULL;
        public $email = null;
        public $course = null;
        public $section = null;
        public $department = null;
        public $role = null;

        public $password = NULL;


        // public function login(){
        //     $query = "SELECT * FROM users WHERE email = :email";
        //     $stmt = $this->pdo->prepare($query);
        //     $stmt->bindParam(':email',$this->email);
        //     $stmt->execute();
        //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if($user && password_verify($this->password,$user['password'])){
        //         $this->id = $user['id'];
        //         $this->username = $user['username'];
        //         $this->email = $user['email'];
        //         $this->course = $user['courseid'];
        //         $this->section = $user['section'];
        //         $this->role = $user['role'];
        //         return true;
        //     }

        //     return false;
        // }

        public function login() {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!$user) {
                return ['success' => false, 'error' => 'Email not found.'];
            }
        
            if (!password_verify($this->password, $user['password'])) {
                return ['success' => false, 'error' => 'Incorrect password.'];
            }
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->email = $user['email'];
            $this->course = $user['courseid'];
            $this->section = $user['section'];
            $this->role = $user['role'];
            return ['success' => true];
        }
        

        public function register() {
            $query = "INSERT INTO users (username, email, courseid, section, password, DeptID)
                      VALUES (:username, :email, :courseid, :section, :password, :DeptID)";
            $stmt = $this->pdo->prepare($query);
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':courseid', $this->course);
            $stmt->bindParam(':section', $this->section);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':DeptID', $this->department); // Include the department ID
            return $stmt->execute();
        }
        
        public function CheckUnqEmail(){
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email',$this->email);

            
            if($stmt->execute()){
                $temp = $stmt->fetch(PDO::FETCH_ASSOC);
                if(empty($temp)){
                    return true; //if its true then unique email 
                }
            }
            return false ; // it exist
        }


    }


?>