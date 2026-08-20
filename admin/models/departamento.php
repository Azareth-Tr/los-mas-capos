<?php
include 'sistema.php';

class Departamento extends Sistema {

    public function read() {
        $this->connect();
        $sql = "SELECT * FROM departments";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function promedioDepartamentos() {
        $this->connect();
        $sql = "select d.dept_name as departamento, avg(s.salary) as salario_promedio
                from departments d
                    join dept_emp on d.dept_no = dept_emp.dept_no
                    join employeesdb.employees e on dept_emp.emp_no = e.emp_no
                    join salaries s on e.emp_no = s.emp_no
                group by dept_name;";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function obtenerNumeroEmpleadosPorDepartamento() {
        $this->connect();
        $sql = "SELECT count(e.emp_no) as total_empleados, d.dept_name as departamento
                from departments d
                    join dept_emp on d.dept_no = dept_emp.dept_no
                    join employeesdb.employees e on dept_emp.emp_no = e.emp_no
                group by 2;";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>