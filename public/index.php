<?php
declare (strict_types = 1);

//echo '<pre>';

// Set project root as current working directory
//chdir('../');
require_once 'src/P8UnitCheck/Autoload.php';

//var_dump(file_get_contents('src/P8UnitCheck/Kernel/Tools/Tpl/FileHeadDocBlock.php'));die;

use P8UnitCheck\Entity\Config;
use P8UnitCheck\Entity\Message;
use P8UnitCheck\Kernel\Config\Messages;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Data\TextTransformer;
use P8UnitCheck\Kernel\Tools\TplParser;
use P8UnitCheck\Kernel\Tools\ClassMapper;

/*
$e = new TplParser('FileHeadDocBlock'); 
$e->DESCRIPT =' Cool features implementing class';
$e->LONG =' Cool features implementing class lorem Ipsum foo bar bar ....';
$e->SUPERLONG = ' Cool features implementing class lorem Ipsum foo bar bar .... FOO BAR jsdieowb  ehf eufhwei o';
$e->DATE = (new \DateTime)->format('Y-m-d');
echo $e;
*/

$foo = new ClassMapper();
echo $foo->writeFile();

