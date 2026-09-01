<?php

require_once __DIR__ . '/../config/database.php';

use App\Services\LogService;

$logger = new LogService($pdo);

$logger->info(
    module: 'auth',
    event: 'logout',
    message: 'Cierre de sesión.',
    collaboratorId: $_SESSION['user_id'] ?? null,
    entityType: 'user',
    entityUuid: $_SESSION['uuid_collaborator'] ?? null,
    entityName: $_SESSION['collaborator'] ?? null
);

session_unset();
session_destroy();

header("Location: /login");
exit;
