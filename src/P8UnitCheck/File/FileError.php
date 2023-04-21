<?php

declare(strict_types=1);
/**
 * Error thrown in file context
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-20
 */

namespace P8UnitCheck\File;
use P8UnitCheck\Shell\Cli;

class FileError extends \Error
{

    public const CODE_MESSAGE_MATCH = [
        23 => 'Hard disk seems to be %s',
        404 => 'The file resource %s does not exist!',
        666 => '%s The devil is in the details.'
    ];

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $cli = new Cli();
        //@FIXME proofing if code is index of CODE_MESSAGE_MATCH
        //@FIXME check colourizing!!!
        $message = sprintf(self::CODE_MESSAGE_MATCH[$code], $message);
        parent::__construct(
            $message,             
            $code,
            $previous    
        );
    }
    
}