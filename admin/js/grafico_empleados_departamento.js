fetch('numero_empleados_departamento_grafico.php?accion=json')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('graficoEmpleadosDepartamento').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: data.datasets[0].label,
                        data: data.datasets[0].data,
                        backgroundColor: '#6a9bec'
                    }
                ]
            },
            options: {
                animation: false,
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: { title: { display: true, text: 'Departamento' } },
                    y: { title: { display: true, text: 'Número de empleados' }, beginAtZero: true }
                }
            }
        });
    });