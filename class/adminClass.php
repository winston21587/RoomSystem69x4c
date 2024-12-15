<?php
    require_once "Database.php";
class Admin extends Database{

    public $id;
    public $roomname;
    public $department;
    public $status;
    public $timeIn;
    
    public $timeOut;

    public function addRoom($roomname,$department,$floor,$RoomType,$Building){
        $query = "INSERT INTO room (RoomName,department,floor,RoomType,Building)
        VALUES (:RoomName,:department,:floor,:RoomType,:Building)
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":RoomName",$roomname);
        $stmt->bindParam(":floor",$floor);
        $stmt->bindParam(":RoomType",$RoomType);
        $stmt->bindParam(":Building",$Building);
        $stmt->bindParam(":department",$department);
        return $stmt->execute();
    }

    public function ShowRooms(){
        $query = "SELECT room.id as id,
        room.RoomName as RoomName,  
        room.department as deptID,
        department.deptName as department ,
        room.RoomType as RoomType,
        room.floor as floor,
        room.Building as Building
        FROM room
        LEFT JOIN department ON department.id = room.department";
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
        $query = "DELETE FROM room WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }
    return false;
    }
    public function DeleteSchedule($id){
        if(!empty($id)){
        $query = "DELETE FROM schedule WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }
    return false;
    }


    public function EditRooms($id,$roomname,$department,$floor,$roomtype,$building){
        $query = "UPDATE room 
            SET 
                RoomName = :RoomName,
                department = :department,
                floor = :floor,
                RoomType = :roomtype,
                Building = :building
            WHERE 
                id = :id;
             ";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":RoomName",$roomname);
        $stmt->bindParam(":department",$department);
        $stmt->bindParam(":roomtype",$roomtype);
        $stmt->bindParam(":building",$building);
        $stmt->bindParam(":floor",$floor);

        return $stmt->execute();
    
    }

    public function EditSched($id, $day, $start, $end, $subid, $profid, $sem, $year){
        $query = "UPDATE schedule SET 
                    DayOfWeek = :DayOfWeek, 
                    start_time = :start_time, 
                    end_time = :end_time, 
                    subjectid = :subjectid, 
                    profid = :profid, 
                    semester = :semester, 
                    schoolYear = :schoolYear 
                  WHERE id = :id";
    
        $stmt = $this->pdo->prepare($query);
    
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":DayOfWeek", $day);
        $stmt->bindParam(":start_time", $start);
        $stmt->bindParam(":end_time", $end);
        $stmt->bindParam(":subjectid", $subid);
        $stmt->bindParam(":profid", $profid);
        $stmt->bindParam(":semester", $sem);
        $stmt->bindParam(":schoolYear", $year);
    
        return $stmt->execute();
    }
    

    public function EmptyAll(){
        
    }

    public function CheckUnqRoom($roomname){
        $query = "SELECT RoomName FROM room WHERE RoomName = :RoomName ";
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
        $query = "SELECT * FROM department";
        $stmt = $this->pdo->prepare($query);

        if( $stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    public function getSub(){
        $query = "SELECT id,SubName FROM subject";
        $stmt = $this->pdo->prepare($query);
        if( $stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    public function getProf(){
        $query = "SELECT faculty.id,CONCAT(users.firstName,' ',users.lastName) as name
        FROM faculty LEFT JOIN users ON users.id = faculty.UserID
";
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
        CONCAT(users.firstName,' ',users.lastName) as professor,
        schedule.semester as semester,
        schedule.schoolYear as schoolYear,
        schedule.status as status,
        faculty.id as facultyID
        FROM schedule 
        LEFT JOIN subject ON subject.id = schedule.subjectid 
        LEFT JOIN faculty ON faculty.id = schedule.profid
        LEFT JOIN users ON users.id = faculty.UserID
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

    public function AddSched($roomid,$DayOfWeek,$start_time,$end_time,$subjectid,$profid,$sem,$year){
        
        $query = "INSERT INTO schedule 
        (roomid,DayOfWeek,start_time,end_time,subjectid,profid,semester,schoolYear)
VALUES  (:roomid,:DayOfWeek,:start_time,:end_time,:subjectid,:profid,:semester,:schoolYear)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":roomid",$roomid);
        $stmt->bindParam(":DayOfWeek",$DayOfWeek);
        $stmt->bindParam(":start_time",$start_time);
        $stmt->bindParam(":end_time",$end_time);
        $stmt->bindParam(":subjectid",$subjectid);
        $stmt->bindParam(":profid",$profid);
        $stmt->bindParam(":semester",$sem);
        $stmt->bindParam(":schoolYear",$year);
        
        return $stmt->execute();

    }


    public function showroomForDept($department){
        $query = "SELECT id,RoomName FROM room WHERE department = :department ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":department",$department);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];

    }

    public function showFaculty($department,$username){
        $query = "SELECT users.id as id,users.username as username,Department.deptName as department
        FROM users
        LEFT JOIN Department ON Department.id = users.DeptID
        WHERE role = 'Staff' AND Department.id = :department AND users.username != :username";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":department",$department);
        $stmt->bindParam(":username",$username);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function SendRequest($RequestedBy,$RespondedBy,$schedID,$DateRequested,$DateOfUse){
        $query = "INSERT INTO requests (RequestedBy, RespondedBy, schedID, DateRequested, DateOfUse) 
        VALUES (:RequestedBy, :RespondedBy, :schedID, :DateRequested, :DateOfUse)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':RequestedBy',$RequestedBy);   
        $stmt->bindParam(':RespondedBy',$RespondedBy);
        $stmt->bindParam(':schedID',$schedID);
        $stmt->bindParam(':DateRequested',$DateRequested);
        $stmt->bindParam(':DateOfUse',$DateOfUse);


        return $stmt->execute();

    }

    public function displayRequest($user){
        $query = "SELECT 
        requests.request_id as id,
		requests.DateRequested as DateRequested,
		requests.RequestedBy as RequestedBy,
        requests.DateOfUse as DateOfUse,
        schedule.DayOfWeek as DayOfweek,
        schedule.start_time as start,
        schedule.end_time as end,
        requests.status as status,
        room.RoomName as Roomname,
        CONCAT(users.firstName,' ',users.lastName) as professor,
        room.id as roomid
        FROM requests
        LEFT JOIN schedule ON schedule.id = requests.schedID
        LEFT JOIN room ON room.id = schedule.roomid
        LEFT JOIN faculty ON faculty.id = requests.RequestedBy
        LEFT JOIN users ON users.id = faculty.UserID
        WHERE requests.RespondedBy = :responder;
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":responder",$user);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }
    public function AcceptRequest($status, $id) {
        $allowedStatuses = ['Pending', 'Approved', 'Rejected'];
        if (!in_array($status, $allowedStatuses, true)) {
            throw new InvalidArgumentException("Invalid status value: $status");
        }    
        $query = "UPDATE requests SET status = :statuse WHERE request_id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":statuse", $status, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        } else {
            error_log(print_r($stmt->errorInfo(), true));
            return false;
        }
    }
    

}