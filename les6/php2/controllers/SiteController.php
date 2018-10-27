<?php
namespace app\controllers;
use \app\models\repositories\IRepository as IRepository;
use \app\services\renderers\IRenderer as IRenderer; 
use \app\services\request\IRequest as IRequest;

abstract class SiteController implements ISiteController {
    private $action;
    private $layout = 'main';
    private $useLayout = true;
    private $renderer = null;
    protected $request;
    protected $repository;

    public function __construct(IRenderer $renderer = null, IRepository $repository = null, IRequest $request = null) {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->repository = $repository;
    }

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
