<?php

declare(strict_types=1);
/**
 * Class representing failed Unit check
 * 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-19
 */


/**
  *  1 => 
  *  array (
  *  'file' => '/Users/svenschrodt/projects/P8UnitCheck/public/index.php',
  *  'line' => 16,
  *  'function' => 'expectFalse',
  *  'class' => 'P8UnitCheck\\Kernel\\FoundationTest',
  *  'type' => '->',
  *  'args' => 
  *  array (
  *    0 => true,
  *  ),
  * ),
 *)
 */
namespace P8UnitCheck\Entity;

class Failure extends Message
{
    private ?string $file;
    private ?int $line;
    private ?string $function;
    private ?string $class;
    private ?string $type;
    private ?array $args;


    


    /**
     * Get the value of file
     *
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @param string $file
     *
     * @return self
     */
    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    

    /**
     * Get the value of line
     *
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * Set the value of line
     *
     * @param int $line
     *
     * @return self
     */
    public function setLine(?int $line): self
    {
        $this->line = $line;

        return $this;
    }


    

    /**
     * Get the value of function
     *
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * Set the value of function
     *
     * @param string $function
     *
     * @return self
     */
    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }

    

    /**
     * Get the value of class
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Set the value of class
     *
     * @param string $class
     *
     * @return self
     */
    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    

    /**
     * Get the value of type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    

    /**
     * Get the value of args
     *
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * Set the value of args
     *
     * @param array $args
     *
     * @return self
     */
    public function setArgs(?array $args): self
    {
        $this->args = $args;

        return $this;
    }

    public function getFootprint(): string
    {
        return implode('', 
        [
            ' - ',
            //$this->getCheckName(),
            $this->getClass(),
            '::',
            $this->getFunction(),
            '() line: ',
            $this->getLine(),
            

        ]);
    }
}