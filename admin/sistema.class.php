<?php
require_once __DIR__ . '/config.php';

class Sistema
{
    var $db;
    function __construct()
    {
        $this->conectar();
    }

    function conectar()
    {
        $this->db = new PDO(
            DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME,
            DBUSER,
            DBPASSWORD,
        );
    }
}
