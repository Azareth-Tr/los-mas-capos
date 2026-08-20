<?php
require_once __DIR__ . "/sistema.php";

class ConsultaEmpleados extends Sistema
{
    const LIMITE_RESULTADOS = 50;

    // Busca empleados por número de empleado exacto o por nombre/apellido (coincidencia parcial).
    // Devuelve una lista resumida: emp_no, nombre completo, departamento y puesto actuales.
    function buscarEmpleados($termino)
    {
        $this->connect();

        $sqlBase = "SELECT e.emp_no, e.first_name, e.last_name, e.gender,
                        d.dept_name AS departamento_actual,
                        t.title AS puesto_actual
                    FROM employees e
                    LEFT JOIN dept_emp de ON de.emp_no = e.emp_no AND de.to_date = '9999-01-01'
                    LEFT JOIN departments d ON d.dept_no = de.dept_no
                    LEFT JOIN titles t ON t.emp_no = e.emp_no AND t.to_date = '9999-01-01'
                    WHERE %s
                    ORDER BY e.last_name, e.first_name
                    LIMIT " . self::LIMITE_RESULTADOS;

        if (ctype_digit($termino)) {
            // Búsqueda directa por número de empleado
            $sql = sprintf($sqlBase, "e.emp_no = :termino");
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':termino', (int) $termino, PDO::PARAM_INT);
        } else {
            // Búsqueda por nombre o apellido
            $sql = sprintf($sqlBase, "(e.first_name LIKE :termino OR e.last_name LIKE :termino)");
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':termino', '%' . $termino . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Detalle completo de un empleado: datos generales, situación actual e históricos.
    function obtenerDetalleEmpleado($empNo)
    {
        $this->connect();

        // Datos generales
        $stmt = $this->_db->prepare("SELECT emp_no, first_name, last_name, gender, birth_date, hire_date
                                      FROM employees WHERE emp_no = :emp_no");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $general = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$general) {
            return null;
        }

        // Histórico de departamentos (el primero es el actual porque to_date = 9999-01-01 ordena al final,
        // así que se marca aparte cuál es el vigente)
        $stmt = $this->_db->prepare("SELECT d.dept_name AS departamento, de.from_date, de.to_date
                                      FROM dept_emp de
                                      INNER JOIN departments d ON d.dept_no = de.dept_no
                                      WHERE de.emp_no = :emp_no
                                      ORDER BY de.from_date DESC");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Histórico de puestos
        $stmt = $this->_db->prepare("SELECT title AS puesto, from_date, to_date
                                      FROM titles
                                      WHERE emp_no = :emp_no
                                      ORDER BY from_date DESC");
        $stmt->bindValue(':emp_no', $empNo, PDO::PARAM_INT);
        $stmt->execute();
        $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Histórico de salarios
        $stmt = $this->_db->prepare("SELECT salary AS salario, from_date, to_date
                                      FROM salaries
                                      WHERE emp_no = :emp_no
                                      ORDER BY from_date DESC");
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
