<?php

declare(strict_types=1);
/**
 * Class helping doing stuff with directories
 *
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-17
 */

namespace P8UnitCheck\File;


class Directory
{
    public function getRecursiveIterator(string $path = '.')
    {
        $directory = new \RecursiveDirectoryIterator($path);
        return new \RecursiveIteratorIterator($directory);
    }

    public function  filterbyClosure(\callable $function): mixed
    {
        return $function($this);
    }

    public function filterByFilter(Filter $filter)
    {

    }

    
}