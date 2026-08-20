<?php
class Sistema {
    var $_dsn;
    var $_usuario;
    var $_contrasena;
    var $_db;

    function __construct() {
        $host = 'mysql';
        $database = 'employeesdb';
        $this->_dsn = "mysql:host={$host};dbname={$database};charset=utf8;";
        $this->_usuario = 'user';
        $this->_contrasena = 'password';
    }

    function connect() {
        $this->_db = new PDO($this->_dsn, $this->_usuario, $this->_contrasena);
    }
}
?>
