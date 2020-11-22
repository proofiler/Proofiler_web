<?php

class ControllerConfiguration {
	private $_view;
	private $_adminManager;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		$this->_adminManager = new AdminManager();
		$this->_adminManager->checkSession();

		$this->_view = new View('Configuration');
		$this->_view->generate(array());
	}
}
