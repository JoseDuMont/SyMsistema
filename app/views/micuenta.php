<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>
Bienvenido <?= htmlspecialchars($_SESSION['collaborator']) ?>
</h1>

<p>
Sistema Cliente funcionando
</p>

<p>
Último acceso:
<?= htmlspecialchars($_SESSION['last_login'] ?? 'N/A') ?>
</p>

<p>
IP actual:
<?= htmlspecialchars($_SESSION['last_ip'] ?? 'N/D') ?>
</p>

<p>
Navegador:
<?= htmlspecialchars($_SESSION['user_agent'] ?? 'N/D') ?>
</p>

<a href="/logout">
Cerrar sesión
</a>

</body>
</html>
