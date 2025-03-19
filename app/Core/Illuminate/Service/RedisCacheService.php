<?php

namespace App\Core\Illuminate\Service;

use App\Core\Base\Service\CacheServiceInterface;
use Illuminate\Support\Facades\Redis;

class RedisCacheService implements CacheServiceInterface
{
    public function delete(string $key): bool
    {
        return Redis::del($key) > 0;
    }

    public function setNx(string $key, mixed $value): bool
    {
        return Redis::setnx($key, $value);
    }

    function expire(string $key, int $seconds): bool
    {
        return Redis::expire($key, $seconds);
    }
}
