<?php

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;

class FirstCheck extends FoundationCheck
{
    public function checkFoo(): void
    {
        $this->expectTrue(is_string('Foo'));
    }

    public function checkBar(): void
    {
        $this->expectTrue(is_int(23));
    }

    #[DataProvider('Foo') ]
    public function checkBaz(): void
    {
        $this->expectTrue(is_float(2.3));
    }

    #[Foo(value: 'bar')]
    public function checkFalse(): void
    {
        $this->expectFalse(is_string(new \DateTime));
    }

    #[Bar(value: 1234)]
    public function checkFalseOnTypeDetection(): void
    {
        $this->expectFalse(is_string(1.23344));
    }

    #[MockAttribute]
    public function checkIsInstanceOf(): void
    {
        $this->expectInstanceOf(new \DateTime(), 'DateTime');
    }

    public function checkIfErroIsThrown(): void
   {
    $this->expectError('DivisionByZeroError', '$a = 88/0;');
   } 
}