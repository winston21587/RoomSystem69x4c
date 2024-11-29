<?php
    require_once "Database.php";
class Admin extends Database{

    public $id;
    public $roomname;
    public $department;
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
}