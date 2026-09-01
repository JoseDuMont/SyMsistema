<?php

require_once __DIR__ . '/../config/database.php';

use App\Services\LogService;

$logger = new LogService($pdo);

$logger->info(
    module: 'auth',
    event: 'logout',
    message: 'Cierre de sesión.',
    userId: $_SESSION['user_id'] ?? null,
    entityType: 'user',
    entityUuid: $_SESSION['uuid_collaborator'] ?? null,
    entityName: $_SESSION['collaborator'] ?? null
);


/* Vaciar variables de sesión */
$_SESSION = [];


/* Eliminar cookie de sesión si existe */
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}


/* Destruir sesión */
session_destroy();


/* Redirigir al login */
header('Location: /login');
exit;
