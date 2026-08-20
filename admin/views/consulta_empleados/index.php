<div class="flex-grow-1 p-4">
    <h1>Consulta de Empleados</h1>
    <p class="text-muted">Busca por número de empleado o por nombre/apellido para ver su información detallada.</p>

    <form method="get" class="row g-2 mb-4">
        <div class="col-auto">
            <input type="text" name="buscar" class="form-control" placeholder="Número de empleado, nombre o apellido"
                value="<?php echo htmlspecialchars($termino); ?>" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <?php if ($detalle): ?>

        <?php if (count($resultados) > 1): ?>
            <a href="?buscar=<?php echo urlencode($termino); ?>" class="btn btn-link ps-0 mb-3">&laquo; Volver a resultados</a>
        <?php endif; ?>

        <?php $g = $detalle['general']; ?>
        <div class="card mb-4">
            <div class="card-header">
                <strong>#<?php echo htmlspecialchars($g['emp_no']); ?> —
                    <?php echo htmlspecialchars($g['first_name'] . ' ' . $g['last_name']); ?></strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><strong>Género:</strong>
                        <?php echo $g['gender'] === 'M' ? 'Masculino' : 'Femenino'; ?></div>
                    <div class="col-md-3"><strong>Fecha de nacimiento:</strong> <?php echo htmlspecialchars($g['birth_date']); ?></div>
                    <div class="col-md-3"><strong>Fecha de contratación:</strong> <?php echo htmlspecialchars($g['hire_date']); ?></div>
                    <div class="col-md-3"><strong>Antigüedad:</strong>
                        <?php
                        $antiguedad = (new DateTime($g['hire_date']))->diff(new DateTime())->y;
                        echo $antiguedad . ' años';
                        ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><strong>Departamento actual:</strong>
                        <?php echo $detalle['departamento_actual'] ? htmlspecialchars($detalle['departamento_actual']['departamento']) : 'N/A'; ?>
                    </div>
                    <div class="col-md-4"><strong>Puesto actual:</strong>
                        <?php echo $detalle['puesto_actual'] ? htmlspecialchars($detalle['puesto_actual']['puesto']) : 'N/A'; ?>
                    </div>
                    <div class="col-md-4"><strong>Salario actual:</strong>
                        <?php echo $detalle['salario_actual'] ? '$' . number_format($detalle['salario_actual']['salario']) : 'N/A'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h5>Histórico de departamentos</h5>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle['departamentos'] as $dep): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dep['departamento']); ?></td>
                                <td><?php echo htmlspecialchars($dep['from_date']); ?></td>
                                <td><?php echo $dep['to_date'] === '9999-01-01' ? 'Actual' : htmlspecialchars($dep['to_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h5>Histórico de puestos</h5>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle['puestos'] as $puesto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($puesto['puesto']); ?></td>
                                <td><?php echo htmlspecialchars($puesto['from_date']); ?></td>
                                <td><?php echo $puesto['to_date'] === '9999-01-01' ? 'Actual' : htmlspecialchars($puesto['to_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h5>Histórico de salarios</h5>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Salario</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle['salarios'] as $salario): ?>
                            <tr>
                                <td>$<?php echo number_format($salario['salario']); ?></td>
                                <td><?php echo htmlspecialchars($salario['from_date']); ?></td>
                                <td><?php echo $salario['to_date'] === '9999-01-01' ? 'Actual' : htmlspecialchars($salario['to_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif ($termino !== ''): ?>

        <?php if (empty($resultados)): ?>
            <p class="text-muted">No se encontraron empleados que coincidan con "<?php echo htmlspecialchars($termino); ?>".</p>
        <?php else: ?>
            <p class="text-muted"><?php echo count($resultados); ?> resultado(s) encontrado(s).</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Empleado</th>
                        <th>Nombre</th>
                        <th>Departamento actual</th>
                        <th>Puesto actual</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $r): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['emp_no']); ?></td>
                            <td><?php echo htmlspecialchars($r['first_name'] . ' ' . $r['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($r['departamento_actual'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($r['puesto_actual'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="?buscar=<?php echo urlencode($termino); ?>&emp_no=<?php echo $r['emp_no']; ?>"
                                    class="btn btn-sm btn-outline-primary">Ver detalle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    <?php endif; ?>
</div>
