<?php
    class Database{
        private $host = 'localhost';
        private $user = 'root';
        private $db = 'RoomSystem';
        private $pass = '';
        protected $pdo = null;
        public function __construct(){
            try{
                $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db,
                $this->user,$this->pass);    
            }catch(PDOException $e){
                echo 'connection Error:'.$e->getMessage();
            }
        }


    }


?>