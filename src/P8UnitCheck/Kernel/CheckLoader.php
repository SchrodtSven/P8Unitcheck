<?php

declare(strict_types=1);
/**
 *  Loading check case file(s) and execute each check method
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */


namespace P8UnitCheck\Kernel;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\File\Directory;
use P8UnitCheck\Shell\Cli;
use P8UnitCheck\Kernel\Config\Application;
use P8UnitCheck\Entity\Config;

class CheckLoader
{
  
    private string $checkDirectory = './check';

    private string $currentTest;

    private string $executor;

    private ListType $protocol;

    private ReverseEngineer $inspector;

    private Directory $directory;

    private Cli $cli;

    private int $failure = 0;

    private int $success = 0;

    //@FIXME -> use checks & expectations numbering!!!
    protected int $checks = 0;

    protected int $expectations = 0;

    

    public function __construct(private ListType $checkClasses, private Config $config)
    {
       
        $this->cli = new Cli();
        $this->directory = new Directory($this->checkDirectory);
        $this->protocol = new ListType();
       if($this->checkClasses->count()===0) {
        
       // echo 'IMPLEMENT: run all!';

            $this->getCheckClassesRecursive($this->checkDirectory);

       }
       
    }


    /**
     * Loading 
     * 
     */
    public function loadClass(string $path)
    {
        echo 'FOooooooo' ;\var_dump($path);die;
        $this->inspector = new ReverseEngineer($path, $this->config);
        $checkClass = $this->inspector->getCheckInstance();
        
        foreach($this->inspector->getCheckMethods() as $checkName) {
          //  echo "Running check:  {$checkName}" . PHP_EOL;
            $this->checks++;
            $checkClass->$checkName();
        }

        $this->expectations += $checkClass->getExpectations();
        $this->success += $checkClass->getSuccess();
        $this->failure += $checkClass->getFailure();
        $this->protocol->push($checkClass->getHistory   ());
    }

    public function getCheckClassesRecursive(string $cwd): void
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($cwd));
        foreach ($iterator as $item) {
            if(\str_ends_with($item->getPathname(), Application::CHECK_CLASS_SUFFIX)) {
                $this->checkClasses->push($item->getPathname());
            } 
        }
    }

    /**
     * Get the value of checkClasses
     *
     * @return ListType
     */
    public function getCheckClasses(): ListType
    {
        return $this->checkClasses;
    }

    /**
     * Set the value of checkClasses
     *
     * @param ListType $checkClasses
     *
     * @return self
     */
    public function setCheckClasses(ListType $checkClasses): self
    {
        $this->checkClasses = $checkClasses;

        return $this;
    }

    /**
     * Get the value of failure
     *
     * @return int
     */
    public function getFailure(): int
    {
        return $this->failure;
    }

    /**
     * Get the value of success
     *
     * @return int
     */
    public function getSuccess(): int
    {
        return $this->success;
    }

    /**
     * @FIXME -> Formatting purposes to own class -> format with fixed column width for each line
     */
    public function getSummary()
    {
        echo PHP_EOL . PHP_EOL . $this->cli->getColouredString('                 Summary:', 'white', 'black') . PHP_EOL;
        echo $this->cli->getColouredString((sprintf('               %u checks ', $this->getChecks())), 'black', 'cyan');
        echo PHP_EOL;
        echo $this->cli->getColouredString((sprintf(' %u expectations         ', $this->getExpectations())), 'yellow', 'black');
        echo PHP_EOL;
        if($this->success !==0)
            echo $this->cli->getColouredString(sprintf(' %u successfull', $this->success) ,null , 'green');
        if($this->failure !==0)
            echo $this->cli->getColouredString(sprintf(' %u failed ', $this->failure) ,'white' , 'red') . PHP_EOL;
    }

    /**
     * Get the value of protocol
     *
     * @return ListType
     */
    public function getProtocol(): ListType
    {
        return $this->protocol;
    }

    /**
     * Set the value of protocol
     *
     * @param ListType $protocol
     *
     * @return self
     */
    public function setProtocol(ListType $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Get the value of expectations
     *
     * @return int
     */
    public function getExpectations(): int
    {
        return $this->expectations;
    }

    /**
     * Set the value of expectations
     *
     * @param int $expectations
     *
     * @return self
     */
    public function setExpectations(int $expectations): self
    {
        $this->expectations = $expectations;

        return $this;
    }

    /**
     * Get the value of checks
     *
     * @return int
     */
    public function getChecks(): int
    {
        return $this->checks;
    }

    /**
     * Set the value of checks
     *
     * @param int $checks
     *
     * @return self
     */
    public function setChecks(int $checks): self
    {
        $this->checks = $checks;

        return $this;
    }
}