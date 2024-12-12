<?php
    require_once "Database.php";
class Admin extends Database{

    public $id;
    public $roomname;
    public $department;
    public $status;
    public $timeIn;
    
    public $timeOut;

    public function addRoom($roomname,$department){
        $query = "INSERT INTO Room (RoomName,department)
        VALUES (:RoomName,:department)
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":RoomName",$roomname);
        $stmt->bindParam(":department",$department);
        return $stmt->execute();
    }

    public function ShowRooms(){
        $query = "SELECT Room.id,
        Room.RoomName as RoomName,
        Room.department as deptID,
        Room.status,
        Department.deptName as department 
        FROM Room 
        LEFT JOIN Department ON Department.id = Room.department";
        // if(!empty($dept)){
        //     $query = "SELECT id,RoomName,department,status FROM Room WHERE department = :department";
        // }
        $stmt = $this->pdo->prepare($query);
        // if(!empty($dept)){
        // $stmt->bindParam(":department", $dept);
        // }
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }



    public function DeleteRooms($id){
        if(!empty($id)){
        $query = "DELETE FROM Room WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }
    return false;
    }

    public function EditRooms($id,$roomname,$department,$status){
        $query = "UPDATE Room SET RoomName = :RoomName ,department = :department ,status = :status WHERE id = :id ";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":RoomName",$roomname);
        $stmt->bindParam(":department",$department);
        $stmt->bindParam(":status",$status);

        return $stmt->execute();
    
    }

    public function EmptyAll(){
        
    }

    public function CheckUnqRoom($roomname){
        $query = "SELECT RoomName FROM Room WHERE RoomName = :RoomName ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":RoomName",$roomname);
        if($stmt->execute()){
        $ass = $stmt->fetchAll();
        if(empty($ass)){
            return true; // true kapag unique
        }
        return false; // false kapag existing
        }
        // if(empty($room)){
        //     return true;
        // }else{
        //     return false;
        // }
         return false;

    }
    public function getCourse(){
        $query = "SELECT * FROM course";
        $stmt = $this->pdo->prepare($query);

        if( $stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }
    public function getDept(){
        $query = "SELECT * FROM Department";
        $stmt = $this->pdo->prepare($query);

        if( $stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    public function getSub(){
        $query = "SELECT * FROM subject";
        $stmt = $this->pdo->prepare($query);
        if( $stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    function showAllSched($id)
    {

        $sql = "SELECT 
        schedule.id as SchedID,
        schedule.DayOfWeek,
        schedule.start_time,
        schedule.end_time,
        subject.SubName as subjectN,
        profTable.profName as professor
        FROM schedule 
        LEFT JOIN subject ON subject.id = schedule.subjectid 
        LEFT JOIN profTable ON profTable.id = schedule.profid
        WHERE schedule.roomid = :id
        ";
        $query = $this->pdo->prepare($sql);

        $query->bindParam(":id", $id);
        

        $data = null;
        if($query->execute()){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function AddSched($roomid,$DayOfWeek,$start_time,$end_time,$subjectid){
        
        $query = "INSERT INTO schedule 
        (roomid,DayOfWeek,start_time,end_time,subjectid)
VALUES  (:roomid,:DayOfWeek,:start_time,:end_time,:subjectid)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":roomid",$roomid);
        $stmt->bindParam(":DayOfWeek",$DayOfWeek);
        $stmt->bindParam(":start_time",$start_time);
        $stmt->bindParam(":end_time",$end_time);
        $stmt->bindParam(":subjectid",$subjectid);
        
        return $stmt->execute();

    }


    public function showroomForDept($department){
        $query = "SELECT id,RoomName FROM Room WHERE department = :department ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":department",$department);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];

    }

    public function showFaculty($department){
        $query = "SELECT users.id as id,users.username as username,Department.deptName as department
        FROM users
        LEFT JOIN Department ON Department.id = users.DeptID
        WHERE role = 'Staff' AND Department.id = :department";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":department",$department);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function SendRequest($facultyID,$sender,$SchedID){
        $query = "INSERT INTO requests (sender, schedID, faculty_id) 
        VALUES (:sender, :schedID, :faculty_id)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":sender",$sender);
        $stmt->bindParam(":schedID",$SchedID);
        $stmt->bindParam(":faculty_id",$facultyID);

        return $stmt->execute();

    }

    public function displayRequest($user){
        $query = "SELECT 
        requests.request_id as id,
        requests.sender as sender,
        users.username as Name,
        Department.deptName as Department,
        Room.RoomName as Room,
        schedule.start_time as start,
        schedule.end_time as end,
        requests.status as status 
        FROM requests
        LEFT JOIN users ON users.id = requests.faculty_id
        LEFT JOIN Department ON Department.id = users.DeptID
        LEFT JOIN schedule ON requests.schedID = schedule.id
        LEFT JOIN Room ON Room.id = schedule.roomid
        WHERE requests.sender = :user OR users.username = :user";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":user",$user);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function AcceptRequest($status,$id){
        $query = "UPDATE requests SET status = :status WHERE request_id = :id";
               $stmt = $this->pdo->prepare($query);
               $stmt->bindParam(":status",$status);
               $stmt->bindParam(":id",$id);
               return $stmt->execute();
    }

}