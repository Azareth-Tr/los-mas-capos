<div class="flex-grow-1 p-4">
    <h1>Empleados por Edad y Género</h1>
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="reference_date" class="form-label">Fecha de referencia</label>
            <input type="date" id="reference_date" name="reference_date" class="form-control" value="<?php echo htmlspecialchars($referenceDate); ?>" required>
        </div>
        <div class="col-md-4">
            <label for="gender" class="form-label">Género</label>
            <select id="gender" name="gender" class="form-select">
                <option value="" <?php echo $gender === '' ? 'selected' : ''; ?>>Todos</option>
                <option value="M" <?php echo $gender === 'M' ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo $gender === 'F' ? 'selected' : ''; ?>>Femenino</option>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Consultar</button>
        </div>
    </form>
    <p>Total de empleados: <?php echo $totalEmpleados; ?></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Rango de edad</th>
                <th>Género</th>
                <th>Total de empleados</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?php echo htmlspecialchars($empleado['age_range']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['gender']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['total_employees']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Fecha utilizada: <?php echo htmlspecialchars($referenceDate); ?></p>
