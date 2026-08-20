<?php
require_once __DIR__ . '/../sistema.class.php';

class EvolucionContratacion extends Sistema
{
    function leer()
    {
        $this->conectar();
        $sql = "select year(e.hire_date) as anio, e.gender as genero, count(*) as total_contrataciones from employees e
                group by year(e.hire_date), e.gender
                order by anio desc;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $evolucion = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $evolucion;
    }
}
