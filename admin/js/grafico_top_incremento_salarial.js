function cargarTabla() {
    const cantidad = document.getElementById('cantidad').value;
    const contenedor = document.getElementById('listaEmpleados');

    contenedor.innerHTML = 'Cargando datos...';

    fetch(`?accion=json&cantidad=${cantidad}`)
        .then(response => response.json())
        .then(data => {
            const puntos = data.puntos;
            const maxIncremento = Math.max(...puntos.map(p => p.incremento));

            contenedor.innerHTML = '';

            puntos.forEach((p, index) => {
                const porcentajeBarra = (p.incremento / maxIncremento) * 100;

                const fila = document.createElement('div');
                fila.className = 'empleado-row';
                fila.innerHTML = `
                    <div class="empleado-info">
                        <span class="empleado-nombre">${index + 1}. ${p.nombre}</span>
                        <span class="empleado-detalle">
                            $${p.salario_min.toLocaleString()} → $${p.salario_max.toLocaleString()} · ${p.anios} años
                        </span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: ${porcentajeBarra}%;">
                            ${p.incremento}%
                        </div>
                    </div>
                `;
                contenedor.appendChild(fila);
            });
        })
        .catch(error => {
            contenedor.innerHTML = 'Error al cargar los datos.';
            console.error(error);
        });
}

cargarTabla();