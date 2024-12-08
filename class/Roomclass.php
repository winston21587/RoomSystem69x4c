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

    // Changed the sqsl query to look for the room id instead of the id para mas specific and correct ang output.
    function showAllSched($id,$dept)
    {
        $sql = "SELECT * FROM schedule";

        if(isset($id)){
            $sql = "SELECT * FROM schedule WHERE roomid = :id";
        }
        if(isset($dept)){
            $sql = "SELECT * FROM schedule LEFT JOIN Room ON Room.id = schedule.roomid WHERE Room.department = :department";
        }
        $query = $this->pdo->prepare($sql);

        if(isset($id)){
        $query->bindParam(":id", $id);
        }
        if(isset($dept)){
        $query->bindParam(":department", $dept);
        }
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
