<?php

class ControllerLogout {
	private $_view;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		setcookie(SESSION_NAME, '', time() - 3600);
		unset($_COOKIE[SESSION_NAME]);
		$_SESSION = array();
		session_destroy();

		header('Location: '.URL);
	}
}
