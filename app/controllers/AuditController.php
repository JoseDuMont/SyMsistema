<?php

require_once __DIR__ . '/../config/database.php';

use App\Repositories\LogRepository;

header('Content-Type: application/json; charset=utf-8');

/**
 * ==========================
 * AUTENTICACIÓN
 * ==========================
 */

if (!isset($_SESSION['user_id'])) {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'error' => 'No autenticado'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * ==========================
 * AUTORIZACIÓN
 * ==========================
 *
 * nivel0 = Administrador
 * nivel2 = Programador
 */

if (!in_array($_SESSION['role'] ?? null, ['nivel0', 'nivel2'], true)) {

    http_response_code(403);

    echo json_encode([
        'success' => false,
        'error' => 'Acceso no autorizado'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * ==========================
 * PARÁMETROS
 * ==========================
 */

$lastId = filter_input(
    INPUT_GET,
    'after',
    FILTER_VALIDATE_INT
);

$lastId = ($lastId !== false && $lastId !== null)
    ? max(0, $lastId)
    : 0;

$limit = filter_input(
    INPUT_GET,
    'limit',
    FILTER_VALIDATE_INT
);

$limit = ($limit !== false && $limit !== null)
    ? min(max($limit, 1), 100)
    : 50;

/**
 * ==========================
 * CONSULTA
 * ==========================
 */

$repository = new LogRepository($pdo);

$logs = $repository->findAfter($lastId, $limit);

/**
 * ==========================
 * RESPUESTA
 * ==========================
 */

echo json_encode([
    'success' => true,
    'data' => $logs
], JSON_UNESCAPED_UNICODE);
