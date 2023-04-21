#!/usr/bin/env php 
<?php

declare(strict_types=1);
/**
 *  Main script loading check unit(s) and running all check (test) methods
 * wqithin each check case
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */

if (version_compare(PHP_VERSION, '8.2.0', '<')) {
    echo 'P8UnitCheck runs on PHP 8.2+ - version found: ' . PHP_VERSION . "\n";
    exit(129);
}

require_once 'src/P8UnitCheck/Autoload.php';
use P8UnitCheck\Kernel\Runner;
use P8UnitCheck\Entity\Config;
use P8UnitCheck\Shell\Parser; 

(new Runner(
    new Parser(),
    new Config() 
    )
);

 
