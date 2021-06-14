<?php

class ControllerLogout {
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
	 * Redirects to the home view after destroying the user's session
	 * @return void
	 */
	private function main() {
		setcookie(SESSION_NAME, '', time() - 3600);
		unset($_COOKIE[SESSION_NAME]);
		$_SESSION = array();
		session_destroy();

		header('Location: '.URL);
	}
}
