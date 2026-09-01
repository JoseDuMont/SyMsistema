<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {

    case '/':
        require_once '../app/controllers/HomeController.php';
        break;

    case '/login':
        require_once '../app/controllers/LoginController.php';
        break;

    case '/dashboard':
        require_once '../app/controllers/DashboardController.php';
        break;

    case '/files':
        require_once '../app/views/files.php';
        break;

    case '/logout':
        require_once '../app/controllers/logout.php';
        break;
        
    case '/cursos':
        require_once '../app/controllers/CursosController.php';
        break;
        
    case '/micuenta':
        require_once '../app/controllers/MicuentaController.php';
        break;
        
    case '/api/logs':
        require_once '../app/controllers/AuditController.php';
        break;    
        
    case '/auditoria':
        require_once __DIR__ . '/../app/config/session.php';
        require_once __DIR__ . '/../app/views/auditoria.php';
        break;
        
    case '/docs':
        require_once '../app/controllers/DocsController.php';
        break;

    default:
        http_response_code(404);
        require_once '../app/views/404.php';
}
