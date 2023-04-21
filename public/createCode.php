<?php


$tpl = '
/**
 * Get the value of {key}
 *
 * @return {type}
 */
public function get{ukey}(): {type}
{
    return $this->{key};
}

/**
 * Set the value of {key}
 *
 * @param $type {key}
 * @return self
 */
public function set{ukey}({type} $value): self
{
    $this->{key} = $value;

    return $this;
}

';

$search = ['{ukey}', '{type}', '{key}'];



$config = \parse_ini_file('unitcheck.ini', true, \INI_SCANNER_TYPED);
$dollar = '$';
foreach(['main', 'logging', 'meta'] as $section) {
    foreach ($config[$section] as $key => $value) {
        $ukey = ucfirst($key);
        
        $type = match(\gettype($value)) {
          'integer' => 'int',
          'boolean' => 'bool',
          default   => \gettype($value) 
        };
        $replace = [$ukey, $type, $key];
        //echo '      $this->' . $key  . '= $this->config[\'' . $section . '\'][\'' . $key . '\'];' . PHP_EOL ;
        
        echo 
        "       
   /**
    * 
    * 
    * @variable {$type} {$dollar}{$key}
    */
           
    private $type  {$dollar}{$key};
           ";
     //echo str_replace($search, $replace, $tpl);
    //    die;
    }
}