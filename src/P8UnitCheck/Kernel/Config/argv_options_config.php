<?php


declare(strict_types=1);
/**
 *  Class representing base configuration defaults - may be overwritten at run time
 *  within check classes:
 *  <code>
 *  public function testFoo(): void
 *  {
 *      $this->config->setColourize(false)
 *  }
 *  </code>
 *  or via cli arguments (e.g: <samp>./unitcheck.php --verbose --haltonerror=true --colours=false</samp>)
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
