<?php
include 'sistema.php';

class Empleado extends Sistema {

    public function read() {
        $this->connect();
        $sql = "SELECT * FROM employees";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEmpleadosConTitulosYSalario($cantidad) {
        $this->connect();
        $sql = "SELECT concat(e.first_name,' ', e.last_name) as empleado, count(DISTINCT t.title) as cantidad_titulos, s.salary as salario
                from employees e
                join salaries s on e.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                join titles t on e.emp_no = t.emp_no
                group by e.emp_no, s.salary
                order by 2 desc, 3 desc
                limit :cantidad;";
        $sth = $this->_db->prepare($sql);
        $sth->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>