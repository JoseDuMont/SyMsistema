<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/database.php';

use App\Services\UuidService;

$config = require __DIR__ . '/../storage/storage.php';

$root = rtrim($config['storage_root'], '/');

echo "Iniciando escaneo de archivos...<br><br>";

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(
        $root,
        FilesystemIterator::SKIP_DOTS
    )
);

foreach ($iterator as $item) {

    if (!$item->isFile()) {
        continue;
    }

    $fullPath = $item->getPathname();

    $relativePath = str_replace(
        $root . '/',
        '',
        $fullPath
    );

    $name = basename($relativePath);

    $folderPath = dirname($relativePath);

    /*
     * Buscar folder_id
     */

    $stmt = $pdo->prepare("
        SELECT id
        FROM folders
        WHERE real_path = ?
        LIMIT 1
    ");

    $stmt->execute([$folderPath]);

    $folder = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$folder) {

        echo "[ERROR] Carpeta no encontrada: {$folderPath}<br>";

        continue;
    }

    $folderId = $folder['id'];

    /*
     * Datos básicos
     */

    $extension = strtolower(
        pathinfo($name, PATHINFO_EXTENSION)
    );

    $size = filesize($fullPath);
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $mimeType = finfo_file(
        $finfo,
        $fullPath
    );

finfo_close($finfo);



    /*
     * ¿Ya existe?
     */

    $stmt = $pdo->prepare("
        SELECT id,file_size
        FROM files
        WHERE real_path = ?
        LIMIT 1
    ");

    $stmt->execute([$relativePath]);

    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    /*
     * INSERT
     */

    if (!$file) {
    
        $uuid = UuidService::generate();

        $insert = $pdo->prepare("
            INSERT INTO files (
                uuid,
                folder_id,
                filename,
                real_path,
                extension,
                mime_type,
                file_size,
                created_at,
                indexed_at
            )
            VALUES (
                ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
            )
        ");

        $insert->execute([
            $uuid,
            $folderId,
            $name,
            $relativePath,
            $extension,
            $mimeType,
            $size,
            
        ]);

        echo "[INSERTADO] {$relativePath}<br>";

        continue;
    }

    /*
     * UPDATE
     */

    if (
        $file['file_size'] != $size
    ) {

        $update = $pdo->prepare("
            UPDATE files
            SET
                folder_id = ?,
                file_size = ?,
                modified_at = NOW()
            WHERE id = ?
        ");

        $update->execute([
            $folderId,
            $size,
            $file['id']
        ]);

        echo "[ACTUALIZADO] {$relativePath}<br>";

        continue;
    }

    echo "[OK] {$relativePath}<br>";
}

echo "<br>Escaneo de archivos finalizado.";
