<?php
    include_once("bdKeys.php");

    class Connect{
        private $server = server;
        private $user = user;
        private $pass = pass;
        private $bd = bd;
        private $port = port;

        private $connection;
    
        public function __construct() {
            try {
                $this->connection = new PDO(
                    "pgsql:host=" . $this->server . "; port=" . $this->port . "; dbname=" . $this->bd,
                    $this->user,
                    $this->pass
                );

                $this->connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //echo "CONEXION EXISTOSA<br>";
            } catch(PDOException $error) {
                echo "Error: " . $error->getMessage() . "<br>";
            }
        }

        public function get() {
            return $this->connection;
        }
    }

    $obj = new Connect();
?>