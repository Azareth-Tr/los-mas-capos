<?php
require_once __DIR__ . "/sistema.php";

class EvolucionContratacion extends Sistema
{
    // Total de contrataciones por año y género
    function leer()
    {
        $this->connect();

        $sql = "SELECT YEAR(hire_date) AS anio, gender AS genero, COUNT(*) AS total_contrataciones
                FROM employees
                GROUP BY anio, genero
                ORDER BY anio, genero";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
