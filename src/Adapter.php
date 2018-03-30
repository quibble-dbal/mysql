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
    public function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
    {
        return parent::__construct("mysql:$dsn", $username, $password, $options);
    }

    public function value($value)
    {
        if (is_bool($value)) {
            return $value ? 1 : 0;
        }
        return parent::value($value);
    }

    /**
     * @return Quibble\Dabble\Raw
     */
    public function now() : Dabble\Raw
    {
        return new Dabble\Raw('NOW()');
    }

    /**
     * @return Quibble\Dabble\Raw
     */
    public function interval($quantity, $amount) : Dabble\Raw
    {
        $what = null;
        switch ($quantity) {
            case self::SECOND: $what = 'second'; break;
            case self::MINUTE: $what = 'minute'; break;
            case self::HOUR: $what = 'hour'; break;
            case self::DAY: $what = 'day'; break;
            case self::WEEK: $what = 'week'; break;
            case self::MONTH: $what = 'month'; break;
            case self::YEAR: $what = 'year'; break;
        }
        return new Dabble\Raw(sprintf("interval %d %s", $amount, $what));
    }

    /**
     * @return Quibble\Dabble\Raw
     */
    public function random() : Dabble\Raw
    {
        return new Dabble\Raw('RAND()');
    }
}

