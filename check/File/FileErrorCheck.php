<?php

declare(strict_types=1);
/**
 * Checks for P8UnitCheck\File\FileError
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-20
 */

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;
use P8UnitCheck\File\FileError;



class FileErrorCheck extends FoundationCheck
{
    /**
     * 
     * @FIXME -> expectException is buggy!
     */
    public function NOcheckIfErrorIsThrown(): void
    {
        $this->expectException(FileError::class, "throw new \P8UnitCheck\File\FileError('Foo', 404);");
        
    }

    public function checkIfExceptionIsThrownAndMessageIsCorrect(): void
    {
        try {
            throw new FileError('FooBar', 404);
        } catch(\Error $error) {
            $expected =  'The file resource FooBar does not exist!';
            $this->expectInstanceOf($error, FileError::class);
            $this->expectTrue($error->getMessage() === $expected);
        } 

        try {
            throw new FileError('FooBar', 666);
        } catch(\Error $error) {
            $expected =  'FooBar The devil is in the details.';
            $this->expectInstanceOf($error, FileError::class);
            $this->expectTrue($error->getMessage() === $expected);
        } 

        try {
            throw new FileError('FooBar', 23);
        } catch(\Error $error) {
            $expected =  'Hard disk seems to be FooBar';
            $this->expectInstanceOf($error, FileError::class);
            $this->expectTrue($error->getMessage() === $expected);
        } 
    }

    public function checkFoo(): void
    {
        $this->expectTrue(2===1);
    }

}