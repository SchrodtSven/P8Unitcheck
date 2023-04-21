<?php

namespace P8UnitCheck\Kernel;

use P8UnitCheck\Entity\Failure;
use P8UnitCheck\Entity\Succces;
use P8UnitCheck\Entity\Message;




class TraceParser
{

   private StringType $checkIdentifier;

   private  array $tracePartKeys = ['file', 'line', 'function', 'class', 'type', 'args'];


   public function __construct(private string $checkId = 'n/a')
   {

   } 
    
   public function getFailure(array $parts): Failure
    {
        return $this->traceStackPart($parts, true);
    }

    public function getSuccess(array $parts): Failure
    {
        return $this->traceStackPart($parts);
    }


    private function traceStackPart(array $parts, bool $isFailure=false): Message
    {
        $message = ($isFailure) 
        ? new Failure()
        : new Succces();

           


        $message->setFile($parts['file']) ?? null;
        $message->setLine($parts['line']) ?? null;
        $message->setFunction($parts['function']) ?? null;
        $message->setClass($parts['class']) ?? null;
        $message->setType($parts['type']) ?? null;
        $message->setArgs($parts['args']) ?? null;

        return $message;
        
    }
}
