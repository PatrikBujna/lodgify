<?php

namespace App\Core\Base\Service;

interface CacheServiceInterface
{
    public function delete(string $key): bool;

    public function setNx(string $key, mixed $value): bool;

    public function expire(string $key, int $seconds): bool;
}
