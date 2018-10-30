
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConectarBD
 *
 * @author Luis Alvarez
 */
class ConectarBD {

    private $conn;

    private function conectar() {
        $this->conn = new mysqli("localhost", "root", "", "flas015");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            exit();
        }else{
            return 'ok';
        }
    }
    
    function __construct() {
        $this->conectar();
    }
    
    function getConn() {
        return $this->conn;
    }

}
