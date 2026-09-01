<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Services\LogService;

/**
 * Usuario ya autenticado
 */
if (isset($_SESSION['user_id'])) {
    header('Location: /dashboard');
    exit;
}

require_once __DIR__ . '/../config/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (login($username, $password)) {

        $logger = new LogService($pdo);

        $logger->info(
            module: 'auth',
            event: 'login_success',
            message: 'Inicio de sesión exitoso.',
            userId: $_SESSION['user_id'] ?? null,
            entityType: 'user',
            entityUuid: $_SESSION['uuid_collaborator'] ?? null,
            entityName: $_SESSION['collaborator'] ?? null
        );
        /**
         * 🧠 opcional: persistir último login en sesión
         */
        $_SESSION['last_login'] = date('Y-m-d H:i:s');
        
        

        session_write_close();

        header("Location: /dashboard");
        exit;

    } else {
    
    	$logger = new LogService($pdo);

	$logger->info(
    		module: 'auth',
    		event: 'login_failed',
    		message: 'Intento de inicio de sesión fallido.',
    		userId: null,
    		entityType: 'user',
    		entityUuid: null,
    		entityName: $username
	);

        $error = "Credenciales inválidas";
    }
}

require __DIR__ . '/../views/login.php';
