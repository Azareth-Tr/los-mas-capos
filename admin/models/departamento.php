<?php
include 'sistema.php';

class Departamento extends Sistema {

    public function read() {
        $this->connect();
        $sql = "select * from departments";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function promedioDepartamentos() {
        $this->connect();
        $sql = "select d.dept_name as departamento, avg(s.salary) as salario_promedio
                from departments d
                    join dept_emp on d.dept_no = dept_emp.dept_no and dept_emp.to_date = '9999-01-01'
                    join employeesdb.employees e on dept_emp.emp_no = e.emp_no
                    join salaries s on e.emp_no = s.emp_no and s.to_date = '9999-01-01'
                group by dept_name;";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function obtenerNumeroEmpleadosPorDepartamento() {
        $this->connect();
        $sql = "select count(e.emp_no) as total_empleados, d.dept_name as departamento
                from departments d
                    join dept_emp on d.dept_no = dept_emp.dept_no and dept_emp.to_date = '9999-01-01'
                    join employeesdb.employees e on dept_emp.emp_no = e.emp_no
                group by dept_name;";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>