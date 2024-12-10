<?php
    require_once "Database.php";
class Admin extends Database{

    public $id;
    public $roomname;
    public $department;
    public $status;
    public $timeIn;
    
    public $timeOut;

    public function addRoom(){
        $query = "INSERT INTO Room (RoomName,department)
        VALUES (:RoomName,:department)
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":RoomName",$this->roomname);
        $stmt->bindParam(":department",$this->department);
        return $stmt->execute();
    }

    public function ShowRooms($dept){
        $query = "SELECT id,RoomName,department,status FROM Room";
        if(!empty($dept)){
            $query = "SELECT id,RoomName,department,status FROM Room WHERE department = :department";
        }
        $stmt = $this->pdo->prepare($query);
        if(!empty($dept)){
        $stmt->bindParam(":department", $dept);
        }
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    public function SetSched(){
        
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

    public function CheckUnqRoom(){
        $query = "SELECT RoomName FROM Room WHERE RoomName = :RoomName ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":RoomName",$this->roomname);
        $room = $stmt->fetchColumn();
        if(empty($room)){
            return true;
        }else{
            return false;
        }

        
    }
}