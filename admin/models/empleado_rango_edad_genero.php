<?php
require_once __DIR__ . "/sistema.php";

class EmpleadoRangoEdadGenero extends Sistema
{
    function obtenerDistribucionPorEdadYGenero($fechaReferencia = null)
    {
        $this->connect();

        if (!$fechaReferencia) {
            $fechaReferencia = date('Y-m-d');
        }

        $sql = "select case
                        when timestampdiff(year, e.birth_date, :fecha1) < 30 then '<30'
                        when timestampdiff(year, e.birth_date, :fecha2) between 30 and 39 then '30-39'
                        when timestampdiff(year, e.birth_date, :fecha3) between 40 and 49 then '40-49'
                        when timestampdiff(year, e.birth_date, :fecha4) between 50 and 59 then '50-59'
                        else '>=60'
                    end as rango_edad,
                    e.gender as genero,
                    count(*) as total
                from employees e
                inner join dept_emp de on de.emp_no = e.emp_no and de.to_date = '9999-01-01'
                group by rango_edad, genero
                order by field(rango_edad, '<30','30-39','40-49','50-59','>=60'), genero";

        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':fecha1', $fechaReferencia);
        $stmt->bindValue(':fecha2', $fechaReferencia);
        $stmt->bindValue(':fecha3', $fechaReferencia);
        $stmt->bindValue(':fecha4', $fechaReferencia);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Empleado_Rango_Edad_Genero extends Sistema
{
    function read($fechaReferencia, $genero = '')
    {
        $this->connect();

        if (!$fechaReferencia) {
            $fechaReferencia = date('Y-m-d');
        }

        $sql = "select
                    case
                        when timestampdiff(year, e.birth_date, :fecha1) < 30 then '<30'
                        when timestampdiff(year, e.birth_date, :fecha2) between 30 and 39 then '30-39'
                        when timestampdiff(year, e.birth_date, :fecha3) between 40 and 49 then '40-49'
                        when timestampdiff(year, e.birth_date, :fecha4) between 50 and 59 then '50-59'
                        else '>=60'
                    end as age_range,
                    e.gender as gender,
                    count(*) as total_employees
                from employees e
                inner join dept_emp de on de.emp_no = e.emp_no and de.to_date = '9999-01-01'";

        if ($genero !== '') {
            $sql .= " where e.gender = :genero";
        }

        $sql .= " group by age_range, gender
                   order by field(age_range, '<30','30-39','40-49','50-59','>=60'), gender";

        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':fecha1', $fechaReferencia);
        $stmt->bindValue(':fecha2', $fechaReferencia);
        $stmt->bindValue(':fecha3', $fechaReferencia);
        $stmt->bindValue(':fecha4', $fechaReferencia);
        if ($genero !== '') {
            $stmt->bindValue(':genero', $genero);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
