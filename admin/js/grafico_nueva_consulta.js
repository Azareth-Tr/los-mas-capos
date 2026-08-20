fetch('?accion=json')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('graficoHistograma').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Cantidad de empleados',
                    data: data.valores,
                    backgroundColor: '#98333b',
                    barPercentage: 1.0,
                    categoryPercentage: 0.95
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: { display: false }
                },
                scales: {
                    x: {
                        title: { display: true, text: 'Rango de salario' },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        title: { display: true, text: 'Cantidad de empleados' },
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            }
        });
    });