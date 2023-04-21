<?php

declare (strict_types = 1);
/**
 *  Foundation class for unit checks
 *
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */

namespace P8UnitCheck\Entity;

use P8UnitCheck\File\FileError;

class Config
{

    
   /**
    * 
    * 
    * @variable    bool $verboseMessages
    */
           
    private    bool  $verboseMessages;
                  
   /**
    * 
    * 
    * @variable bool $showColours
    */
           
    private bool  $showColours;
                  
   /**
    * 
    * 
    * @variable string $autoLoad
    */
           
    private string  $autoLoad;
                  
   /**
    * 
    * 
    * @variable bool $detectCoverage
    */
           
    private bool  $detectCoverage;
                  
   /**
    * 
    * 
    * @variable string $checkDir
    */
           
    private string  $checkDir;
                  
   /**
    * 
    * 
    * @variable    bool $logMessages
    */
           
    private    bool  $logMessages;
                  
   /**
    * 
    * 
    * @variable    bool $cliLog
    */
           
    private    bool  $cliLog;
                  
   /**
    * 
    * 
    * @variable    bool $xmlLog
    */
           
    private    bool  $xmlLog;
                  
   /**
    * 
    * 
    * @variable    bool $htmlLog
    */
           
    private    bool  $htmlLog;
                  
   /**
    * 
    * 
    * @variable    bool $jsonLog
    */
           
    private    bool  $jsonLog;
                  
   /**
    * 
    * 
    * @variable string $filePath
    */
           
    private string  $filePath;
                  
   /**
    * 
    * 
    * @variable string $version
    */
           
    private string  $version;
                  
   /**
    * 
    * 
    * @variable string $author
    */
           
    private string  $author;
                  
   /**
    * 
    * 
    * @variable string $gitUrl
    */
           
    private string  $gitUrl;
                  
   /**
    * 
    * 
    * @variable string $phpVersion
    */
           
    private string  $phpVersion;

    public function __construct(private string $configFile = 'unitcheck.ini')
    {
     //   $this->configFile = \realpath($this->configFile);
        
        if (!\file_exists($this->configFile)) {
            $code = 404;
            throw new FileError($this->configFile, $code);
        }
        $this->_init();

    }

    /**
     * Setting up configuration from ini config file
     */
    public function _init()
    {
        $config = \parse_ini_file($this->configFile, true, \INI_SCANNER_TYPED);

        $this->verboseMessages = $config['main']['verboseMessages'];
        $this->showColours = $config['main']['showColours'];
        $this->autoLoad = $config['main']['autoLoad'];
        $this->detectCoverage = $config['main']['detectCoverage'];
        $this->checkDir = $config['main']['checkDir'];
        $this->logMessages = $config['logging']['logMessages'];
        $this->cliLog = $config['logging']['cliLog'];
        $this->xmlLog = $config['logging']['xmlLog'];
        $this->htmlLog = $config['logging']['htmlLog'];
        $this->jsonLog = $config['logging']['jsonLog'];
        $this->filePath = $config['logging']['filePath'];
        $this->version = $config['meta']['version'];
        $this->author = $config['meta']['author'];
        $this->gitUrl = $config['meta']['gitUrl'];
        $this->phpVersion = $config['meta']['phpVersion'];

    }

    /**
     * Get the value of verboseMessages
     *
     * @return int
     */
    public function getVerboseMessages(): bool
    {
        return $this->verboseMessages;
    }

    /**
     * Set the value of verboseMessages
     *
     * @param $type verboseMessages
     * @return self
     */
    public function setVerboseMessages(bool $value): self
    {
        $this->verboseMessages = $value;

        return $this;
    }

    /**
     * Get the value of showColours
     *
     * @return bool
     */
    public function getShowColours(): bool
    {
        return $this->showColours;
    }

    /**
     * Set the value of showColours
     *
     * @param $type showColours
     * @return self
     */
    public function setShowColours(bool $value): self
    {
        $this->showColours = $value;

        return $this;
    }

