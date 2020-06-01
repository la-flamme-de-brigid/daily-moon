<?php
declare(strict_types=1);

namespace Tests\Support;

use Doctrine\DBAL\Connection;

class DatabaseConnection
{
    /** @var Connection */
    private $dbalConnecion;

    public function __construct(Connection $dbalConnecion)
    {
        $this->dbalConnecion = $dbalConnecion;
    }
}
