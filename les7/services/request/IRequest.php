<?php
namespace app\services\request;

interface IRequest {
    public function parseRequest();
    public function getControllerName();
    public function getActionName();
    public function getParams();
    public function getParam($name);
    public function getMetod();
}
?>