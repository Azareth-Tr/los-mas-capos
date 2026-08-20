<?php
require_once __DIR__ . "/sistema.php";

class TopEmpleadosIncrementoSalarial extends Sistema
{
    // Top N empleados con mayor incremento salarial (salario máximo vs mínimo) en su carrera
    function leer($cantidad = 10)
    {
        $this->connect();

        $cantidad = (int) $cantidad;
        if ($cantidad <= 0) {
            $cantidad = 10;
        }

        $sql = "SELECT e.emp_no,
                    CONCAT(e.first_name, ' ', e.last_name) AS empleado,
                    MIN(s.salary) AS salario_minimo,
                    MAX(s.salary) AS salario_maximo,
                    ROUND((MAX(s.salary) - MIN(s.salary)) / MIN(s.salary) * 100, 2) AS porcentaje_incremento,
                    TIMESTAMPDIFF(YEAR, MIN(s.from_date), MAX(s.from_date)) AS anios_carrera
                FROM employees e
                INNER JOIN salaries s ON s.emp_no = e.emp_no
                GROUP BY e.emp_no, empleado
                HAVING anios_carrera > 0
                ORDER BY porcentaje_incremento DESC
                LIMIT $cantidad";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
