<?php
require_once __DIR__ . "/sistema.php";

class ConsultaEmpleados extends Sistema
{
    const LIMITE_RESULTADOS = 50;

    function buscarEmpleados($termino)
    {
        $this->connect();

        $sqlBase = "select e.emp_no, e.first_name, e.last_name, e.gender,
                        d.dept_name as departamento_actual,
                        t.title as puesto_actual
                    from employees e
                    left join dept_emp de on de.emp_no = e.emp_no and de.to_date = '9999-01-01'
                    left join departments d on d.dept_no = de.dept_no
                    left join titles t on t.emp_no = e.emp_no and t.to_date = '9999-01-01'
                    where %s
                    order by e.last_name, e.first_name
                    limit " . self::LIMITE_RESULTADOS;

        if (ctype_digit($termino)) {
            $sql = sprintf($sqlBase, "e.emp_no = :termino");
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':termino', (int) $termino, PDO::PARAM_INT);
        } else {
            $sql = sprintf($sqlBase, "(e.first_name LIKE :termino OR e.last_name LIKE :termino)");
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':termino', '%' . $termino . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerDetalleEmpleado($empNo)
    {
        $this->connect();

        $stmt = $this->_db->prepare("select emp_no, first_name, last_name, gender, birth_date, hire_date
                                      from employees where emp_no = :emp_no");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $general = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$general) {
            return null;
        }

        $stmt = $this->_db->prepare("select d.dept_name as departamento, de.from_date, de.to_date
                                      from dept_emp de
                                      inner join departments d on d.dept_no = de.dept_no
                                      where de.emp_no = :emp_no
                                      order by de.from_date desc");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->_db->prepare("select title as puesto, from_date, to_date
                                      from titles
                                      where emp_no = :emp_no
                                      order by from_date desc");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->_db->prepare("select salary as salario, from_date, to_date
                                      from salaries
                                      where emp_no = :emp_no
                                      order by from_date desc");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $salarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'general' => $general,
            'departamento_actual' => $departamentos[0] ?? null,
            'puesto_actual' => $puestos[0] ?? null,
            'salario_actual' => $salarios[0] ?? null,
            'departamentos' => $departamentos,
            'puestos' => $puestos,
            'salarios' => $salarios,
        ];
    }
}
