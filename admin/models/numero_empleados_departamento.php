<?php
require_once __DIR__ . "/sistema.php";

class NumeroEmpleadosDepartamento extends Sistema
{
    // Devuelve el total de empleados activos (sin to_date vencido) por departamento
    function obtenerEmpleadosPorDepartamento()
    {
        $this->connect();

        $sql = "SELECT d.dept_name AS departamento, COUNT(de.emp_no) AS total_empleados
                FROM dept_emp de
                INNER JOIN departments d ON de.dept_no = d.dept_no
                WHERE de.to_date = '9999-01-01'
                GROUP BY d.dept_name
                ORDER BY total_empleados DESC";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
