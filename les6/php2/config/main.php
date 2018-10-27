<?php
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/../');
define('TEMPLATES_DIR', ROOT_DIR . 'views/');
define('TEMPLATES_TWIG_DIR', TEMPLATES_DIR . 'twig/');
define('SERVICES_DIR', ROOT_DIR . 'services/');
define('VENDOR_DIR', ROOT_DIR . 'vendor/');

define('DEFAULT_CONTROLLER', 'product');
define('CONTROLLERS_NAMESPACE', 'app\\controllers');
define('REPOSITORY_NAMESPACE', 'app\\models\\repositories');
?>