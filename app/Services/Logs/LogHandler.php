<?php
namespace App\Services\Logs;

use App\Events\LogMonologEvent;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LogHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }
    protected function write(array $record)
    {
        event(new LogMonologEvent($record));
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new LogFormatter();
    }
}
