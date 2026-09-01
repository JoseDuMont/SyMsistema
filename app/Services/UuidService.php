<?php

namespace App\Services;

use Ramsey\Uuid\Uuid;

class UuidService
{
    /**
     * Genera un UUID v7.
     */
    public static function generate(): string
    {
        return Uuid::uuid7()->toString();
    }

    /**
     * Valida un UUID.
     */
    public static function isValid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }

    /**
     * Comprueba si es un UUID versión 7.
     */
    public static function isVersion7(string $uuid): bool
    {
        return Uuid::isValid($uuid)
            && Uuid::fromString($uuid)->getVersion() === 7;
    }
}
