<?php
/* 20241004 copied from scss.inc.php to include Server classes. */

if (version_compare(PHP_VERSION, '5.6') < 0) {
    throw new \Exception('scssphp server  requires PHP 5.6 or above');
}

if (! class_exists('ScssPhp\Server\Server')) {
    spl_autoload_register(function ($class) {
        if (0 !== strpos($class, 'ScssPhp\Server\\')) {
            // Not a ScssPhp Server class
            return;
        }

        $subClass = substr($class, strlen('ScssPhp\Server\\'));
        $path = __DIR__ . '/src/' . str_replace('\\', '/', $subClass) . '.php';

        if (file_exists($path)) {
            require $path;
        }
    });
}
