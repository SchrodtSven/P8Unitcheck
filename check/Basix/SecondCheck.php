<?php

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;

class SecondCheck extends FoundationCheck
{
    public function checkFoo(): void
    {
        $this->expectFalse( ! is_string('Foo'));
    }

    public function checkBar(): void
    {
        $this->expectFalse(is_int(23));
    }


    

    public function checkInstanceOfFailing(): void
    {
        
            $this->expectInstanceOf(new \stdClass(), '\DateTime');
        

    }

}