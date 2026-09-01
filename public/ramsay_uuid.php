<?php

require '/srv/nginx/symsistema/vendor/autoload.php';
require '/srv/nginx/symsistema/app/services/UuidService.php';

use App\Services\UuidService;

echo "UUID: " . UuidService::generate() . PHP_EOL;
