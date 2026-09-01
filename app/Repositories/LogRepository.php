<?php

namespace App\Repositories;

use PDO;
use PDOException;

class LogRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Inserta un registro en la tabla logs.
     */
    public function create(array $log): bool
    {
        $sql = "
            INSERT INTO logs (
                uuid,
                request_id,
                session_id,
                level,
                module,
                event,
                message,
                collaborator_id,
                entity_type,
                entity_uuid,
                entity_name,
                ip,
                method,
                uri,
                user_agent,
                execution_ms,
                metadata_json,
                stack_trace
            )
            VALUES (
                :uuid,
                :request_id,
                :session_id,
                :level,
                :module,
                :event,
                :message,
                :collaborator_id,
                :entity_type,
                :entity_uuid,
                :entity_name,
                :ip,
                :method,
                :uri,
                :user_agent,
                :execution_ms,
                :metadata_json,
                :stack_trace
            )
        ";

        try {

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ':uuid'           => $log['uuid'],
                ':request_id'     => $log['request_id'] ?? null,
                ':session_id'     => $log['session_id'] ?? null,
                ':level'          => $log['level'],
                ':module'         => $log['module'],
                ':event'          => $log['event'],
                ':message'        => $log['message'] ?? null,
                ':collaborator_id'        => $log['collaborator_id'] ?? null,
                ':entity_type'    => $log['entity_type'] ?? null,
                ':entity_uuid'    => $log['entity_uuid'] ?? null,
                ':entity_name'    => $log['entity_name'] ?? null,
                ':ip'             => $log['ip'] ?? null,
                ':method'         => $log['method'] ?? null,
                ':uri'            => $log['uri'] ?? null,
                ':user_agent'     => $log['user_agent'] ?? null,
                ':execution_ms'   => $log['execution_ms'] ?? null,
                ':metadata_json'  => $log['metadata_json'] ?? null,
                ':stack_trace'      => $log['stack_trace'] ?? null,
            ]);

        } catch (PDOException $e) {

            throw $e;

        }
    }

    /**
     * Obtiene logs posteriores a un ID determinado.
     *
     * Se utiliza para la actualización incremental
     * del panel de auditoría.
     */
    public function findAfter(int $lastId = 0, int $limit = 50): array
    {
        $sql = "
            SELECT
                id,
                uuid,
                level,
                module,
                event,
                message,
                collaborator_id,
                entity_type,
                entity_uuid,
                request_id,
                method,
                uri,
                ip,
                user_agent,
                execution_ms,
                created_at
            FROM logs
            WHERE id > :last_id
            ORDER BY id ASC
            LIMIT :limit
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':last_id', $lastId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
