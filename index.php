<?php

define("ROOT", __DIR__);
define("SRC", ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
define("VIEW", SRC . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);

require './Autoload.php';
$file1 = new Autoload('library');
$file2 = new Autoload('src');

$router = new Router($_GET['url']);
require './src/route.php';


$router->run();






// ---------------autolading------------------//
//function __autoload($class_name) {
//    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)) . '.php';
//
//    $file1 = 'src/' . $filename;
//    $file2 = 'library/' . $filename;
//    var_dump($file1);
//    echo '----------';
//    var_dump($file2);
//    if (is_file($file1)) {
//        require $file1;
//        return;
//    } else if (is_file($file2)) {
//        require $file2;
//        return;
//    }
//}
//
////function __autoload($class_name) {
////    $class_name = str_replace('app\\', '', $class_name);
////    $class_name = str_replace('\\', '/', $class_name);
////    require 'src/' . $class_name . '.php';
////}
//
//function register() {
//    spl_autoload_register(array(__CLASS__, 'autoload'));
//}
// ---------------run application------------------//


