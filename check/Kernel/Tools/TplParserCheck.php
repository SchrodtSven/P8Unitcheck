<?php

declare(strict_types=1);
/**
 * Quick & dirty template parser
 * 
 * 
 * @FIXME -> replace placeholders not used!!!
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-22
 */

use P8UnitCheck\Kernel\Tools\TplParser;
use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;

class TplParserCheck extends FoundationCheck
{
    public function checkFoo(): void
    {
        $parser = new TplParser('FileHeadDocBlock'); 
        $descript = 'Mapping file (and path) resource names to fully qualified (with namespace) class names';
        $date = date('Y-m-d');
        $parser->DESCRIPT =  $descript;
        $parser->DATE = $date;

        $this->expectTrue($parser->DESCRIPT === $descript);
        $this->expectTrue($parser->DATE === $date);

        unset($parser->DATE);

        $this->expectTrue(is_null($parser->DATE));

        $this->expectFalse(isset($parser->DATE));
    }

    
}