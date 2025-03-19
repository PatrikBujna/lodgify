<?php
namespace App\Core\Illuminate\Service;

use App\Core\Base\Service\QueueServiceInterface;
use Illuminate\Contracts\Bus\Dispatcher;

class QueueService implements QueueServiceInterface
{
    protected Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch($job)
    {
        return $this->dispatcher->dispatch($job);
    }
}
