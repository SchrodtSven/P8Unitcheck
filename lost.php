<?php
use P8UnitCheck\Kernel\FoundationTest;

ini_set('assert.exception', 1);





(new ReflectionClass(Thing::class));



$test = new FoundationTest;
//try {
    $test->expectTrue(2+1 ===3);
    $test->expectFalse(4*2 ===8);
    $test->expectTrue(2+2 ===4);
 //   $test->expectTrue(2+3 ===4);
   $test->expectTrue(2+1 ===4);
    $test->expectFalse(2+3 === 888);
//} catch (Exception $e) {
  //  echo 'FOOOO! - FAIL!';
//b}

$test->getResult();



foreach (['main', 'logging', 'meta'] as $section) {
  foreach ($this->config[$section] as $key => $value) {
      $type = match(\gettype($value)) {
          'integer' => 'int',
          'boolean' => 'bool',
      default=> \gettype($value)
      };
      echo '      $this->' . $key . '= $this->config[\'' . $section . '\'][\'' . $key . '\'];' . PHP_EOL;
  }
}

/var_dump(new \P8UnitCheck\Entity\Failure());die;
echo "FOOOO \n\n!";
try {
    $foo = new Config();
} catch(\Error $e) {
    //echo 'YESSS!';
    echo $e->getMessage();
    //var_dump($e);
}

//var_dump($foo);


// 