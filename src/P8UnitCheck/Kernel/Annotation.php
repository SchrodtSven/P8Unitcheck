<?php

namespace P8UnitCheck\Kernel;

#[Attribute]
class Annotation
{
    public function __construct(public string $name)
    {
     
    }
}