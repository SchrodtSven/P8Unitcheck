<?php
$shortopts  = "";
$shortopts .= "f:";  // Required value
$shortopts .= "v::"; // Optional value
$shortopts .= "abc"; // These options do not accept values

$longopts  = array(
    "required:",     // Required value
    "optional::",    // Optional value
    "verbose::",        // No value
    "opt",           // No value
    "::",
    'version'
);

$foo = (new ReflectionClass(FirstCheck::class));
//var_dump(FirstTest::class);
//->getAttributes();
//$attributes = $foo->getAttributes();
//$u = 88/0;

foreach ($foo->getMethods() as $method) {
  foreach($method->getAttributes() as $attr)
  {
    var_dump($attr);
    
      echo $attr->getName() . PHP_EOL;
      echo var_export($attr->getArguments(), true). PHP_EOL;
      
     }
  
}

$tmp = require_once 'src/P8UnitCheck/Kernel/Config/colour_matching_config.php';
/*
  \var_dump($tmp['ok']);
 
  \var_export($tmp['ok']);
  \var_export($tmp['notOk']);

  */ 
  //

      foreach($tmp['notOk'] as $item) {
          $this->find->push((new StringType($item))->quote());
          $this->replace->push((new StringType(
              $this->cli->getColouredString(
                  $item,
                  'white',
                  'red'
              ))
          )->quote())
          ;
      }


      foreach($tmp['ok'] as $item) {
          $this->find->push((new StringType($item))->quote());
          $this->replace->push((new StringType(
              $this->cli->getColouredString(
                  $item,
                  null,
                  'green'
              ))
          )->quote())
          ;
      }

             echo  $this->find->join(', ') . PHP_EOL;
              echo $this->replace->join(', ') . PHP_EOL;
          
      die;
  
  for ($i=0; $i < count($tmp['notOk']);$i++) {
      $this->find->push($tmp['notOk'][$i]);
      $this->replace->push(
          $this->cli->getColouredString(
              $tmp['notOk'][$i],
              'white',
              'red'
      ));
  }

  foreach ($tmp['ok'] as $item) {
      $this->find->push($item);
      $this->replace->push(
          $this->cli->getColouredString(
              $item,
              null,
              'green'
      ));
  }

  foreach ($this->find as $value) {
    $value =  (new StringType($value))->quote();
    $this->replace->push(
        
        (new StringType('$this->cli->colourize(' . $value .', null, \'green\')'))
    );
}

$t = $this->replace->join(',' . PHP_EOL);
$t->prepend('[')->append(']');
echo $t;



