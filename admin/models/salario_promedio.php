<?php
require_once __DIR__ . "/sistema.php";

class SalarioPromedio extends Sistema
{
    function obtenerSalarioPromedioPorDepartamento()
    {
        $this->connect();

        $sql = "select d.dept_name as departamento, round(avg(s.salary), 2) as salario_promedio
                from dept_emp de
                inner join departments d on d.dept_no = de.dept_no
                inner join salaries s on s.emp_no = de.emp_no and s.to_date = '9999-01-01'
                where de.to_date = '9999-01-01'
                group by d.dept_name
                order by salario_promedio desc";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
