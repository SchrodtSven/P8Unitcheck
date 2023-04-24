<?php

#[Attribute]
class CoolAttribute
{
    private mixed $value;

    public function __construct(?string ...$args)
    {
        echo "Running " . __METHOD__,
        " args: " . implode(", ", $args) . PHP_EOL;
    }
}

#[DataSuppplier('FirstNameSupplier', 'SecondSupplier')]
class Thing
{
    #[CoolAttribute]
    public function Foo(int $a, string $b): self
    {
        return $this;
    }
    //# [summiere(a+b)]
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }
}


$foo = new ReflectionClass(Thing::class);
foreach ($foo->getAttributes() as $attrib)
{
    var_dump($attrib->getName());
    var_dump($attrib->getArguments());
}

// die(__FILE__ . ' line ' . __LINE__);

// foreach ($foo->getMethods() as $method) {
//     echo $method->getName();
//     echo PHP_EOL;
//     foreach($method->getAttributes() as $attr)
//     {
//       //var_dump($attr);
      
//         echo $attr->getName() . PHP_EOL;
//         //7echo var_export($attr->getArguments(), true);
//        // echo PHP_EOL;
//        var_dump($attr->newInstance());
        
//        }
    
//   }

  /* 
function dumpAttributeData(ReflectionClass $reflection): void 
{
    $attributes = $reflection->getAttributes();

    foreach ($attributes as $attribute) {
       var_dump($attribute->getName());
       var_dump($attribute->getArguments());
       var_dump($attribute->newInstance());
    }
}

dumpAttributeData(new ReflectionClass(Thing::class)); */