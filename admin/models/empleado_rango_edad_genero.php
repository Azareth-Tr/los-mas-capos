<?php
require_once "sistema.php";

class Empleado_Rango_Edad_Genero extends Sistema {

        function read($referenceDate, $gender){
        $this->connect();
        $sql = "WITH edades AS (
                    SELECT gender,
                        TIMESTAMPDIFF(YEAR, birth_date, :reference_date) AS age
                    FROM employees
                )
                SELECT CASE
                        WHEN age < 30 THEN '<30'
                        WHEN age BETWEEN 30 AND 39 THEN '30-39'
                        WHEN age BETWEEN 40 AND 49 THEN '40-49'
                        WHEN age BETWEEN 50 AND 59 THEN '50-59'
                        ELSE '>=60'
                    END AS age_range,
                    gender,
                    COUNT(*) AS total_employees
                FROM edades";

        $params = array(':reference_date' => $referenceDate);
        if ($gender !== '') {
            $sql .= " WHERE gender = :gender";
            $params[':gender'] = $gender;
        }

        $sql .= " GROUP BY age_range, gender
                ORDER BY CASE age_range
                            WHEN '<30' THEN 1
                            WHEN '30-39' THEN 2
                            WHEN '40-49' THEN 3
                            WHEN '50-59' THEN 4
                            WHEN '>=60' THEN 5
                        END, gender;";

        $sth = $this->_db->prepare($sql);
        foreach ($params as $parameter => $value) {
            $sth->bindValue($parameter, $value);
        }
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}