<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Lib\App;
// use App\Txt;



$app = new App();
// $app = new Txt();

// $app->registerCommand('hello', function (array $argv) use ($app) {
//     $name = isset ($argv[2]) ? $argv[2] : "marvin";
//     $app->getPrinter()->display("Hello $name!!!");
// });

$app->registerCommand('csv', function (array $argv) use ($app) {
    $name = isset ($argv[2]) ? $argv[2] : "marvin";
    $app->getCSV($name);
});

$app->registerCommand('iso', function (array $argv) use ($app) {
    $name = isset ($argv[2]) ? $argv[2] : "marvin";
    $app->getIso($name);
});

$app->registerCommand('help', function (array $argv) use ($app) {
    $app->getPrinter()->display("usage:1 cmd>>php.exe main.php csv [ csv-path ]");
    $app->getPrinter()->display("usage:2 cmd>>php.exe main.php iso [ currency-iso(uppercase) ]");
    $app->getPrinter()->display("usage:3 cmd>>php.exe main.php help");
});

$app->runCommand($argv);