<?php

declare(strict_types=1);
/**
 * Checks for P8UnitCheck\Data\TextTransformer
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-20
 */

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;
use P8UnitCheck\Data\TextTransformer;

class TextTransformerCheck extends FoundationCheck
{
    
    public function checkColourizing(): void
    {
        $textTransformer = new TextTransformer();
        $a = $textTransformer->colourize('A failure is not successfull!');
        $b = "A \033[1;37m\033[41mfailure\033[0m is not \033[42m\033[42msuccess\033[0mfull\033[0m!";
       // echo $a . PHP_EOL . $b . PHP_EOL;
        $this->expectTrue($a === $b);
    }
}