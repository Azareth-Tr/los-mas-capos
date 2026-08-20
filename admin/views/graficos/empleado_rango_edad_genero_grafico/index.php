<?php
$rangos = ['<30', '30-39', '40-49', '50-59', '>=60'];
$hombres = array_fill_keys($rangos, 0);
$mujeres = array_fill_keys($rangos, 0);

foreach ($distribucion as $fila) {
    if ($fila['genero'] === 'M') {
        $hombres[$fila['rango_edad']] = (int) $fila['total'];
    } else {
        $mujeres[$fila['rango_edad']] = (int) $fila['total'];
    }
}

// Para la pirámide, los hombres se grafican como valores negativos (hacia la izquierda)
$hombresNegativos = array_map(fn($v) => -$v, array_values($hombres));
?>
<div class="flex-grow-1 p-4">
    <h1>Empleados por Rango de Edad y Género</h1>
    <p class="text-muted">Pirámide poblacional de la plantilla activa, calculada contra la fecha de referencia.</p>

    <form method="get" class="row g-2 mb-4">
        <div class="col-auto">
            <label for="fecha_referencia" class="col-form-label">Fecha de referencia:</label>
        </div>
        <div class="col-auto">
            <input type="date" id="fecha_referencia" name="fecha_referencia" class="form-control"
                value="<?php echo htmlspecialchars($fechaReferencia); ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>

    <div style="max-width: 800px;">
        <canvas id="piramidePoblacional"></canvas>
    </div>

    <script>
        const rangos = <?php echo json_encode($rangos); ?>;
        const hombres = <?php echo json_encode($hombresNegativos); ?>;
        const mujeres = <?php echo json_encode(array_values($mujeres)); ?>;

        new Chart(document.getElementById('piramidePoblacional'), {
            type: 'bar',
            data: {
                labels: rangos,
                datasets: [
                    {
                        label: 'Hombres',
                        data: hombres,
                        backgroundColor: '#0d6efd'
                    },
                    {
                        label: 'Mujeres',
                        data: mujeres,
                        backgroundColor: '#d63384'
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            callback: (valor) => Math.abs(valor)
                        },
                        title: { display: true, text: 'Número de empleados' }
                    },
                    y: {
                        title: { display: true, text: 'Rango de edad' }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (contexto) => `${contexto.dataset.label}: ${Math.abs(contexto.raw)}`
                        }
                    },
                    title: {
                        display: true,
                        text: 'Pirámide poblacional por rango de edad y género'
                    }
                }
            }
        });
    </script>
</div>
