<?php
class Sistema {
    var $_dsn="mysql:host=mariadb;dbname=employeesdb;charset=utf8;";
    var $_usuario="user";
    var $_contrasena="password";
    var $_db;

    function connect() {
        $this->_db = new PDO($this->_dsn, $this->_usuario, $this->_contrasena);
    }
}
?>