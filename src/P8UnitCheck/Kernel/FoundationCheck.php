<?php

declare(strict_types=1);
/**
 *  Foundation class for unit checks
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */

namespace P8UnitCheck\Kernel;
use P8UnitCheck\Entity\Config;
use P8UnitCheck\Entity\Failure;
use P8UnitCheck\Entity\Success;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Kernel\TraceParser;
use P8UnitCheck\Shell\Cli;
use P8UnitCheck\Data\TextTransformer;
use P8UnitCheck\Kernel\Config\Messages;

class FoundationCheck
{
    protected Cli $cli;

    protected Messages $messages;

    protected bool $verbose = false;

    //@FIXME -> use checks & expectations numbering!!!
    protected int $checks = 0;

    protected int $expectations = 0;

    protected int $failure = 0;

    protected int $success = 0;

    protected string $result;
    
    protected ListType $history;

    protected TraceParser $parser;

    protected TextTransformer $textTransformer;

    public function __construct(protected Config $config)
    {
        $this->cli = new Cli();
        $this->textTransformer = new TextTransformer();
        $this->messages = new Messages();
        $this->history = new ListType();
        $this->parser = new TraceParser();
    }

    /**
     * Main method used to expect results
     * 
     * @FIXME ->get fil, line etc. from $e->trace()[1]  --> nested methods!!!
     * 
     */
    public function expect(mixed $expression, string $messageOnFailure ='Failed expectation') 
    {
        try {
            $this->expectations++;
            assert($expression, new CheckError);
            $msg = new Success();
            $msg->setMessageText($this->textTransformer->colourize('Success'));
            $msg->setShortResult($this->cli->getColouredString('S', 'green'));
            $this->history->push($msg); 
            $this->success++;        
             
            
        } catch (CheckError $e) {

            $msg = $this->parser->getFailure($e->getTrace()[2]);
            $msg->setMessageText($this->textTransformer->colourize($messageOnFailure));
            $msg->setShortResult($this->cli->getColouredString('F', 'red'));
            $msg->setIsSuccessfull(false);
            $this->history->push($msg); 
            $this->failure++;
        } finally {

            if($this->config->getVerboseMessages()) {
                echo ' expectation result: ' . $msg->getMessageText(); 
                if(!$msg->getIsSuccessfull()) {
                    echo $msg->getFootprint();
                } 
                echo PHP_EOL;
            } else {
                echo $msg->getShortResult();
            }
        }
    }

    public function expectFalse(mixed $expression, string $messageOnFailure ='Failed expectation') 
    {
        $this->expect(
            !$expression,
            $this->messages->getFailureMessage(
                sprintf(Messages::FAILURE_REASON_X_IS_FALSE, \var_export($expression, true))
                )
            );
    }

    public function expectTrue(mixed $expression, string $messageOnFailure ='Failed expectation') 
    {
        $this->expect(
            $expression,
            $this->messages->getFailureMessage(
                sprintf(Messages::FAILURE_REASON_X_IS_TRUE, \var_export($expression, true))
                )
            );
    }

    public function expectError(string $errorName, mixed $expressionString, $messageOnFailure ='Failed expectation') 
    {
        try {
            eval($expressionString);
        } catch(\Error $e) {
            $this->expectInstanceOf(
                $e, 
                $errorName, 
                $this->messages->getFailureMessage(
                    sprintf(Messages:: FAILURE_REASON_INSTANCE_OF, \var_export($expressionString, true) , $errorName)
                    )
                );
        }
    }

    /**
     * @FIXME
     */
    public function expectException(string $exceptionName, mixed $expression, $messageOnFailure ='Failed expectation')
    {
        try {
            eval($expression);
        } catch(\Exception $e) {
            $this->expectInstanceOf($e, $exceptionName, $messageOnFailure);
        }
        
     }

    public function expectInstanceOf(object $instance, string $classOrInterface, $messageOnFailure ='Failed expectation')
    {
        $this->expect($instance instanceof $classOrInterface, $this->messages->getFailureMessage(
                 sprintf(Messages:: FAILURE_REASON_INSTANCE_OF, $instance::class, $classOrInterface))
            );
    }

    public function getHistory(): ListType
    {
        return $this->history;
    }
    /**
     * @deprecated
     */
    public function getResult()
    {
        \var_dump($this->history);
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
}