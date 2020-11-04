<?php

class ControllerSignin {
	private $_view;
	private $_userManager;
	private $_errorMessage = false;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		if (isset($_POST['signin'])) {
			if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
				$username = htmlspecialchars($_POST['username']);
				$password = htmlspecialchars($_POST['password']);
				
				if (strlen($username) < 256) {
					$this->_userManager = new UserManager();
					$user = $this->_userManager->connectUser($username, $password);

					if ($user) {
						$this->_userManager->createUserSession($user->getusername());
						header('Location: '.URL.'configuration');
						exit;
					} else {
						$this->_errorMessage = 'Incorrect username and/or password';
						$this->printForm();
					}
				} else {
					$this->_errorMessage = 'Username too long';
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

	private function printForm() {
		$errorMessage = $this->_errorMessage;

		$this->_view = new View('Signin');
		$this->_view->generate(array('errorMessage' => $this->_errorMessage));
	}
}
