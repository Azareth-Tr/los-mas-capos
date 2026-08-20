<?php
require_once __DIR__ . "/sistema.php";

class SalarioPromedio extends Sistema
{
    // Salario promedio actual por departamento
    function obtenerSalarioPromedioPorDepartamento()
    {
        $this->connect();

        $sql = "SELECT d.dept_name AS departamento, ROUND(AVG(s.salary), 2) AS salario_promedio
                FROM dept_emp de
                INNER JOIN departments d ON d.dept_no = de.dept_no
                INNER JOIN salaries s ON s.emp_no = de.emp_no AND s.to_date = '9999-01-01'
                WHERE de.to_date = '9999-01-01'
                GROUP BY d.dept_name
                ORDER BY salario_promedio DESC";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
