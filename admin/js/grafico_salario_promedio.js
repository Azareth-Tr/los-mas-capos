fetch('salario_promedio_grafico.php?accion=json')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('graficoSalarioPromedio').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: data.datasets[0].label,
                    data: data.datasets[0].data, 
                    backgroundColor: '#6a9bec',
                    borderColor: '#4b75c4',
                    borderWidth: 1
                }]
            },
            options: {
                animation: false,
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: { display: true, text: 'Salario Promedio' }
                    },
                    y: {
                        title: { display: true, text: 'Departamentos' }
                    }
                }
            }
        });
    });
