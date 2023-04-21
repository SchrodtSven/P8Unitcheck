<?php

declare(strict_types=1);
/**
 *  Handling string(s) as object instances
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-14
 */

namespace P8UnitCheck\Type;

class StringType implements \Stringable
{
    public function __construct(protected string $content)
    {

    }

    public function replace(string $needle, string $replace = '')
    {
        $this->content = \str_replace($needle, $replace, $this->content);

        return $this;

    }


    public function replaceMultiple(array $needles, array $replacement = [''])
    {
        $this->content = \str_replace($needles, $replacement, $this->content);

        return $this;

    }


    public function splitBy(string $separator): ListType
    {
        return new ListType(explode($separator, $this->content));
    }


     /**
     * Prepending string $begin to current content
     * 
     * @param mixed $begin
     * @return StringClass
     */
    public function prepend(mixed $begin): self
    {
        $this->content = (string)  $begin . $this->content;
        return $this;
    }


    /**
     * Appending string $end to current content
     * 
     * @param mixed $end     
     * @return StringClass
     */
    public function append(mixed $end): self
    {
        $this->content = (string) $this->content . $end;
        return $this;
    }

    /**
     * Trimming (often unneeded) white space on string boundaries of current content
     * 
     * @param string $characters
     * @return StringClass
     */
    public function trim(string $characters = " \n\r\t\v\x00"): self
    {
         
        $this->content = trim($this->content, $characters);
        return $this;
    }

    public function toUpper(): self
    {
        $this->content = \strtoupper($this->content);
        return $this;
    }

    // custom functions
    public function quote(string $sign ="'"): self
    {
        $this->prepend($sign)->append($sign);
        return $this;
    }

    // 'magical' interceptor functions
    public function __toString(): string
    {
        return $this->content;
    }
   

    // Simple string comparison methods

    public function begins(string $begin): bool
    {
        return \str_starts_with($begin);
    }

    public function ends(string $end): bool
    {
        return \str_ends_with($end);
    }
}