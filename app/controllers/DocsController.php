<?php

require_once __DIR__ . '/../config/auth.php';

use App\Services\LogService;

/**
 * ============================================================
 * CENTRO DOCUMENTAL SDI
 * ============================================================
 */

$docsRoot = dirname(__DIR__, 2) . '/docs';

/**
 * Usuario autenticado
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

/**
 * Nivel del usuario
 */
$role = $_SESSION['role'] ?? 'nivel1';

/**
 * ============================================================
 * DOCUMENTOS DISPONIBLES
 * ============================================================
 *
 * Lista blanca.
 *
 * IMPORTANTE:
 * Nunca utilizamos directamente un parámetro GET
 * para construir una ruta de archivo.
 *
 */

$documents = [

    'Monte Olimpo' => [
        'name' => 'SyM_MonteOlimpo',
        'path' => $docsRoot . '/SyM_MonteOlimpo.md',
        'icon' => '⚡',
        'description' => 'Sistema documental general.',
        'editable' => true,
    ],
    
    'atenea' => [
        'name' => 'SyM_Atenea.md',
        'path' => $docsRoot . '/SyM_Atenea.md',
        'icon' => '🦉',
        'description' => 'Sistema documental para humanos.',
        'editable' => true,
    ],

    'ades' => [
        'name' => 'SyM_Ades.md',
        'path' => $docsRoot . '/SyM_Ades.md',
        'icon' => '🏗️',
        'description' => 'Infraestructura del sistema SDI.',
        'editable' => false,
    ],

    'mnemo-001' => [
        'name' => 'MNEMO-SRC-001.md',
        'path' => $docsRoot . '/mnemosine/MNEMO-SRC-001.md',
        'icon' => '🧠',
        'description' => 'Primer recuerdo de SisMnemosine.',
        'editable' => true,
    ],
    
    'zeus' => [
        'name' => 'SyM Zeus',
        'path' => $docsRoot . '/SyM_Zeus.md',
        'icon' => '⚡',
        'description' => 'Sistema de permisos, seguridad y auditoría de SDI',
        'editable' => false,
    ],
    
    'SyM_Sistema_UI_UX' => [
        'name' => 'SyM_UI_UX',
        'path' => $docsRoot . '/SDI-UX-001_SyM_Sistema_UI_UX_2026-08-18.md',
        'icon' => '⚡',
        'description' => 'Desarrollo de UI y UX',
        'editable' => false,
    ],
    
    'dedalo' => [
        'name' => 'SyM_Dedalo',
        'path' => $docsRoot . '/SyM_Dedalo.md',
        'icon' => '⚡',
        'description' => 'Desarrollo y trabajo con lab de sym',
        'editable' => true,
    ],

];

/**
 * ============================================================
 * DOCUMENTO SELECCIONADO
 * ============================================================
 */

$selected = $_GET['file'] ?? 'atenea';

if (!isset($documents[$selected])) {

    http_response_code(404);

    exit('Documento no encontrado.');
}

$document = $documents[$selected];

$docsFile = $document['path'];

/**
 * ============================================================
 * PERMISOS
 * ============================================================
 */

/**
 * Nivel 0 y nivel 2 pueden modificar Atenea.
 *
 * Los demás documentos permanecen en solo lectura
 * en esta primera versión.
 */
$canEdit = (
    $document['editable'] === true &&
    in_array($role, ['nivel0', 'nivel2'], true)
);

/**
 * ============================================================
 * GUARDAR CAMBIOS
 * ============================================================
 */

$error = null;
$saved = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**
     * Protección adicional:
     * solo se permite modificar documentos marcados
     * explícitamente como editables.
     */
    if (!$canEdit) {

        http_response_code(403);

        exit('Acceso no autorizado.');

    }

    $content = $_POST['content'] ?? '';

    if ($content === '') {

        $error = 'El documento no puede estar vacío.';

    } else {

        if (
            file_put_contents(
                $docsFile,
                $content,
                LOCK_EX
            ) === false
        ) {

            $error = 'No fue posible guardar el documento.';

        } else {

            /**
             * Registrar modificación en auditoría.
             */
            require_once __DIR__ . '/../config/database.php';

            $logService = new LogService($pdo);

            $logService->info(
                'docs',
                'documentation_updated',
                $document['name'] . ' actualizado desde el panel documental',
                $_SESSION['user_id'],
                'document',
                null,
                $document['name']
            );

            /**
             * Redirección para evitar
             * reenvío del formulario.
             */
            header(
                'Location: /docs?file=' .
                urlencode($selected) .
                '&saved=1'
            );

            exit;
        }
    }
}

/**
 * ============================================================
 * LEER DOCUMENTO
 * ============================================================
 */

if (!file_exists($docsFile)) {

    $content =
        '# ' . $document['name'] .
        PHP_EOL . PHP_EOL .
        'Documento todavía no creado.';

} else {

    $content = file_get_contents($docsFile);

}

/**
 * Mensaje de guardado
 */
$saved = isset($_GET['saved']);

/**
 * ============================================================
 * VISTA
 * ============================================================
 */

require __DIR__ . '/../views/docs.php';
