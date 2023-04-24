<?php

declare(strict_types=1);
/**
 * Quick & dirty template parser
 * 
 * 
 * @FIXME -> replace placeholders not used!!!
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-22
 */

namespace P8UnitCheck\Kernel\Tools;
use P8UnitCheck\Kernel\Config\Application;
use P8UnitCheck\Type\StringType;
use P8UnitCheck\Type\HashMapType;
use P8UnitCheck\File\FileError;

class TplParser
{

    private string $placeholder = '{{%s}}';

    private StringType $currentTpl;

    private HashMapType $replacement;

    
    
    private ListType $searchPatterns;

    public function __construct(string $tplName)
    {
        $this->replacement = new HashMapType();
        $this->loadTpl($tplName);
    }


    public function __set(string $name, mixed $value): void
    {
        $this->replacement[$name]=  $value;
    }

    public function __get(string $name): mixed
    {
        return $this->replacement[$name] ?? null;
    }

    public function __unset(string $name): void
    {
        unset($this->replacement[$name]);
    }

    public function __isset(string $name): bool
    {
        return isset($this->replacement[$name]);
    }

    private function loadTpl(string $tplName): void
    {
        $fullPath = new StringType(Application::TOOL_TPL_DIRECTORY . $tplName);
        //
        if(!$fullPath->ends(Application::CHECK_FILE_SUFFIX)) {
            $fullPath->append(Application::CHECK_FILE_SUFFIX);
        }

        if(!\file_exists((string) $fullPath)) {
            throw new FileError((string) $fullPath, 404);
        }
        $this->currentTpl = new StringType(require_once((string) $fullPath));
        
    }

    public function render(): StringType
    {
        foreach ($this->replacement as $key => $value) {
            $this->currentTpl->replace(
                sprintf($this->placeholder, $key), 
                $value);
        }
        return $this->currentTpl;
    }

    public function __toString(): string
    {
        return (string) $this->render();
    }


}