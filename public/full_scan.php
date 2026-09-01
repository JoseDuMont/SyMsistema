<?php

$config = require __DIR__ . '/../storage/storage.php';

require_once __DIR__ . '/../app/config/database.php';

$root = rtrim($config['storage_root'], '/');

echo "Iniciando Full Scan...\n";
echo "Raíz: {$root}\n\n";

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(
        $root,
        FilesystemIterator::SKIP_DOTS
    ),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {

    // Solo carpetas
    if (!$item->isDir()) {
        
    }
    
    // Ruta completa
    $fullPath = $item->getPathname();

    // Ruta relativa
    $relativePath = str_replace(
        $root . '/',
        '',
        $fullPath
    );
     // Nombre de carpeta
    $name = basename($relativePath);
    
    /*
     * Calcular parent_id
     */

    $parentPath = dirname($relativePath);

    $parentId = null;

    if ($parentPath !== '.') {

        $stmt = $pdo->prepare("
            SELECT id
            FROM folders
            WHERE real_path = ?
            LIMIT 1
        ");

        $stmt->execute([$parentPath]);

        $parent = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($parent) {
            $parentId = $parent['id'] ?? null;
        }
    }


    // Verificar si ya existe
    $stmt = $pdo->prepare("
        SELECT id, parent_folder
        FROM folders
        WHERE real_path = ?
        LIMIT 1
    ");

    $stmt->execute([$relativePath]);

    $folder = $stmt->fetch(PDO::FETCH_ASSOC);

/*
     * INSERT
     */

    if (!$folder) {

    // Insertar nueva carpeta
    $insert = $pdo->prepare("
        INSERT INTO folders (
            name_folder,
            parent_folder,
            real_path,
            created_at,
            updated_at
        )
        VALUES (?, ?, ?, NOW(), NOW())
    ");
        $insert->execute([
            $name,
            $parentId,
            $relativePath
        ]);

        echo "[INSERTADA] {$relativePath}\n";
    

    }

/*
     * UPDATE parent_id si cambió
     */

    if ($folder['parent_folder'] != $parentId) {

        $update = $pdo->prepare("
            UPDATE folders
            SET parent_folder = ?,
                updated_at = NOW()
            WHERE id = ?
        ");

        $update->execute([
            $parentId,
            $folder['id']
        ]);

        echo "[ACTUALIZADA] {$relativePath}\n";

    }

    echo "[OK] {$relativePath}\n";
    
    // Solo files
    if ($item->isFile()) {

    // Nombre del archivo
    $name = basename($relativePath);
    
    // Carpeta contenedora
    $folderPath = dirname($relativePath);

    // Buscar folder_id
    $stmt = $pdo->prepare("
        SELECT id
        FROM folders
        WHERE real_path = ?
        LIMIT 1
    ");

    $stmt->execute([$folderPath]);

    $folder = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$folder) {
        echo "[ERROR] Carpeta no encontrada: {$folderPath}\n";

    }

    $folderId = $folder['id'] ?? null;

    // Extensión
    $extension = strtolower(
        pathinfo($name, PATHINFO_EXTENSION)
    );

    // Tamaño
    $size = filesize($fullPath);

    // ¿Ya existe?
    $stmt = $pdo->prepare("
        SELECT id, file_size
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

        $insert = $pdo->prepare("
            INSERT INTO files (
                folder_id,	
                filename,
                real_path,
                extension,
                file_size,
                indexed_at,
                modified_at
            )
            VALUES (
                ?, ?, ?, ?, ?, NOW(), NOW()
            )
        ");

        $insert->execute([
            $folderId,
            $name,
            $relativePath,
            $extension,
            $size
        ]);

        echo "[FILE INSERTADO] {$relativePath}\n";

    }

    /*
     * UPDATE si cambió el tamaño o carpeta
     */
    if (
        $file['file_size'] != $size
    ) {

        $update = $pdo->prepare("
            UPDATE files
            SET
                folder_id = ?,
                file_size = ?,
                modified_at  = NOW()
            WHERE id = ?
        ");

        $update->execute([
            $folderId,
            $size,
            $file['id']
        ]);

        echo "[FILE ACTUALIZADO] {$relativePath}\n";

        
    }

    echo "[FILE OK] {$relativePath}\n";

    continue;
    }
}
