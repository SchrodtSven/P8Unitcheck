<?php

declare(strict_types=1);
/**
 *  router.php - to be used with PHP Development Server 
 * 
 * - Routing to public/index.php if requested resource does not exist as file resource within document root
 * 
 * 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P7WebCollector
 * @package P7WebCollector
 * @version 0.1
 * @since 2022-12-30
 */

 
if (!file_exists( // if requested resource does not exist as file in document root:
    $_SERVER['DOCUMENT_ROOT'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
    ) { 
    $_SERVER['SCRIPT_NAME'] = 'index.php'; // set current script name in super global 
    require_once 'public/index.php'; // route to public/index.php
} else {
    return false;
}
