<?php
namespace app\controllers;
use app\services\renderers\IRenderer as IRenderer;

abstract class SiteController implements ISiteController {
    private $action;
    private $layout = 'main';
    private $useLayout = true;
    private $renderer = null;

    public function __construct(IRenderer $renderer) {
        $this->renderer = $renderer;
    }

    public function run($action = null) {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->render($template, $params);
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }

        return $this->renderTemplate($template, $params);
    }
}
?>
