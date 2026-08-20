<?php
require_once __DIR__ . '/../sistema.class.php';

class TopEmpleadosIncrementoSalarial extends Sistema
{
    function leer($cantidad)
    {
        $this->conectar();
        $sql = "select concat(e.first_name, ' ', e.last_name) as empleado, min(s.salary) as salario_minimo, max(s.salary) as salario_maximo,
                    round(((max(s.salary) - min(s.salary)) / min(s.salary)) * 100, 2) as porcentaje_incremento,
                    timestampdiff(year, e.hire_date, now()) as anios_carrera
                    from employees e
                    join salaries s on e.emp_no = s.emp_no
                    group by e.emp_no
                    order by porcentaje_incremento desc
                    limit :cantidad;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        $evolucion = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $evolucion;
    }
}
