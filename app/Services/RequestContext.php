<?php

namespace App\Services;

class RequestContext
{
    private static ?string $requestId = null;

    private static ?int $startedAt = null;

    /**
     * Inicializa el contexto de la petición.
     */
    public static function initialize(): void
    {
        if (self::$requestId !== null) {
            return;
        }

        self::$requestId = UuidService::generate();
        self::$startedAt = hrtime(true);
    }

    /**
     * UUID de la petición actual.
     */
    public static function requestId(): ?string
    {
        return self::$requestId;
    }

    /**
     * Tiempo transcurrido desde que inició la petición.
     */
    public static function executionTime(): float
    {
        if (self::$startedAt === null) {
            return 0;
        }

        return round(
            (hrtime(true) - self::$startedAt) / 1_000_000,
            2
        );
    }
}
