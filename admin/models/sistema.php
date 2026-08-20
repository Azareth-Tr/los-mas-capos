<?php
class Sistema {
    var $_dsn;
    var $_usuario;
    var $_contrasena;
    var $_db;

    function __construct() {
        $host = getenv('DB_HOST') ?: 'mysql';
        $database = getenv('DB_NAME') ?: 'employeesdb';
        $this->_dsn = "mysql:host={$host};dbname={$database};charset=utf8;";
        $this->_usuario = getenv('DB_USER') ?: 'user';
        $this->_contrasena = getenv('DB_PASSWORD') ?: 'password';
    }

    function connect() {
        $this->_db = new PDO($this->_dsn, $this->_usuario, $this->_contrasena);
    }
}
?>