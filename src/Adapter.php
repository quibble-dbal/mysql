<?php

/**
 * Database abstraction layer for MySQL.
 *
 * @package Quibble\Mysql
 * @author Marijn Ophorst <marijn@monomelodies.nl>
 * @copyright MonoMelodies 2008, 2009, 2010, 2011, 2012, 2015, 2016, 2018
 */

namespace Quibble\Mysql;

use Quibble\Dabble;

/** MySQL-abstraction class. */
class Adapter extends Dabble\Adapter
{
    public function __construct(string $dsn, ?string $username = null, ?string $password = null, array $options = [])
    {
        return parent::__construct("mysql:$dsn", $username, $password, $options);
    }

    /**
     * @return string
     */
    public function now() : string
    {
        return 'NOW()';
    }

    /**
     * @param string $unit
     * @param int $amount
     * @return string
     */
    public function interval(string $unit, int $amount) : string
    {
        return sprintf("interval %d %s", $amount, $unit);
    }

    /**
     * @return string
     */
    public function random() : string
    {
        return 'RAND()';
    }
}

