<?php
namespace app\services\renderers;

class TwigRenderer implements IRenderer {
    private $loader;
    private $twig;

    public function __construct() {
        $this->loader = new \Twig_Loader_Filesystem(TEMPLATES_TWIG_DIR);
        $this->twig = new \Twig_Environment($this->loader, [
            'cache' => false,
            'auto_reload' => true
        ]);
        $this->twig->addExtension(new \Twig_Extension_StringLoader());
    }

    public function render($template, $params = []) {
        return $this->twig->render($template . '.twig', $params);
    }
}
?>