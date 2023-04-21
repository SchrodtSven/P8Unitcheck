<?php

declare(strict_types=1);
/**
 * Foundation class for message(s) 
 * 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-14
 */
namespace P8UnitCheck\Entity;
use P8UnitCheck\Shell\Cli;
use P8UnitCheck\Entity\Config;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Type\ListType;

class Message
{

    public const RESULT_SHORTS = ['S', 'F', 'i', 's'];

    protected string $shortResult;
    // out here -> use Messenger
    protected array $ok = ['successfull', 'success', 'Success'];
    
    // out here -> use Messenger
    protected array $notOk = ['Failed', 'failed', 'failure'];
// out here -> use Messenger
    protected ListType $find;
    protected ListType $replace;
// out here -> use Messenger
    protected Cli $cli;
// @deprecated
    protected StringType $checkName;

    protected bool $isSuccessfull = true;

    protected StringType $messageText;
   
    protected \DateTime $created;
    protected \DateTime $modified;

    protected bool $successfull = true;

    public function __construct(string $checkName='')
    {
        $this->checkName = new StringType($checkName);
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
        $this->find = new ListType();
        $this->replace = new ListType();


        // out here -> use Messenger
        $this->cli = new Cli();
// out here -> use Messenger
        foreach ($this->ok as $item) {
            $this->find->push($item);
            $this->replace->push(
                $this->cli->getColouredString(
                    $item,
                    null,
                    'green'
            ));
        }
// out here -> use Messenger
        foreach ($this->notOk as $item) {
            $this->find->push($item);
            $this->replace->push(
                $this->cli->getColouredString(
                    $item,
                    'white',
                    'red'
            ));
        }
    }

    

    public function setSuccessfull(bool $value): self
    {
        $this->successfull = $value;
        return $this;
    }

    public function getSuccessfull(): bool
    {
        return $this->successfull;
    }

    



    /**
     * Get the value of checkName
     *
     * @return StringType
     */
    public function getCheckName(): StringType
    {
        return $this->checkName;
    }

    /**
     * Set the value of checkName
     *
     * @param StringType $checkName
     *
     * @return self
     */
    public function setCheckName(StringType $checkName): self
    {
        $this->checkName = $checkName;

        return $this;
    }

    /**
     * Get the value of isSuccessfull
     *
     * @return bool
     */
    public function getIsSuccessfull(): bool
    {
        return $this->isSuccessfull;
    }

    /**
     * Set the value of isSuccessfull
     *
     * @param bool $isSuccessfull
     *
     * @return self
     */             
    public function setIsSuccessfull(bool $isSuccessfull): self
    {
        $this->isSuccessfull = $isSuccessfull;

        return $this;
    }

    /**
     * Get the value of messageText
     *
     * @return StringType
     */
    public function getMessageText(): StringType
    {
        return $this->messageText;
    }

    /**
     * Set the value of messageText
     *
     * @param StringType $messageText
     *
     * @return self
     */
    public function setMessageText(StringType | string $messageText): self
    {
        $this->messageText = (\is_string($messageText)) 
            ? new StringType($messageText)
            : $messageText;

        return $this;
    }

    /**
     * Get the value of shortResult
     *  
     *  
     *
     * @return string
     */
    public function getShortResult(): string
    {
        return $this->shortResult;
    }

    /**
     * Set the value of shortResult
     *
     * @param string $shortResult
     *
     * @return self
     */
    public function setShortResult(string $shortResult): self
    {
        $this->shortResult = $shortResult;

        return $this;
    }
}