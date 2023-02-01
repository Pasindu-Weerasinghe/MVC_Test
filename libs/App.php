<?php

class App
{
    private $_url = null;
    private $_controller = null;

    function __construct()
    {
        $this->_url = $this->_getURL();

        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        if ($this->_loadController()) {
            $this->_loadControllerMethod();
        }
    }

    private function _getURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);

        //print_r($this->_url);
    }

    private function _loadDefaultController()
    {
        require 'controllers/Index.php';

        $this->_controller = new Index();

        $this->_controller->index();
    }

    private function _loadController()
    {
        $file = 'controllers/' . $this->_url[0] . '.php';

        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0]);
            return true;
        } else {
            echo "Sorry page not found";
            return false;
        }
    }
    private function _loadControllerMethod()
    {
        $urlLength = count($this->_url);
        if ($urlLength > 1) {
            if (method_exists($this->_controller, $this->_url[1])) {
                $params = array_slice($this->_url, 2);
                call_user_func_array([$this->_controller, $this->_url[1]], $params);
            } else {
                echo 'Requested Method not found';
            }
        }
    }
}
