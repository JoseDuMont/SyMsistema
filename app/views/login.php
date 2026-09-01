<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Iniciar sesión</h2>

<?php if(!empty($error)): ?>
<p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (isset($_GET['expired'])): ?>

<p>
Tu sesión expiró por inactividad.
</p>

<?php endif; ?>

<form method="POST">

    <input
        type="text"
        name="username"
        placeholder="Usuario"
        required
    >

    <input
        type="password"
        name="password"
        placeholder="Contraseña"
        required
    >

    <button type="submit">
        Entrar
    </button>

</form>

</body>
</html>
