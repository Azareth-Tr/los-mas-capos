<div class="flex-grow-1 p-4">
    <h1>Salario Promedio por Departamento</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Departamento</th>
                <th>Salario Promedio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promedios as $promedio): ?>
                <tr>
                    <td><?php echo htmlspecialchars($promedio['departamento']); ?></td>
                    <td><?php echo htmlspecialchars($promedio['salario_promedio']); ?></td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</div>
