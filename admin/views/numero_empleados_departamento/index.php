<div class="flex-grow-1 p-4">
    <h1>Número de Empleados por Departamento</h1>
    <p class="text-muted">Total de empleados actualmente activos en cada departamento.</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Departamento</th>
                <th>Total de Empleados</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departamentos as $departamento): ?>
                <tr>
                    <td><?php echo htmlspecialchars($departamento['departamento']); ?></td>
                    <td><?php echo htmlspecialchars($departamento['total_empleados']); ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($departamentos)): ?>
                <tr>
                    <td colspan="2" class="text-center text-muted">No se encontraron departamentos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
