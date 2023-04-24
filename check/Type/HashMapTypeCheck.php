<?php

declare(strict_types=1);
/**
 * Checks for P8UnitCheck\Type\HashMapType
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-22
 */

use P8UnitCheck\Kernel\FoundationCheck;
use P8UnitCheck\Kernel\Annotation;
use P8UnitCheck\Type\HashMapType;

class HashMapTypeCheck extends FoundationCheck
{

    /**
     * 
     * @FIXME after implementing support for _DataSupplier_s via attributes
     */
    public function dataSupplierSubstitute(): array
    {
        return [
            'first' => 'Sven',
            'last' => 'Schrodt',
            'alias' => 'Captain Web-Mar-Vell',
            'secretIdentity' => 'Luc-Marc Plantard',
            'location' => 'Sol-III'
        ];
    }


    /**
     * Basic check expectations for creating a map, and
     * - adding, 
     * - deleting and 
     * - counting elements
     * 
     */
    public function checkBasix(): void
    {
        $map = new HashMapType($this->dataSupplierSubstitute());
        $this->expectTrue(count($map) === $map->count());
        $this->expectTrue(count($map) === 5);
        
        foreach ($this->dataSupplierSubstitute() as $key => $value) {
            $this->expectTrue($map->hasKey($key));
            $this->expectTrue($map->get($key) === $value);
        }

        $map->delete('location');
        $this->expectTrue(count($map) === 4);
        $this->expectFalse($map->hasKey('location'));
        $map->set('hobby','solving world puzzles');
        $map['location'] = 'Hala';
        
        $this->expectTrue(count($map) === 6);
        $this->expectTrue($map->hasKey('location'));
        $this->expectTrue($map->get('location') === 'Hala');

        $this->expectTrue($map->get('hobby') === 'solving world puzzles');

    }

    
}