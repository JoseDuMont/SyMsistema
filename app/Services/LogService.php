<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService
{
    private LogRepository $repository;

    public function __construct(\PDO $pdo)
    {
        $this->repository = new LogRepository($pdo);
    }

    public function info(
        string $module,
        string $event,
        string $message,
        ?int $userId = null,
        ?string $entityType = null,
        ?string $entityUuid = null,
        ?string $entityName = null
    ): bool {

        $log = [

            'uuid' => UuidService::generate(),

            'request_id' => RequestContext::requestId(),
            
            'session_id' => session_id() ?: null,

            'level' => 'info',

            'module' => $module,

            'event' => $event,

            'message' => $message,

            'collaborator_id' => $userId,

            'entity_type' => $entityType,

            'entity_uuid' => $entityUuid,

            'entity_name' => $entityName,

            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'CLI',

            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',

            'uri' => $_SERVER['REQUEST_URI'] ?? 'CLI',

            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'CLI',

            'execution_ms' => RequestContext::executionTime(),
            
            'metadata_json' => null,

            'stack_trace' => null,
        ];

        return $this->repository->create($log);
    }
}
