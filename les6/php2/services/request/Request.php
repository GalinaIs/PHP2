<?php
namespace app\services\request;

class Request implements IRequest {
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $method;

    public function __construct() {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parseRequest();
    }

    public function parseRequest() {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
            $this->params['get'] = $_GET;
            $this->params['post'] = $_POST;
        }
    }

    public function getControllerName() {
        return $this->controllerName;
    }

    public function getActionName() {
        return $this->actionName;
    }

    public function getParams() {
        return $this->params;
    }

    private function get($name) {
        if (isset($this->params['get'][$name])) {
            return $this->params['get'][$name];
        }
        return null;
    }

    private function post($name) {
        if (isset($this->params['post']['name'])) {
            return $this->params['post']['name'];
        }
        return null;
    }

    public function getParam($name) {
        if ($this->method == 'GET') {
            return $this->get($name);
        }
        return $this->post($name);
    }

    public function getMetod() {
        return $this->method;
    }
}
?>