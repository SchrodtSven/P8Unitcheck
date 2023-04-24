<?php

declare(strict_types=1);
/**
 * Class mapper 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-22
 */

 namespace P8UnitCheck\Kernel\Tools;

use P8UnitCheck\Entity\Config;
use P8UnitCheck\Entity\Message;
use P8UnitCheck\Kernel\Config\Messages;
use P8UnitCheck\Type\ListType;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Data\TextTransformer;

class ClassMapper implements \Stringable
{
    private HashMapType $classMapList; 

    private StringType $classMap; 

    private ListType $classes;

    private int $indentLevel = 3;

    private int $indentWidth = 4;

    private string $fileExt =  '.php';

    private \RecursiveIteratorIterator $iterator;

    public function __construct(private string $cwd = 'src/P8UnitCheck')
    {

        $this->classes = new ListType();
        $this->iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($cwd));
        foreach ($this->iterator as $item) {
            if(\str_ends_with($item->getPathname(), '.php')) {
                $this->classes->push($item->getPathname());
            } 
        }
        $this->mapFileResourceLocationToFullyQualifiedClassName();
    }

    /**
     * Mapping file (and path) resource names to fully qualified (with namespace) class names
     * and building source code for array declaration for (reverse) resolution as return argument
     *  - example: 
     * 
     * <code>
     * return [
     *          'P8UnitCheck\Entity\Protocol' => 'src/P8UnitCheck/Entity/Protocol.php',
     *          'P8UnitCheck\Entity\Success' => 'src/P8UnitCheck/Entity/Success.php',   
     *       ...
     * ];
     * </code>
     */
    private function mapFileResourceLocationToFullyQualifiedClassName(): void
    {
        $classMapList = new ListType();

        $this->classes->walk(function( &$item) use (& $classMapList) {
            $s = new StringType($item);
            
            // replacing directory with namespace separator; cutting file extension off
            $tmp = $s->replace(
                    \DIRECTORY_SEPARATOR, 
                    \P8UnitCheck\Autoload::NAMESPACE_SEPARATOR
                )->replace($this->fileExt)->subString(4);

             // Adding assignment   
            $classMapList->push(
                $tmp->quote()
                  ->prepend(\str_repeat(
                          ' ', $this->indentWidth * $this->indentLevel)) 
                          . ' => ' . (new StringType($item))->quote()
            );
        });
        
        $this->classMap = $classMapList->join(','.PHP_EOL)->prepend('    return [' . PHP_EOL)->append(PHP_EOL . '    ];' . PHP_EOL);

    }

    public function render(): StringType
    {
        return $this->classMap;
    }

    public function __toString(): string
    {
        return (string) $this->classMap;
    }

    public function writeFile(string $fileName = 'class_map.php'): self 
    {
        $parser = new TplParser('FileHeadDocBlock'); 

        $parser->DESCRIPT = 'Mapping file (and path) resource names to fully qualified (with namespace) class names';
        $parser->DATE = date('Y-m-d');
        $output = $parser->render() . $this->render();
        \file_put_contents($fileName, $output);

        echo "{$fileName} written\n";
        return $this;

    }
}