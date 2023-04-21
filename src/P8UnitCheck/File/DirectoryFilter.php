<?php

declare(strict_types=1);
/**
 * Class for filtering directory entries
 *
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P7WebCollector
 * @package P7WebCollector
 * @version 0.1
 * @since 2023-03-29
 */

namespace P7WebCollector\File;

use P8UnitCheck\Type\StringType;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Code\Php\Variable;


class DirectoryFilter
{
    private const FILTER_FOR_FILE = 1;

    private const FILTER_FOR_PATH = 2;

    private const FILTER_MODE_STARTS = 1;

    private const FILTER_MODE_ENDS = 2;

    private const FILTER_MODE_CONTAINS = 4;

    private \RecursiveIteratorIterator $directoryIterator;

    public function __construct(private string $cwd = '.', bool $recursive = true)
    {
        $this->directoryIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($cwd));
    }

    /**
     * Filter function for file extenssions
     * 
     * @param string $extension
     * @return \Generator
     */
    public function byExtension(string $extension = 'xml'): \Generator
    {
        foreach($this->directoryIterator as $file) {
            if($file->getExtension() === $extension)
                 yield $file;
        }
    }

    /***
     * Generic filter function working with injected closures
     * 
     * @param callable $function
     * @return \Generator
     */
    public function byClosure(callable $function) : \Generator
    {
        foreach($this->directoryIterator as $file) {
            if ($function($file))
             yield $file;
        }
    }

    /**
     * @deprecated - leaving it for the moment showing how to use self::byClosure()
     */
    public function fileEndsOld(mixed $text) : \Generator
    {
        foreach (
            $this->byClosure(function (\SplFileInfo $item) use($text) {
                if ((new StringClass($item->getFilename()))->ends($text)) {
                    return true;
                }
            }
            ) as $file
            ) {
            yield $file;
        }
        
    }

    /**
     * Filtering file names starting with $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function fileStarts(string $text): \Generator
    {
        foreach($this->directoryIterator as $file) {       
            if($this->genericFilter($file, $text, self::FILTER_FOR_FILE, self::FILTER_MODE_STARTS)) 
                yield $file;
        }
    }

    /**
     * Filtering file names ending with $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function fileEnds(string $text): \Generator
    {
        foreach($this->directoryIterator as $file) {       
            if($this->genericFilter($file, $text, self::FILTER_FOR_FILE, self::FILTER_MODE_ENDS)) 
                yield $file;
        }
    }

    /**
     * Filtering file names containing $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function fileContains(mixed $text): \Generator
    {
        foreach($this->directoryIterator as $file) {
            if($this->genericFilter($file, $text, self::FILTER_FOR_FILE, self::FILTER_MODE_CONTAINS)) 
                yield $file;
        }
    }
    
    /**
     * Filtering path names starting with $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function pathStarts(string $text): \Generator
    {
        foreach($this->directoryIterator as $file) {       
            if($this->genericFilter($file, $text, self::FILTER_FOR_PATH, self::FILTER_MODE_STARTS)) 
                yield $file;
        }
    }

    /**
     * Filtering path names ending with $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function pathEnds(string $text): \Generator
    {
        foreach($this->directoryIterator as $file) {       
            if($this->genericFilter($file, $text, self::FILTER_FOR_PATH, self::FILTER_MODE_ENDS)) 
                yield $file;
        }
    }

    /**
     * Filtering path names containing $text
     * 
     * @param string $text
     * @return \Generator
     */
    public function pathContains(mixed $text): \Generator
    {
        foreach($this->directoryIterator as $file) {
            if($this->genericFilter($file, $text, self::FILTER_FOR_PATH, self::FILTER_MODE_CONTAINS)) 
                yield $file;
        }
    }
     
    /**
     * Get the value of directoryIterator
     *
     * @return \RecursiveIteratorIterator
     */
    public function getDirectoryIterator(): \RecursiveIteratorIterator
    {
        return $this->directoryIterator;
    }

    /**
     * Set the value of directoryIterator
     *
     * @param \RecursiveIteratorIterator $directoryIterator
     * @return self
     */
    public function setDirectoryIterator(\RecursiveIteratorIterator $directoryIterator): self
    {
        $this->directoryIterator = $directoryIterator;
        return $this;
    }

     /**
     * Internally used generic filter function
     * 
     * @param \SplFileInfo $item
     * @param string $text
     * @param int $subject 
     * @param int $mode 
     */
    private function genericFilter(\SplFileInfo $item, string $text, int $subject = self::FILTER_FOR_FILE, int $mode = self::FILTER_MODE_CONTAINS): bool
    {
        if($subject === self::FILTER_FOR_FILE) {
            $tmp = $item->getFilename();
        } elseif ($subject === self::FILTER_FOR_PATH) {
            $tmp = $item->getPathname();
        } else {
            throw new \InvalidArgumentException('Invalid mode!!!');
        }
        $find = new StringClass($tmp);
        return match($mode) {
                self::FILTER_MODE_CONTAINS => $find->contains($text),
                self::FILTER_MODE_STARTS => $find->starts($text),
                self::FILTER_MODE_ENDS => $find->ends($text)
        };
    }
}