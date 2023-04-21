<?php

declare (strict_types = 1);

//chdir('../');
require_once 'src/P8UnitCheck/Autoload.php';
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;

$data = [
    'straight single quote' => "'",
    
    'straight double quote' => '"',

    'opening double quote'	=> '“', 
	'closing double quote' => '”',
    
    'opening single quote' => '‘',
    'closing single quote' => '’'
];

$lines = new ListType();
foreach ($data as $key => $value) {
    $name = (new StringType($key))->replace(' ', '_')->toUpper();
    $const = new StringType('    public const ');
    $const->append((string) $name . ' = ')
          ->append((new StringType($value))->quote());
            
        $lines->push($const);


}

echo $lines->join(';' .     PHP_EOL);