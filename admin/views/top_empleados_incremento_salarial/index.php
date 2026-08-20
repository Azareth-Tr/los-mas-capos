<div class="flex-grow-1 p-4 d-flex flex-column align-items-center">
    <h1>Top 10 empleados con mayor incremento salarial en su carrera.</h1>
    <hr>
    <form method="GET">
        <p>Cantidad de empleados a mostrar:</p>
        <div class="input-group mb-3">
            <input type="number" name="cantidad" min="1" value="10" class="form-control">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Mostrar</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Empleado</th>
                <th scope="col">Salario minimo</th>
                <th scope="col">Salario maximo</th>
                <th scope="col">Porcentaje de incremento</th>
                <th scope="col">Años en la empresa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topEmpleados as $i => $row): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo $row['empleado']; ?></td>
                    <td><?php echo $row['salario_minimo']; ?></td>
                    <td><?php echo $row['salario_maximo']; ?></td>
                    <td><?php echo $row['porcentaje_incremento']; ?>%</td>
                    <td><?php echo $row['anios_carrera']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>