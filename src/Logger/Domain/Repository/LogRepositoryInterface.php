<?php

namespace App\Logger\Domain\Repository;

use App\Logger\Domain\Entity\Log;

interface LogRepositoryInterface 
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(Log $log) : void;
}