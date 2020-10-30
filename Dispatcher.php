<?php
namespace MVC;

use MVC\Request;
use MVC\Router;
use MVC\Controllers\Tasks;

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        // $name = $this->request->controller;
        // $file = 'MVC/' . 'Controllers/' . $name; 
        // require($file);
      
        // $controller = new $name();
        $controller = new Tasks();
        return $controller;
    }
}
