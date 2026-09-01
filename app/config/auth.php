<?php

require_once __DIR__ . '/database.php';

function login($username, $password)
{
    global $pdo;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE collaborator = ?
        AND activo = 1
        LIMIT 1
    ");

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password_hash'])) {
    return false;
}

$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

$stmt = $pdo->prepare("
    UPDATE users
    SET
        last_login = NOW(),
        last_ip = ?,
        last_user_agent = ?
    WHERE id = ?
");

$stmt->execute([
    $ip,
    $userAgent,
    $user['id']
]);

session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['collaborator'] = $user['collaborator'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['last_ip'] = $ip;
    $_SESSION['user_agent'] = $userAgent;
    $_SESSION['uuid_collaborator'] = $user['uuid_collaborator'];

    return true;
}
