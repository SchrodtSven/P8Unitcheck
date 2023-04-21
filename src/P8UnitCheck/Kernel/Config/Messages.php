<?php

declare(strict_types=1);

/**
 *  Messages sent while / after running checks on cli or logging in format for *printf() functions
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-19
 */

namespace P8UnitCheck\Kernel\Config;

class Messages
{
    public const FAILED_EXPECTATION_PROLOG = 'Failed expectation that %s';

    public const SUCCESSFULL_EXPECTATION_PROLOG = 'Succces %s';

    public const FAILURE_REASON_X_IS_FALSE = ' %s is false';
    public const FAILURE_REASON_X_IS_TRUE = ' %s is true';

    public const FAILURE_REASON_A_EQUALS_B = ' %s equals %s';
    public const FAILURE_REASON_A_IS_IDENTICAL_B = ' %s is identical to %s';

    public const FAILURE_REASON_INSTANCE_OF = ' %s is instance of %s';

    public const SUMMARY_FAILED_CHECKS = '%u / $%u check%s successfull';
    public const SUMMARY_SUCCESSFULL_CHECKS = '%u / $%u check%s failed';
    

    public function getFailureMessage(string $reason): string
    {
        return sprintf(
            self::FAILED_EXPECTATION_PROLOG, $reason
        );
    }

    public function getSuccessMessage(string $reason): string
    {
        return sprintf(
            self::SUCCESSFULL_EXPECTATION_PROLOG, $reason
        );
    }
}