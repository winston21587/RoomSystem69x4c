<?php
    require_once "Database.php";

        class Rooms extends Database{

            public $id;
            public $RoomName;

            public $department;
        
        

            public function AddRoom(){
                $query = "INSERT INTO Room  ('RoomName', 'department') VALUES 
                ()";

                $stmt = $this->pdo->prepare($query);

                $stmt->bindParam(":RoomName",$this->RoomName);
                $stmt->bindParam("department",$this->department);

                return $stmt->execute();
            }

            public function UseRoom(){
                $query = "UPDATE Room SET
                RoomName = :RoomName,
                department = :department,
                status = 'available'
                 WHERE id = :id";

                $stmt = $this->pdo->prepare($query);

                $stmt->bindParam(":RoomName",$this->RoomName);
                $stmt->bindParam(":department",$this->department);
                $stmt->bindParam(":id",$this->id);

                return $stmt->execute();
            }

            public function deleteRoom(){
                $query = "DELETE FROM Room WHERE id = :id";

                $stmt = $this->pdo->prepare($query);

                $stmt->bindParam(":id",$this->id);

                return $stmt->execute();
            }

        }

?>