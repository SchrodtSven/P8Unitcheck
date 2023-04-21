<?php

declare(strict_types=1);
/**
 *  Inspecting (reverse engineering) existing application code via PHP's Reflection API:
 *  - getting attributes
 *  - getting test methods
 *  - ....
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-14
 */

namespace P8UnitCheck\Kernel;

use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Kernel\Config\Application;
use P8UnitCheck\Entity\Config;

class ReverseEngineer
{
    protected FoundationCheck $checkInstance;

    protected ListType $methods;

    protected ListType $checkMethods;
    
    public function __construct(private string $fullpath, private Config $config)
    {
        require_once $this->fullpath;
       $file = new StringType((new StringType($fullpath))->splitBy(\DIRECTORY_SEPARATOR)->pop());
        $file->replace(Application::CHECK_FILE_SUFFIX);
        $class = (string) $file;
        $this->checkInstance = new $class($this->config);
        $this->methods = new ListType ([]);
        $this->checkMethods = new ListType ([]);
        $this->extractFunctionNamesFromTestClass();
    }

    protected function extractFunctionNamesFromTestClass(): void
    {
        foreach( (new \ReflectionClass($this->checkInstance::class))->getMethods() as $item) {
            if(isset($item->name)) {
                $this->methods->push($item->name);
            }

            if(str_starts_with($item->name, Application::CHECK_METHOD_PREFIX)) {
                $this->checkMethods->push($item->name);
            }
        }
    }


    public function hasDataProvider(ReflectionMethod $method)
    {
        
    }
    


    /**
     * Get the value of checkInstance
     *
     * @return FoundationTest
     */
    public function getCheckInstance(): FoundationCheck
    {
        return $this->checkInstance;
    }

    /**
     * Set the value of checkInstance
     *
     * @param FoundationTest $checkInstance
     *
     * @return self
     */
    public function setCheckInstance(FoundationTest $checkInstance): self
    {
        $this->checkInstance = $checkInstance;

        return $this;
    }

    /**
     * Get the value of checkMethods
     *
     * @return ListType
     */
    public function getCheckMethods(): ListType
    {
        return $this->checkMethods;
    }

    /**
     * Set the value of checkMethods
     *
     * @param ListType $checkMethods
     *
     * @return self
     */
    public function setCheckMethods(ListType $checkMethods): self
    {
        $this->checkMethods = $checkMethods;

        return $this;
    }
}