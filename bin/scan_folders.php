<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/config/database.php';

$config = require __DIR__ . '/../storage/storage.php';

use App\Services\UuidService;

$root = rtrim($config['storage_root'], '/');

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(
        $root,
        FilesystemIterator::SKIP_DOTS
    ),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {

    if (!$item->isDir()) {
        continue;
    }

    $fullPath = $item->getPathname();

    $relativePath = str_replace(
        $root . '/',
        '',
        $fullPath
    );

    $name = basename($relativePath);

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

    $stmt = $pdo->prepare("
        SELECT id,parent_folder
        FROM folders
        WHERE real_path = ?
        LIMIT 1
    ");

    $stmt->execute([$relativePath]);

    $folder = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$folder) {

    $uuid = UuidService::generate();

    $insert = $pdo->prepare("
        INSERT INTO folders (
            uuid,
            name_folder,
            parent_folder,
            real_path,
            created_at,
            updated_at
        )
        VALUES (?, ?, ?, ?, NOW(), NOW())
    ");

    $insert->execute([
        $uuid,
        $name,
        $parentId,
        $relativePath
    ]);

    echo "[INSERTADA] {$relativePath}<br>";

    continue;
}

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

    echo "[ACTUALIZADA] {$relativePath}<br>";

    continue;
}

echo "[OK] {$relativePath}<br>";
}

echo "<br>Escaneo de carpetas finalizado.";
