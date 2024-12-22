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

        if ($query->execute()) {
            $data = $query->fetchAll();
        }

        return $data;
    }

    // Changed the sqsl query to look for the room id instead of the id para mas specific and correct ang output.
    function showAllSched($id, $dept)
    {
        $sql = "SELECT * FROM schedule LEFT JOIN faculty ";

        if (isset($id)) {
            $sql = "SELECT * FROM schedule WHERE roomid = :id";
        }
        if (isset($dept)) {
            $sql = "SELECT * FROM schedule LEFT JOIN Room ON Room.id = schedule.roomid WHERE Room.department = :department";
        }
        $query = $this->pdo->prepare($sql);

        if (isset($id)) {
            $query->bindParam(":id", $id);
        }
        if (isset($dept)) {
            $query->bindParam(":department", $dept);
        }
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    function fetchRoomId($recordID)
    {
        $sql = "SELECT * FROM Room WHERE id = :recordID";


        $query = $this->pdo->prepare($sql);

        $query->bindParam(":recordID", $recordID);

        $data = null;

        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    // function roomCheckIn($roomid, $start_time, $end_time){
    //     $sql = "INSERT INTO schedule(start_time, end_time) VALUES (:start_time, :end_time) WHERE roomid = :roomid";

    //     $query = $this->pdo->prepare($sql);

    //     $query->bindParam(":roomid", $roomid);
    //     $query->bindParam(":start_time", $start_time);
    //     $query->bindParam(":end_time", $end_time);

    //     return $query->execute();
    // }

    function roomAvail($id)
    {
        $sql = "UPDATE room SET status = 'unavailable' WHERE id = :id";

        $query = $this->pdo->prepare($sql);

        $query->bindParam(":id", $id);

        return $query->execute();
    }

    function showNewSched($id)
    {
        $sql = "SELECT * 
                FROM schedule
                LEFT OUTER JOIN room ON schedule.roomid = room.id
                LEFT OUTER JOIN subject ON subject.id = schedule.subjectid
                RIGHT JOIN (
                    SELECT 
                        users.id AS userId,
                        users.lastName AS profName,
                        faculty.UserID AS facultyId,
                        faculty.id AS profId
                    FROM users 
                    JOIN faculty ON users.id = faculty.userId
                ) AS user_faculty ON user_faculty.profId = schedule.profid
                WHERE department = :id";

        $query = $this->pdo->prepare($sql);

        $query->bindParam(":id", $id);
        
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
