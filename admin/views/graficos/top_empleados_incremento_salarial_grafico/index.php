<style>
.top-container {
    max-width: 700px;
    margin: 20px auto;
}

.top-header {
    margin-bottom: 16px;
    text-align: center;
}

.top-header h1 {
    font-size: 24px;
    margin: 0 0 20px;
}

.top-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.top-controls input {
    width: 50px;
    padding: 4px;
}

.top-controls button {
    padding: 5px 12px;
    cursor: pointer;
}

.empleado-row {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.empleado-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 4px;
    font-size: 13px;
}

.empleado-nombre {
    font-weight: bold;
}

.empleado-detalle {
    color: #666;
}

.progress-track {
    background: #e0e0e0;
    height: 26px;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #549b64;
    color: white;
    font-size: 11px;
    text-align: right;
    padding-right: 6px;
    box-sizing: border-box;
    line-height: 26px;
}
</style>

<div class="top-container">
    <div class="top-header">
        <h1>Top empleados: mayor incremento salarial</h1>
        <div class="top-controls">
            <label for="cantidad">Mostrar:</label>
            <input type="number" id="cantidad" value="10" min="1" max="50">
            <button onclick="cargarTabla()">Actualizar</button>
        </div>
    </div>

    <div id="listaEmpleados">Cargando datos...</div>
</div>

<script src="/los-mas-capos/admin/js/grafico_top_incremento_salarial.js?v=<?php echo time(); ?>"></script>