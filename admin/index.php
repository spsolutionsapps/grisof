<?php
require_once '../config.php';

// Verificar si está logueado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Verificar timeout de sesión
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
    session_destroy();
    header('Location: login.php');
    exit;
}
$_SESSION['last_activity'] = time();

// Obtener consultas
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Contar consultas no leídas
    $stmt = $conn->query("SELECT COUNT(*) as total FROM consultas WHERE leida = 0");
    $noLeidas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Obtener todas las consultas ordenadas por fecha descendente
    $stmt = $conn->query("SELECT * FROM consultas ORDER BY fecha_creacion DESC");
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Error al conectar con la base de datos: " . $e->getMessage();
    $consultas = [];
    $noLeidas = 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Consultas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        .header {
            background: #4f46e5;
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header h1 {
            font-size: 1.5rem;
        }
        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .badge {
            background: #ef4444;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: #4f46e5;
        }
        .consultas-table {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f9fafb;
        }
        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:hover {
            background: #f9fafb;
        }
        .no-leida {
            font-weight: 600;
        }
        .leida {
            color: #6b7280;
        }
        .btn-small {
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
        }
        .btn-primary {
            background: #4f46e5;
            color: white;
        }
        .btn-primary:hover {
            background: #4338ca;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .mensaje-cell {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .close {
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }
        .close:hover {
            color: #333;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            table {
                font-size: 0.875rem;
            }
            th, td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Panel de Administración</h1>
        <div class="header-actions">
            <?php if ($noLeidas > 0): ?>
                <span class="badge"><?php echo $noLeidas; ?> nuevas</span>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-secondary">Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total de Consultas</h3>
                <div class="number"><?php echo count($consultas); ?></div>
            </div>
            <div class="stat-card">
                <h3>No Leídas</h3>
                <div class="number"><?php echo $noLeidas; ?></div>
            </div>
        </div>
        
        <div class="consultas-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($consultas)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem; color: #6b7280;">
                                No hay consultas registradas
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($consultas as $consulta): ?>
                            <tr class="<?php echo $consulta['leida'] ? 'leida' : 'no-leida'; ?>">
                                <td><?php echo htmlspecialchars($consulta['id']); ?></td>
                                <td><?php echo htmlspecialchars($consulta['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($consulta['email']); ?></td>
                                <td><?php echo htmlspecialchars($consulta['telefono'] ?: '-'); ?></td>
                                <td class="mensaje-cell"><?php echo htmlspecialchars($consulta['mensaje']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($consulta['fecha_creacion'])); ?></td>
                                <td>
                                    <button onclick="verConsulta(<?php echo htmlspecialchars(json_encode($consulta)); ?>)" class="btn btn-primary btn-small">Ver</button>
                                    <?php if (!$consulta['leida']): ?>
                                        <button onclick="marcarLeida(<?php echo $consulta['id']; ?>)" class="btn btn-secondary btn-small">Marcar leída</button>
                                    <?php endif; ?>
                                    <button onclick="eliminarConsulta(<?php echo $consulta['id']; ?>)" class="btn btn-danger btn-small">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal para ver consulta completa -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Consulta #<span id="modal-id"></span></h2>
                <span class="close" onclick="cerrarModal()">&times;</span>
            </div>
            <div id="modal-body"></div>
        </div>
    </div>
    
    <script>
        function verConsulta(consulta) {
            document.getElementById('modal-id').textContent = consulta.id;
            document.getElementById('modal-body').innerHTML = `
                <p><strong>Nombre:</strong> ${consulta.nombre}</p>
                <p><strong>Email:</strong> ${consulta.email}</p>
                <p><strong>Teléfono:</strong> ${consulta.telefono || '-'}</p>
                <p><strong>Fecha:</strong> ${new Date(consulta.fecha_creacion).toLocaleString('es-ES')}</p>
                <p><strong>Mensaje:</strong></p>
                <p style="background: #f9fafb; padding: 1rem; border-radius: 0.375rem; margin-top: 0.5rem;">${consulta.mensaje.replace(/\n/g, '<br>')}</p>
            `;
            document.getElementById('modal').classList.add('active');
            
            if (!consulta.leida) {
                marcarLeida(consulta.id, true);
            }
        }
        
        function cerrarModal() {
            document.getElementById('modal').classList.remove('active');
            location.reload();
        }
        
        function marcarLeida(id, silent = false) {
            fetch('marcar_leida.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && !silent) {
                    location.reload();
                }
            });
        }
        
        function eliminarConsulta(id) {
            if (!confirm('¿Estás seguro de eliminar esta consulta?')) {
                return;
            }
            
            fetch('eliminar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al eliminar: ' + (data.message || 'Error desconocido'));
                }
            });
        }
        
        // Cerrar modal al hacer clic fuera
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
</body>
</html>

