<?php

declare(strict_types=1);
/**
 *  Class representing application setup
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-17
 */
namespace P8UnitCheck\Kernel\Config;

class Application
{

    public const CHECK_CLASS_SUFFIX = 'Check.php';

    public const CHECK_FILE_SUFFIX = '.php';

    public const CHECK_METHOD_PREFIX = 'check';


    //public const TPL_DIRECTORY = 'FileHandDocBlock.php'
    
    public const TOOL_TPL_DIRECTORY = 'src/P8UnitCheck/Kernel/Tools/Tpl/';

    private StringType $shortOptions;

    private ListType $LongOptions;

    public function __construct()
    {
        $this->__init();
    }

    private function __init(): void
    {
        // Defining valid short (-) options
        $short = new ListType(
            [
                'v', // verbose output
                'V', // showing current version and author information 
            ]
        );
        $this->shortOptions = $short->join('');

        // Defining valid long (--) options
        $this->LongOptions = new ListType(
            [
                'verbose', // verbose output
                'version', // showing current version and author information
            ]
        );
    }

    public function getOptionsForGetopt(): array
    {
        return [
            (string) $this->shortOptions,
            $this->LongOptions->getContent()
        ];
    }
}