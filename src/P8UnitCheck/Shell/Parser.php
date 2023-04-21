<?php

namespace P8UnitCheck\Shell;
use P8UnitCheck\Type\ListType;

class Parser
{

    private ListType $options;

    private ListType $checkFiles; 

    /**
     * @FIXME get valid options from Config as instance of Entity\Options!!!
     */
    public function __construct()
    {
        global $argv;
        $shortopts  = "";
        $shortopts .= "f:";  // Required value
        $shortopts .= "v::"; // Optional value
        $shortopts .= "abc"; // These options do not accept values

        $longopts  = array(
            "required:",     // Required value
            "optional::",    // Optional value
            "verbose::",        // No value
            "opt",           // No value
            "::",
            'version'
        );
        $this->options = new ListType(getopt($shortopts, $longopts));
        $this->checkFiles = new ListType($argv);
        
        $this->filterFileNamesFromArgv();
        
    }

    public function filterFileNamesFromArgv(): void
    {
        // shift executed script name ('./unitcheck.php') from list
        $this->checkFiles->shift();

        // filter (skip) options from List
        $this->checkFiles = $this->checkFiles->filter(function($item) {
            if(!\str_starts_with($item, '-')) 
                return true;
            else 
                return false;
        });
    }

    public function getCheckFiles(): ListType
    {
        return $this->checkFiles;
    }

    public function getOptions(): ListType
    {
        return $this->options;
    }
}