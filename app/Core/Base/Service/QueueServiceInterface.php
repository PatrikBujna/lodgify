<?php

namespace App\Core\Base\Service;

interface QueueServiceInterface
{
    public function dispatch($job);
}
