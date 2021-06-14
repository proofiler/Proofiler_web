<?php

class ControllerHome {
	private $_view;

	/**
	 * Redirects to an error page or to the main function according to the parameters provided via the URL
	 * @param array $anURL 
	 * @return void
	 */
	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	/**
	 * Redirects to the home view
	 * @return void
	 */
	private function main() {
		$this->_view = new View('Home');
		$this->_view->generate(array());
	}
}
