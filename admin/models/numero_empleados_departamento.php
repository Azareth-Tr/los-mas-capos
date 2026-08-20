<?php
require_once __DIR__ . "/sistema.php";

class NumeroEmpleadosDepartamento extends Sistema
{
    function obtenerEmpleadosPorDepartamento()
    {
        $this->connect();

        $sql = "select d.dept_name as departamento, count(de.emp_no) as total_empleados
                from dept_emp de
                inner join departments d on de.dept_no = d.dept_no
                where de.to_date = '9999-01-01'
                group by d.dept_name
                order by total_empleados desc";

        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
