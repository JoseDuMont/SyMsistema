<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Eventos</title>
</head>
<body>

<h1>Sistema Eventos</h1>

<p>
Bienvenido <?= htmlspecialchars($_SESSION['collaborator']) ?>
</p>

<hr>

<?php foreach ($clientes as $cliente): ?>

    <div>

        <h2>
            🏢 <?= htmlspecialchars($cliente['nombre']) ?>
        </h2>

        <p>
            <?= $cliente['eventos'] ?> eventos disponibles
        </p>

        <a href="/eventos/cliente/<?= $cliente['id'] ?>">
            Entrar
        </a>

    </div>

    <hr>

<?php endforeach; ?>

<p>
    <a href="/dashboard">
        ← Volver al dashboard
    </a>
</p>

</body>
</html>
