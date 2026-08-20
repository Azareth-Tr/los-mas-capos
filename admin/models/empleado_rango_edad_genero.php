<?php
require_once __DIR__ . "/sistema.php";

class EmpleadoRangoEdadGenero extends Sistema
{
    // Distribución de empleados activos por rango de edad y género,
    // calculada contra la fecha de referencia indicada (por defecto hoy).
    // Rangos: <30, 30-39, 40-49, 50-59, >=60
    function obtenerDistribucionPorEdadYGenero($fechaReferencia = null)
    {
        $this->connect();

        if (!$fechaReferencia) {
            $fechaReferencia = date('Y-m-d');
        }

        $sql = "SELECT
                    CASE
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha1) < 30 THEN '<30'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha2) BETWEEN 30 AND 39 THEN '30-39'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha3) BETWEEN 40 AND 49 THEN '40-49'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha4) BETWEEN 50 AND 59 THEN '50-59'
                        ELSE '>=60'
                    END AS rango_edad,
                    e.gender AS genero,
                    COUNT(*) AS total
                FROM employees e
                INNER JOIN dept_emp de ON de.emp_no = e.emp_no AND de.to_date = '9999-01-01'
                GROUP BY rango_edad, genero
                ORDER BY FIELD(rango_edad, '<30','30-39','40-49','50-59','>=60'), genero";

        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':fecha1', $fechaReferencia);
        $stmt->bindValue(':fecha2', $fechaReferencia);
        $stmt->bindValue(':fecha3', $fechaReferencia);
        $stmt->bindValue(':fecha4', $fechaReferencia);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Usada por el reporte tabular (admin/controllers/empleado_rango_edad_genero.php).
// Misma lógica que EmpleadoRangoEdadGenero de arriba (empleados activos, mismos rangos),
// pero con la firma read($fecha, $genero) y las llaves que espera esa vista.
class Empleado_Rango_Edad_Genero extends Sistema
{
    function read($fechaReferencia, $genero = '')
    {
        $this->connect();

        if (!$fechaReferencia) {
            $fechaReferencia = date('Y-m-d');
        }

        $sql = "SELECT
                    CASE
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha1) < 30 THEN '<30'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha2) BETWEEN 30 AND 39 THEN '30-39'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha3) BETWEEN 40 AND 49 THEN '40-49'
                        WHEN TIMESTAMPDIFF(YEAR, e.birth_date, :fecha4) BETWEEN 50 AND 59 THEN '50-59'
                        ELSE '>=60'
                    END AS age_range,
                    e.gender AS gender,
                    COUNT(*) AS total_employees
                FROM employees e
                INNER JOIN dept_emp de ON de.emp_no = e.emp_no AND de.to_date = '9999-01-01'";

        if ($genero !== '') {
            $sql .= " WHERE e.gender = :genero";
        }

        $sql .= " GROUP BY age_range, gender
                   ORDER BY FIELD(age_range, '<30','30-39','40-49','50-59','>=60'), gender";

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
