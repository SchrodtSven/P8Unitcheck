<?php

declare (strict_types = 1);
/**
 *  Entity class representing Expectations 
 *
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */

namespace P8UnitCheck\Entity;
use P8UnitCheck\Type\HashMapType;

class Expectation
{
    public const RESULT_SUCCESS = 'successfull';
    public const RESULT_FAIL = 'failed';
    public const RESULT_IGNORED = 'ignored'; // -> not complete or leapable on condition

    public const RESULT_SUCCESS_SHORT = 'S';
    public const RESULT_FAIL_SHORT = 'F';
    public const RESULT_IGNORED_SHORT = 'i'; // -> not complete or leapable on condition

    public const ATTRIBUTE_NOT_COMPLETE = 'not complete';
    public const ATTRIBUTE__LEAPABLE = 'leapable';

    public function __construct(private HashMapType $content)
    {
        
    }
}
