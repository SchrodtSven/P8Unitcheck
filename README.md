# P8UnitCheck

  Tiny framework for checking PHP 8.2+ code units

## Disclaimer
  
  This is version 0.1 and _just the beginning_ of trying to implement a _POC (proof of concept)_.

  I _intentionally_ used different verbs and nouns for class & method | function names to distinguish from
  _xUnit architecture_ (-> see: “Naming conventions” below).
  
  P8UnitCheck is  *not* intended to compete with PHPUnit or other projects. 

  The main goal is to demonstrate (to _myself_) the possibility of building a unit checking (or testing) library 
  without copying code, architecture or nomenclature from others.  
  
  More detailed documentation will follow.



## Outlook / Todos
 
  - Adding documentation 
  - Adding comments 
  - Completing checks
  - Adding unit tests for PHPUnit 
  - Optimizing code quality & class hierarchy structure
  - Adding features:
    - Mocking objects & data structures
    - Code coverage detection (xDebug??)
    - Data supplier (PHP 8 attributes!!)
    - attributing checks as *not complete*
    - attributing checks as *leapable* on conditions (e.g: ext pgsql is not available)
    - adding configuration via
      - .php
      - .XML
      - .json  
      - ???
    - Logging to file and ???
      - xml
      - json
      - text/plain
      - html
      - ...


  - Ensuring further PSR* compatibility
  - Ensuring it to be shippable via _composer_


 


### Archtecture & Design

Based on: 
 - \assert()
 - \AssertionError 

 *tbc*

 ### Testing test  with 
 - PHPUnit &&
 - P8UnitCheck itself ;-)


 ## Runtime cfg

 - <code>unitcheck.ini</code> and 
  - via shell options  (e.g: <code>./unitcheck.php --verbose</code>)


 ## Appendix 

### Example usage


### 

<code>

public function checkFooIsOdd(mixed $expression, string $message = 'failed expectation that %s is odd')
</code>

### Development environment 

 Chronicler's duty: 

 - Boxes: MacBookAir M1 /2020; iMac21,2 M1/2020
 - OS: Darwin Marvell 22.3.0 Darwin Kernel Version 22.3.0; RELEASE_ARM64_T8103 arm64
 - IDE: Visual Studio Code; version: 1.70.2 (Universal)
 - PHP: 8.2.4 (NTS); with Zend OPcache v8.2.0
 - Sqlite: version 3.39.5


### Naming convention
All unit checks (tests) reside within a directory called <samp>check</samp>, that is parallel to the <samp>src</samp> folder. 
The sub directories in both (<samp>src</samp> & <samp>check</samp>) are equivalent.

When running checks on instances a class <samp>Foo</samp> the corresponding check class name will be   <samp>FooCheck</samp> and is stored in a file called  <samp>FooCheck.php</samp>. 
### Nomenclature

  - P8 - pointless _(not PHP8)_ ;-)

  - DataSupplier -> method or function delivering testing data as array of arrays or an instance of <samp>\Iterator</samp>

-- 

 2023/04 Sven Schrodt &lt;sven@schrodt.club&gt;
 Glück auf!