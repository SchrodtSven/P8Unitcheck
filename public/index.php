<?php
declare (strict_types = 1);

//echo '<pre>';

// Set project root as current working directory
//chdir('../');
require_once 'src/P8UnitCheck/Autoload.php';
require_once 'check/FirstCheck.php';
use P8UnitCheck\Entity\Config;
use P8UnitCheck\Entity\Message;
use P8UnitCheck\Kernel\Config\Messages;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Data\TextTransformer;



$baz = new TextTransformer();

$foo = new Messages();
$bar = new Message();
echo $foo->getFailureMessage(' is not valid!');
echo PHP_EOL;
echo $baz->colourize('A failure is not successfull!');
echo PHP_EOL;

$a = "A \033[1;37m\033[41mfailure\033[0m is not \033[42m\033[42msuccess\033[0mfull\033[0m!";
echo $a;
foreach(['file', 'line', 'function', 'class', 'type', 'args'] as $item) {
    $tmp = new StringType('    $message->set');
    $tmp->append(ucfirst($item))
       ->append('($parts[\'')
       ->append($item)
       ->append('\']) ?? null;')
       ->append(PHP_EOL);
    echo $tmp;
}


