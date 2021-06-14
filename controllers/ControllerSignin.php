<?php

class ControllerSignin {
	private $_view;
	private $_adminManager;
	private $_errorMessage = false;

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
	 * Verifies the information provided and redirects to the gestion view after creating the user's session
	 * @return void
	 */
	private function main() {
		if (isset($_POST['signin'])) {
			if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
				$email = htmlspecialchars($_POST['email']);
				$password = htmlspecialchars($_POST['password']);

				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					if ($email != 'raspberry@pr00filer.com') {
						$this->_adminManager = new AdminManager();
						$admin = $this->_adminManager->connect($email, $password);

						if ($admin) {
							$this->_adminManager->createSession($admin->getEmail());
							header('Location: '.URL.'gestion');
							exit;
						} else {
							$this->_errorMessage = 'Incorrect email and/or password';
							$this->printForm();
						}
					} else {
						$this->_errorMessage = 'Incorrect email and/or password';
						$this->printForm();
					}
				} else {
					$this->_errorMessage = 'Please enter a valid email';
					$this->printForm();
				}
			} else {
				$this->_errorMessage = 'Please fill in all fields';
				$this->printForm();
			}
		} else {
			$this->printForm();
		}
	}

	/**
	 * Redirects to the login view
	 * @return void
	 */
	private function printForm() {
		$errorMessage = $this->_errorMessage;

		$this->_view = new View('Signin');
		$this->_view->generate(array('errorMessage' => $this->_errorMessage));
	}
}
