<?php

class ControllerHome {
	private $_view;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		$this->_view = new View('Home');
		$this->_view->generate(array());
	}
}
