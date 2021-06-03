<?php
/**
 *User:ywn
 *Date:2021/5/26
 *Time:23:11
 */

namespace app;


use app\controllers\ProductController;

class Router
{
    public array $postRoutes = [];
    public array $getRoutes = [];
    public Database $db;
    public function __construct(){
        $this->db=new Database();
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        //地址截取
        if(strpos($currentUrl,'?')!==false){
            $currentUrl=substr($currentUrl,0,strpos($currentUrl,'?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }
        if ($fn) {
           call_user_func($fn,$this);
        } else {
            echo 'page not found';
        }
    }
    //视图渲染
    public function renderView($view,$params=[]){ //products/index
        foreach ($params as $key =>$value){
            $$key=$value;
        }
        ob_start();
        include_once __DIR__."/views/$view.php";
        $content=ob_get_clean();
        include_once __DIR__.'/views/_layout.php';
    }
}