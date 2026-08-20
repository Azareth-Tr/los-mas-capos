<div class="flex-grow-1 p-4" style="width: min(1100px, 100%); margin: 0 auto; padding: 24px 16px 40px; text-align: center;">
    <h1>Nueva Consulta</h1>
    <hr>
    <form method="GET">
        <p>Cantidad de empleados a mostrar:</p>
        <div class="input-group mb-3" style="max-width: 200px; margin: 0 auto;">
            <input type="number" name="cantidad" min="1" value="10" class="form-control">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Mostrar</button>
        </div>
    </form>
    <hr>
    <p>Muestra los empleados con mas titulos y su salario, en la fecha mas actual</p>
    <hr>
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
