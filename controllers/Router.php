<?php

class Router {
	private $_controller;
	private $_view;

	/**
	 * Autoload classes, verifies the information provided and redirects to right controller
	 * @return void
	 */
	public function routeRequest() {
		try {
			spl_autoload_register(function ($aClass) {
				require_once('models/'.$aClass.'.php');
			});

			$URL = [];

			if (isset($_GET['URL'])) {
				$URL = explode('/', filter_var($_GET['URL'], FILTER_SANITIZE_URL));
				$controller = ucfirst(strtolower($URL[0]));
				$controllerClass = 'Controller'.$controller;
				$controllerFile = 'controllers/'.$controllerClass.'.php';
				if (file_exists($controllerFile)) {
					require_once($controllerFile);
					$this->_controller = new $controllerClass($URL);
				} else {
					throw new Exception('Page not found');
				}
			} else {
				require_once('controllers/ControllerHome.php');
				$this->_controller = new ControllerHome($URL);
			}
		} catch (Exception $anError) {
			$errorMessage = $anError->getMessage();
			
			$this->_view = new View('Error');
			$this->_view->generate(array('errorMessage' => $errorMessage));
		}
	}
}
