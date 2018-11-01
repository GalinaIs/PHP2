<?php
namespace app\base;
use \app\traits\TSingletone as TSingletone;

class App {
    use TSingletone;

    public $config;
    private $components = [];

    public function run($config) {
        $this->config = $config;
        $this->components = new \app\base\Storage();
        $this->runController();
    }

    private function runController() {
        $controllerName = $this->request->getControllerName() ?: $this->config['defaultController'];
        $actionName = $this->request->getActionName();
        $controllerClass = $this->config['controllerNamespace'] . "\\" . ucfirst($controllerName) . 'Controller';

        try {
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                try {
                    $controller->run($actionName);
                } catch (\Exception $e) {
                    $errorClass = $this->config['controllerNamespace'] . "\\ErrorController";
                    (new $errorClass())->actionIndex($e->getMessage());
                }
            } else {
                throw new \Exception('Запрашиваемая страница не найдена!');
            }
        } catch (\Exception $e) {
            $errorClass = $this->config['controllerNamespace'] . "\\ErrorController";
            (new $errorClass())->actionIndex($e->getMessage());
        }
    }

    public function createComponent($key) {
        if (isset($this->config['components'][$key])) {
            $params = $this->config['components'][$key];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                $ert = $reflection->newInstanceArgs($params);
                return $ert;
            } else {
                throw new \Exception("Класс компонента {$class} не определен");
            }
        } else {
            throw new \Exception("Компонент {$key} не найден");
        }
    }

    public function call() {
        return static::getInstance();
    }

    function __get($name) {
        return $this->components->get($name);
    }
}