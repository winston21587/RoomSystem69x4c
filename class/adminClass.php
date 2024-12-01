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

    public function ShowRooms(){
        $query = "SELECT id,RoomName,department,status FROM Room";
        $stmt = $this->pdo->prepare($query);

        if($stmt->execute()){
            return $stmt->fetchAll();
        }
        return [];
    }

    public function SetSched(){
        
    }

    public function DeleteRooms($id){
        $query = "DELETE FROM Room WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id",$id);

        return $stmt->execute();
    }

    public function EditRooms(){
        $query = "UPDATE Room SET RoomName = :RoomName ,department = :department ,status = :department WHERE id = :id ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":RoomName",$this->roomname);
        $stmt->bindParam(":department",$this->department);
        $stmt->bindParam(":status",$this->status);

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