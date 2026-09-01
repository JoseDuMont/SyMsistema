<?php if (!isset($_SESSION['user_id'])): ?>

    <h1>Bienvenido al Sistema Cliente</h1>

    <p>Sistema privado de gestión de archivos</p>

    <a href="/login">Iniciar sesión</a>

<?php else: ?>

    <h1>Bienvenido <?= htmlspecialchars($_SESSION['collaborator']) ?></h1>

    <p>Rol: <?= htmlspecialchars($_SESSION['role']) ?></p>

    <hr>

    <a href="/dashboard">Ir al dashboard</a><br>
    <a href="/files">Mis archivos</a><br>
    <a href="/docs">Documentación</a><br>
    <a href="/auditoria">Audotoria de SyM sistema</a><br>
    <a href="/logout">Cerrar sesión</a>

<?php endif; ?>
