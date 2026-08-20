<div class="flex-grow-1 p-4 d-flex flex-column align-items-center">
    <h1>Evolución de contrataciones por año y género.</h1>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Año</th>
                <th scope="col">Género</th>
                <th scope="col">Total de contrataciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evolucion as $row): ?>
                <tr>
                    <td><?php echo $row['anio']; ?></td>
                    <td><?php echo $row['genero']; ?></td>
                    <td><?php echo $row['total_contrataciones']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>