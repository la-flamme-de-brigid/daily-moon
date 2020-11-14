<?php
declare(strict_types=1);

namespace Tests\Support;

use Doctrine\DBAL\Connection;

class DatabaseConnection
{
    /** @var Connection */
    private $dbalConnection;

    public function __construct(Connection $dbalConnecion)
    {
        $this->dbalConnection = $dbalConnecion;
    }

    public function deleteBgColorOption()
    {
        $this->dbalConnection->createQueryBuilder()
            ->delete('wp_options')
            ->where('option_name = ?')
            ->setParameter(0, 'daily-moon-background-color')
            ->execute();
    }

    public function getBackgroundColor()
    {
        $return = $this->dbalConnection->createQueryBuilder()
            ->select('option_value')
            ->from('wp_options')
            ->where('option_name = ?')
            ->setParameter(0, 'daily-moon-background-color')
            ->execute()
            ->fetch();

        return $return['option_value'];
    }

    public function getImageModelOption()
    {
        $return = $this->dbalConnection->createQueryBuilder()
            ->select('option_value')
            ->from('wp_options')
            ->where('option_name = ?')
            ->setParameter(0, 'daily-moon-image-model')
            ->execute()
            ->fetch();

        return intval($return['option_value']);
    }

    public function getLanguage()
    {
        $return = $this->dbalConnection->createQueryBuilder()
            ->select('option_value')
            ->from('wp_options')
            ->where('option_name = ?')
            ->setParameter(0, 'daily-moon-language')
            ->execute()
            ->fetch();

        return $return['option_value'];
    }
}
