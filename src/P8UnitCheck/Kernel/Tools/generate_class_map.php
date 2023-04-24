<?php

declare(strict_types=1);
/**
 *  Generating class map from existing file resources
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-14
 */

require_once 'src/P8UnitCheck/Autoload.php';
use P8UnitCheck\Entity\Config;
use P8UnitCheck\Entity\Message;
use P8UnitCheck\Kernel\Config\Messages;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Data\TextTransformer;
use P8UnitCheck\Kernel\Tools\ClassMapper;



$f = new ClassMapper();
echo $f;




die;
$cwd = 'src/P8UnitCheck';

 

$classes = new ListType();

$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($cwd));
foreach ($iterator as $item) {
    if(\str_ends_with($item->getPathname(), '.php')) {
        $classes->push($item->getPathname());
    } 
}
$classMapList = new ListType();
$classes->walk(function( &$item) use (&$classMapList) {
    $s = new StringType($item);
    $f = $s->splitBy(\DIRECTORY_SEPARATOR); 
    // replacing DIRECTORY SEP
    $g = $s->replace(\DIRECTORY_SEPARATOR, \P8UnitCheck\Autoload::NAMESPACE_SEPARATOR)->replace('.php')->subString(4);
    $classMapList->push($g->quote()->prepend('                ') . ' => ' . (new StringType($item))->quote());
    
    $last = (new StringType($f->pop()))->replace('.php');

    //var_dump($last);
});

echo $classMapList->join(','.PHP_EOL)->prepend('    return [' . PHP_EOL)->append(PHP_EOL . '    ];' . PHP_EOL);