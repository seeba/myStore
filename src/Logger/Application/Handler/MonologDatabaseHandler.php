<?php

namespace App\Logger\Application\Handler;

use App\Logger\Domain\Entity\Log;
use App\Logger\Domain\Repository\LogRepositoryInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class MonologDatabaseHandler extends AbstractProcessingHandler 
{
    public function __construct(
        private LogRepositoryInterface $logRepository)
    {
        parent::__construct();         
    }

    protected function write(LogRecord $record): void
    {
        $log = Log::createLog(
            $record->message,
            $record->context,
            $record->level->value,
            $record->level->toPsrLogLevel(),
            $record->channel,
            $record->extra,
            $record->formatted
        );

        $this->logRepository->save($log);
    }
}