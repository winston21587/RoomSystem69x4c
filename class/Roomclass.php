<?php
require_once "Database.php";

class Room extends Database
{
    public $roomName;
    public $roomStatus;

    function showAllRoom($dept = NULL)
    {
        $sql = "SELECT * FROM Room WHERE department = :department";
        
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":department", $dept);
        $data = null;

        if($query->execute()){
            $data = $query->fetchAll();
        }

        return $data;
    }

    function showAllSched()
    {
        $sql = "SELECT * FROM schedule";

        
        $query = $this->pdo->prepare($sql);
        $data = null;

        if($query->execute()){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    function fetchRoomId($recordID){
        $sql = "SELECT * FROM Room WHERE id = :recordID";

        
        $query = $this->pdo->prepare($sql);

        $query->bindParam(":recordID", $recordID);

        $data = null;

        if($query->execute()){
            $data = $query->fetch();
        }
            return $data;
    }
}
