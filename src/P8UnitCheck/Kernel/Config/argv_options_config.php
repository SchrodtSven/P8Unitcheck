<?php


declare(strict_types=1);
/**
 *  Configuring valid cli arguments (short and long options) for main script (unitcheck.php)
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-17
 */
return [
    
    ['v', 'verbose'], // verbose output
    ['V', 'version'], // showing current version and author information 
    ['c:', 'colour:'], // show colours (1) or not (0)

];
