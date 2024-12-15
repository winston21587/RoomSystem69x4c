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

        public function login($email, $password) {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($password, $user['password'])) {
                $result = [
                    'role' => $user['role'],
                    'username' => $user['username'],
                    'userId' => $user['id'],
                    'lastName' => $user['lastName'],
                    'firstName' => $user['firstName'],
                    'middleName' => $user['middleName'],
                    'DeptID' => $user['DeptID'],
                    'email' => $user['email']
                ];
        
                switch ($user['role']) {
                    case 'Student':
                        $query = "SELECT id AS studentId, CourseID, Section, yearLevel FROM student WHERE UserID = :userId";
                        $stmt = $this->pdo->prepare($query);
                        $stmt->bindParam(':userId', $user['id']);
                        $stmt->execute();
                        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        
                        if ($student) {
                            $result['studentId'] = $student['studentId'];
                            $result['CourseID'] = $student['CourseID'];
                            $result['Section'] = $student['Section'];
                            $result['yearLevel'] = $student['yearLevel'];
                        }
                        break;
        
                    case 'Admin':
                        $query = "SELECT id AS adminId FROM admin WHERE UserID = :userId";
                        $stmt = $this->pdo->prepare($query);
                        $stmt->bindParam(':userId', $user['id']);
                        $stmt->execute();
                        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
                        if ($admin) {
                            $result['adminId'] = $admin['adminId'];
                        }
                        break;
        
                    case 'Faculty':
                        $query = "SELECT id AS facultyId FROM faculty WHERE UserID = :userId";
                        $stmt = $this->pdo->prepare($query);
                        $stmt->bindParam(':userId', $user['id']);
                        $stmt->execute();
                        $faculty = $stmt->fetch(PDO::FETCH_ASSOC);
        
                        if ($faculty) {
                            $result['facultyId'] = $faculty['facultyId'];
                        }
                        break;
        
                    default:
                        return [];
                }
        
                return $result;
            }        
            return [];
        }
        

        // public function register() {
        //     $query = "INSERT INTO users (username, email, courseid, section, password, DeptID)
        //               VALUES (:username, :email, :courseid, :section, :password, :DeptID)";
        //     $stmt = $this->pdo->prepare($query);
        //     $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        //     $stmt->bindParam(':username', $this->username);
        //     $stmt->bindParam(':email', $this->email);
        //     $stmt->bindParam(':courseid', $this->course);
        //     $stmt->bindParam(':section', $this->section);
        //     $stmt->bindParam(':password', $this->password);
        //     $stmt->bindParam(':DeptID', $this->department); // Include the department ID
        //     return $stmt->execute();
        // }
     
        function register($username, $email, $Password, $departmentID, $lastName, $firstName, $middleName,$section,$course) {
            $sql = "INSERT INTO users (username, email, password, DeptID, lastName, firstName, middleName) 
                    VALUES (:username, :email, :password, :DeptID, :lastName, :firstName, :middleName)";
            $stmt = $this->pdo->prepare($sql);
            $Password = password_hash($Password, PASSWORD_BCRYPT);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $Password);
            $stmt->bindParam(':DeptID', $departmentID, PDO::PARAM_INT);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':middleName', $middleName);
            if($stmt->execute()){
            $userId = $this->pdo->lastInsertId();

                        $studentSql = "INSERT INTO student (UserID, Section, CourseID) 
                                    VALUES (:user_id, :section, :course)";
                        $studentStmt = $this->pdo->prepare($studentSql);
                        $studentStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                        $studentStmt->bindParam(':section', $section);
                        $studentStmt->bindParam(':course', $course);
                        // Execute the insert for the student table
                        if($studentStmt->execute()){
                            return true;
                            }   
                        
                    }
                    return false;
            }

            // public function CheckRole($id){
            //     $query = "SELECT role FROM users WHERE id = :id";

            //     $stmt = $this->pdo->prepare($query);
            //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            //     return $stmt->fetchAll();
            // }



        
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