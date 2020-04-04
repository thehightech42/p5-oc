<?php

namespace P5\Routeur;
use P5\Routeur\Route;

class Routeur
{
    private $_url; 
    private $_routes = [];

    /*private $_controllerChapter;
    private $_controllerUser;
    private $_controllerCredit;*/

    public function __construct($url)
    {
        $this->_url = $url;

        /*$this->_controllerChapter = new ControllerChapter;
        $this->_controllerUser = new ControllerUser;
        $this->_controllerCredit = new ControllerCredit;*/
        
        //echo $this->_url;

    }

    public function get($path, $callback)
    {
        $route = new Route($path, $callback);
        $this->_routes[] = $route;  

    }

    public function post()
    {

    }

    public function run(){
        //var_dump($this->_routes);
        foreach($this->_routes as $route){
            $match = $route->match($this->_url); 
            if($match)
            {
                return $route->call();
            }
            else{
                throw new \Exception ('Error 404 - Page not found');
            }
        }
    }
}