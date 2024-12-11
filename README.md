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
 
  - Eliminate <code>echo, print*, var_</code>* etc. from code -> ship  *all output* to <code>P8UnitCheck\Frontend\\*</code>
  - Adding documentation 
  - Adding comments 
  - Completing checks
  - Adding unit tests for PHPUnit 
  - Optimizing code quality & class hierarchy structure
  - Adding features:
    - Mocking objects & data structures
    - Code coverage detection (xDebug or??)
    - Data supplier (PHP 8 attributes!!)
    - attributing checks as *not complete* (--> neither failed nor successfull)
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


### Example usage

Running one ore more check(s):
<code>% ./phpunitcheck.php check/Data/TextTransformerCheck.php  check/Type/HashMapTypeCheck.php [...]
</code>

Running all checks in configured directory (default is <code>check</code>)
 <code>
% ./phpunitcheck.php
</code>
 ## Appendix 



## Runtime cfg

- <code>unitcheck.ini</code> and 
  - via shell options  (e.g: <code>./unitcheck.php --verbose</code>)
  - using setters of <code>P8UnitCheck\Entity\Config</code>


### Tools

- <code>src/P8UnitCheck/Kernel/Tools/generate_class_map.php</code> - generates class map for autoloading and Factory usage

<code>public function checkFooIsOdd(mixed $expression, string $message = 'failed expectation that %s is odd')
</code>

### Development environment 

 Chronicler's duty: 

 - Box: MacBookAir M1 /2020 (PHP Development)
 - Box: iMac21,2 M1/2020 (PHP Development)
 - Box: Raspberry Pi 4 Model B Rev 1.1 (RDBMS, CI/CD)
 - OS: Darwin Marvell 22.3.0 Darwin Kernel Version 22.3.0; RELEASE_ARM64_T8103 arm64
 - OS: Linux raspberrypi 5.10.17-v7l+ #1403 SMP Mon Feb 22 11:33:35 GMT 2021 armv7l GNU/Linux
 - IDE: Visual Studio Code; version: 1.70.2 (Universal)
 - PHP: 8.2.4 (NTS); with Zend OPcache v8.2.0
 - Java: openjdk version "11.0.18" 2023-01-17; OpenJDK Runtime Environment  & OpenJDK Server VM
 - RDBMS: Sqlite version 3.39.5
 - CI/CD Pipeline: Jenkins 

### Naming convention
All unit checks (tests) reside within a directory called <code>check</code>, that is parallel to the <code>src</code> folder. 
The sub directories in both (<code>src</code> & <code>check</code>) are equivalent.

When running checks on instances a class <code>Foo</code> the corresponding check class name will be   <code>FooCheck</code> and is stored in a file called  <code>FooCheck.php</code>. 

Each check method contains at least 1 _expectation_ and is prefixed with <code>check</code> following a max. descriptive Name - e.G: <code>checkIfPlaneCanFlyWithWeightOverTenTonsAndFuelLevelBelowMinimumWhenTargetIsAntarctica(): void</code>  - led _too_ way, I know....

### Nomenclature

  - P8 - "pointless" _(not PHP8)_ ;-)

  - DataSupplier -> method or function delivering testing data as array of arrays or an instance of <code>\Iterator</code>
  - CheckCase
  - Expectation

-- 

 2023/04 Sven Schrodt &lt;sven@schrodt.club&gt;
 Glück auf!


