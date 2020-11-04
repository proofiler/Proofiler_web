<?php

class ControllerConfiguration {
	private $_view;
	private $_userManager;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		$this->_userManager = new UserManager();
		$this->_userManager->checkUserSession();

		$this->_view = new View('Configuration');
		$this->_view->generate(array());
	}
}
