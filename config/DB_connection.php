<?php

class DB_connection{
    public function __construct()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if($conn->connect_error){
            die("<h1>DataBase connection failed!");
        }
        return $this->conn = $conn;
        
    }

    // public function validateInput($conn, $input){
    //     return mysqli_real_escape_string($conn, $input);
    // }
}


?>