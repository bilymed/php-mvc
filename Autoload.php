<?php

class Autoload {

    private $directory_name;

    public function __construct($directory_name) {
        $this->directory_name = $directory_name;
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($class_name) {
        $file_name = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)) . '.php';

        $file = $this->directory_name . '/' . $file_name;

        if (file_exists($file) == false) {
            return false;
        }
        //var_dump($file);
        include ($file);
    }

    //public function register() {
    //    spl_autoload_register(array($this, 'autoload'));
    //}

}