    /**
     * Get the value of autoLoad
     *
     * @return string
     */
    public function getAutoLoad(): string
    {
        return $this->autoLoad;
    }

    /**
     * Set the value of autoLoad
     *
     * @param $type autoLoad
     * @return self
     */
    public function setAutoLoad(string $value): self
    {
        $this->autoLoad = $value;

        return $this;
    }

    /**
     * Get the value of detectCoverage
     *
     * @return bool
     */
    public function getDetectCoverage(): bool
    {
        return $this->detectCoverage;
    }

    /**
     * Set the value of detectCoverage
     *
     * @param $type detectCoverage
     * @return self
     */
    public function setDetectCoverage(bool $value): self
    {
        $this->detectCoverage = $value;

        return $this;
    }

    /**
     * Get the value of checkDir
     *
     * @return string
     */
    public function getCheckDir(): string
    {
        return $this->checkDir;
    }

    /**
     * Set the value of checkDir
     *
     * @param $type checkDir
     * @return self
     */
    public function setCheckDir(string $value): self
    {
        $this->checkDir = $value;

        return $this;
    }

    /**
     * Get the value of logMessages
     *
     * @return int
     */
    public function getLogMessages(): int
    {
        return $this->logMessages;
    }

    /**
     * Set the value of logMessages
     *
     * @param $type logMessages
     * @return self
     */
    public function setLogMessages(int $value): self
    {
        $this->logMessages = $value;

        return $this;
    }

    /**
     * Get the value of cliLog
     *
     * @return int
     */
    public function getCliLog(): int
    {
        return $this->cliLog;
    }

    /**
     * Set the value of cliLog
     *
     * @param $type cliLog
     * @return self
     */
    public function setCliLog(int $value): self
    {
        $this->cliLog = $value;

        return $this;
    }

    /**
     * Get the value of xmlLog
     *
     * @return int
     */
    public function getXmlLog(): int
    {
        return $this->xmlLog;
    }

    /**
     * Set the value of xmlLog
     *
     * @param $type xmlLog
     * @return self
     */
    public function setXmlLog(int $value): self
    {
        $this->xmlLog = $value;

        return $this;
    }

    /**
     * Get the value of htmlLog
     *
     * @return int
     */
    public function getHtmlLog(): int
    {
        return $this->htmlLog;
    }

    /**
     * Set the value of htmlLog
     *
     * @param $type htmlLog
     * @return self
     */
    public function setHtmlLog(int $value): self
    {
        $this->htmlLog = $value;

        return $this;
    }

    /**
     * Get the value of jsonLog
     *
     * @return int
     */
    public function getJsonLog(): int
    {
        return $this->jsonLog;
    }

    /**
     * Set the value of jsonLog
     *
     * @param $type jsonLog
     * @return self
     */
    public function setJsonLog(int $value): self
    {
        $this->jsonLog = $value;

        return $this;
    }

    /**
     * Get the value of filePath
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Set the value of filePath
     *
     * @param $type filePath
     * @return self
     */
    public function setFilePath(string $value): self
    {
        $this->filePath = $value;

        return $this;
    }

    /**
     * Get the value of version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Set the value of version
     *
     * @param $type version
     * @return self
     */
    public function setVersion(string $value): self
    {
        $this->version = $value;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param $type author
     * @return self
     */
    public function setAuthor(string $value): self
    {
        $this->author = $value;

        return $this;
    }

    /**
     * Get the value of gitUrl
     *
     * @return string
     */
    public function getGitUrl(): string
    {
        return $this->gitUrl;
    }

    /**
     * Set the value of gitUrl
     *
     * @param $type gitUrl
     * @return self
     */
    public function setGitUrl(string $value): self
    {
        $this->gitUrl = $value;

        return $this;
    }

    /**
     * Get the value of phpVersion
     *
     * @return string
     */
    public function getPhpVersion(): string
    {
        return $this->phpVersion;
    }

    /**
     * Set the value of phpVersion
     *
     * @param $type phpVersion
     * @return self
     */
    public function setPhpVersion(string $value): self
    {
        $this->phpVersion = $value;

        return $this;
    }

}
