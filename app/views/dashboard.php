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
SyM sistema
</p>

<hr>

<div>

    <h2>Cursos</h2>

    <p>
        Contenido de los cursos.
    </p>

    <a href="/cursos">
        Cursos
    </a>

</div>

<br>

<div>

    <h2>👤 Mi cuenta</h2>

    <p>
        Último acceso:
        <?= htmlspecialchars($_SESSION['last_login'] ?? 'N/A') ?>
    </p>

    </p>

    <a href="/micuenta">
        micuenta
    </a>


</div>

<br>

<a href="/logout">
    Cerrar sesión
</a>

</body>
</html>
