<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * 🔒 Middleware de autenticación
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

/**
 * 🧠 Opcional (recomendado)
 * evita sesiones huérfanas en cambios de login/logout
 */
if (!isset($_SESSION['collaborator'])) {
    session_destroy();
    header('Location: /login');
    exit;
}

/**
 * Tiempo máximo de inactividad
 * 30 minutos
 */
define('SESSION_TIMEOUT', 1800);

/**
 * Usuario no autenticado
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

/**
 * Verificar inactividad
 */
if (
    isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT
) {

    session_unset();
    session_destroy();

    header('Location: /login?expired=1');
    exit;
}

/**
 * Actualizar actividad
 */
$_SESSION['last_activity'] = time();
