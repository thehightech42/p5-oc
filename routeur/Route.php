<?php

namespace P5\Routeur; 

Class Route
{
    private $_path;
    private $_callback; 

    public function __construct($path, $callback)
    {
        $this->_path = $path;
        $this->_callback = $callback; 
    }

    public function match($url)
    {
        //echo $url; 
        //echo $this->_path;
        $url = trim($url);
        $match = preg_match($this->_path, $url);

        if($match)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function call()
    {
        $param = [];
        return call_user_func_array($this->_callback, $param);
    }




}