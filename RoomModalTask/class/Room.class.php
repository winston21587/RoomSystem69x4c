<?php
include "./class/Database.php";

class Room
{
    public $roomName;
    public $roomStatus;

    function showAllRoom()
    {
        $sql = "SELECT * FROM room";

        $db = new Database;
        $query = $db->pdo->prepare($sql);
        $data = null;

        if($query->execute()){
            $data = $query->fetchAll();
        }

        return $data;
    }

    function showAllSched()
    {
        $sql = "SELECT * FROM schedule";

        $db = new Database;
        $query = $db->pdo->prepare($sql);
        $data = null;

        if($query->execute()){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    function fetchRoomId($recordID){
        $sql = "SELECT * FROM room WHERE id = :recordID";

        $db = new Database;
        $query = $db->pdo->prepare($sql);

        $query->bindParam(":recordID", $recordID);

        $data = null;

        if($query->execute()){
            $data = $query->fetch();
        }
            return $data;
    }
}
