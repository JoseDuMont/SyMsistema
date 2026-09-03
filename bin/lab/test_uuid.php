<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Services\UuidService;

echo "UUID: " . UuidService::generate() . PHP_EOL;
