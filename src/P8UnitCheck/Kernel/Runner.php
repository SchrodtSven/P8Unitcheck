<?php

declare(strict_types=1);

/**
 *  Run existing unit check(s)
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */


namespace P8UnitCheck\Kernel;

ini_set('assert.exception', 1);

use P8UnitCheck\Entity\Config;
use P8UnitCheck\Shell\Parser;

class Runner
{
    private CheckLoader $loader;            
  
    /*** */
    public function __construct(private Parser $parser, private Config $config)
    {
        
         $this->loader = new CheckLoader($parser->getCheckFiles(), $this->config);
        
        // \var_dump($parser->getCheckFiles());die;

        // \var_dump($this->loader->getCheckClasses());die;
         
        foreach($this->loader->getCheckClasses() as $checkClassPath)
        {
           echo 'Running check case file: ' .$checkClassPath . PHP_EOL;
            $this->loader->loadClass($checkClassPath);

        }

        $this->loader->getSummary();
    
    }
}