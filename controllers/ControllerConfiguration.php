<?php

class ControllerConfiguration {
	private $_view;
	private $_AdminManager;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		$this->_AdminManager = new AdminManager();
		$this->_AdminManager->checkSession();

		$this->_view = new View('Configuration');
		$this->_view->generate(array());
	}
}
