<?php
namespace app\controllers;
use \app\base\App as App;

abstract class SiteController implements ISiteController {
    private $action;
    private $layout = 'main';
    private $useLayout = true;

    public function run($action = null) {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new \Exception("Ошибка! Запрашиваемая страница не найдена!");
        }       
    }

    public function renderTemplate($template, $params = []) {
        return App::call()->renderer->render($template, $params);
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }

        return $this->renderTemplate($template, $params);
    }

    public function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}
?>
