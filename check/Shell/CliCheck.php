<?php

declare(strict_types=1);
/**
 * Checks for P8UnitCheck\Shell\Cli
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-20
 */

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;
use P8UnitCheck\Shell\Cli;
class CliCheck extends FoundationCheck
{
    public function checkFooGarn(): void
    {
        $this->expectFalse(2+2 === 2*2);
    }     
}