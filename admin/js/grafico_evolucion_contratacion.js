fetch('evolucion_contrataciones_grafico.php?accion=json')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('graficoEvolucion').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    { label: data.datasets[0].label, data: data.datasets[0].data, backgroundColor: '#6a9bec' },
                    { label: data.datasets[1].label, data: data.datasets[1].data, backgroundColor: '#d166d1' }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: { stacked: true, title: { display: true, text: 'Año' } },
                    y: { stacked: true, title: { display: true, text: 'Número de contrataciones' } }
                }
            }
        });
    });