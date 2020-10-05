<?php

class App{
private $routes = []; 
    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }
    public function post($path,$callback){
        $this->routes['post'][$path] = $callback;
    }
    public function get_method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function listen(){
        //var_dump($_SERVER);
        $path =  $this->get_path();
        $method =  $this->get_method();
        if(isset($this->routes[$method][$path]) && is_callable($this->routes[$method][$path])){
            call_user_func($this->routes[$method][$path]);
        }
        else{
            echo "Bad Request";
        }
    }
    public function get_path(){
        $tmpPath = $_SERVER["REQUEST_URI"];
        $tmpPath = explode("?",$tmpPath);
        $tmpPath = explode("route-app2020",$tmpPath[0]);
        //var_dump($tmpPath);
        return $tmpPath[1];
    }
    public function show(){
        var_dump($this->routes);
    }
}