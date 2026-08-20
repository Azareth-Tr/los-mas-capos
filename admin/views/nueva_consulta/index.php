<div class="flex-grow-1 p-4" style="width: min(1100px, 100%); margin: 0 auto; padding: 24px 16px 40px; text-align: center;">
    <h1>Nueva Consulta</h1>

    <p>Muestra los empleados con mas titulos y su salario, en la fecha mas actual</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Cantidad de Titulos</th>
                <th>Salario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?php echo htmlspecialchars($empleado['empleado']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['cantidad_titulos']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['salario']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
