<?php
if (session_status() === PHP_SESSION_NONE) { session_start();}
define("DBDRIVER", "mysql");
define("DBHOST", "mysql");
define("DBNAME", "employeesdb");
define("DBUSER", "user");
define("DBPASSWORD", "password");
define("DBPORT", "3306");
