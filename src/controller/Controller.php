<?php

namespace Controller;

class Controller {

    private $vars = array();

    public function make($view) {
        extract($this->vars);
        ob_start();
        require VIEW . $view . '.php';
        $content = ob_get_clean();
        require VIEW . 'layout.php';
    }

    public function send($key, $value = null) {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }
    
    public function json($var){
    	$app = \Slim\Slim::getInstance();
    	$app->response()->header('Content-Type', 'application/json');
    	echo json_encode($var);
    }

}
