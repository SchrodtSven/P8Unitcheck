<?php

declare(strict_types=1);
/**
 *  Class transforming textual content:
 *  - case
 *  - colour <-> non colour
 *  - code parts  
 *  - naming conventions (snake_named, camelCased, UpperFirstCamelCase, "'spaced', 'quoted', 'and', 'comma', 'separated'")
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-19
 */

namespace P8UnitCheck\Data; 
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Shell\Cli;

class TextTransformer
{

    private ListType $find;
    private ListType $replace;
    private Cli $cli; 
    private TextTransformer $textTransformer;
    
    public function __construct()
    {
        $this->_init();
    }

    public function colourize(string $message): string
    {
           return (string) (new StringType($message))
                    ->replaceMultiple(
                        $this->find->getContent(),
                        $this->replace->getContent()
                    );
    }

    private function _init(): void
    {
        $this->find = new ListType(['Failed', 'failed', 'failure', 'Failure', 'successfull', 'success', 'Success']);
        $this->cli = new cli();
        $this->replace = new ListType(
            [
                $this->cli->getColouredString('Failed', 'white', 'red'),
                $this->cli->getColouredString('failed', 'white', 'red'),
                $this->cli->getColouredString('failure', 'white', 'red'),
                $this->cli->getColouredString('Failure', 'white', 'red'),
                $this->cli->getColouredString('successfull', null, 'green'),
                $this->cli->getColouredString('success', null, 'green'),
                $this->cli->getColouredString('Success', null, 'green')
            ]
        );


       


        
       

    }
}