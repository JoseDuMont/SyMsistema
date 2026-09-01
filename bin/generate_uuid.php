<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Services\UuidService;

echo UuidService::generate();
