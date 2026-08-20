<div class="flex-grow-1 p-4" style="width: min(1100px, 100%); margin: 0 auto; padding: 24px 16px 40px; text-align: center;">
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
