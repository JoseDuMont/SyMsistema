<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SDI — Auditoría</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        h1 {
            margin-bottom: 5px;
        }

        .estado {
            margin-bottom: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .info {
            color: #0066cc;
        }

        .warning {
            color: #cc8800;
        }

        .error {
            color: #cc0000;
        }

    </style>
</head>

<body>

<h1>SDI — Auditoría</h1>

<div class="estado" id="estado">
    Cargando logs...
</div>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Nivel</th>
            <th>Módulo</th>
            <th>Evento</th>
            <th>Usuario</th>
            <th>Mensaje</th>
        </tr>
    </thead>

    <tbody id="logs">
    </tbody>

</table>


<script>

let lastLogId = 0;


/**
 * Carga los logs desde la API.
 */
async function cargarLogs() {

    try {

        const response = await fetch(
            `/api/logs?after=${lastLogId}`
        );

        const result = await response.json();

        if (!result.success) {

            document.getElementById('estado').textContent =
                result.error;

            return;
        }

        result.data.forEach(log => {

            agregarLog(log);

            lastLogId = Math.max(
                lastLogId,
                Number(log.id)
            );

        });

        document.getElementById('estado').textContent =
            'Auditoría conectada';

    } catch (error) {

        console.error(error);

        document.getElementById('estado').textContent =
            'Error conectando con la auditoría';
    }
}


/**
 * Agrega un log a la tabla.
 */
function agregarLog(log) {

    const tbody = document.getElementById('logs');

    const fila = document.createElement('tr');

    const celdaId = document.createElement('td');
    celdaId.textContent = log.id ?? '';
    fila.appendChild(celdaId);

    const celdaFecha = document.createElement('td');
    celdaFecha.textContent = log.created_at ?? '';
    fila.appendChild(celdaFecha);

    const celdaNivel = document.createElement('td');
    celdaNivel.textContent = log.level ?? '';
    fila.appendChild(celdaNivel);

    if (log.level) {
        celdaNivel.classList.add(log.level);
    }

    const celdaModulo = document.createElement('td');
    celdaModulo.textContent = log.module ?? '';
    fila.appendChild(celdaModulo);

    const celdaEvento = document.createElement('td');
    celdaEvento.textContent = log.event ?? '';
    fila.appendChild(celdaEvento);

    const celdaUsuario = document.createElement('td');
    celdaUsuario.textContent =
        log.collaborator_id ?? 'N/D';
    fila.appendChild(celdaUsuario);

    const celdaMensaje = document.createElement('td');
    celdaMensaje.textContent = log.message ?? '';
    fila.appendChild(celdaMensaje);

    tbody.appendChild(fila);
}
/**
 * Primera carga.
 */
cargarLogs();

setInterval(cargarLogs, 2000);

</script>

</body>
</html>
