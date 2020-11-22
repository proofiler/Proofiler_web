<?php

class ControllerCrud {
	private $_view;
	private $_adminManager;
	private $_errorMessageCreate = false;
	private $_errorMessageOthers = false;
	private $_informationMessageCreate = false;
	private $_informationMessageOthers = false;

	public function __construct($anURL) {
		if (count($anURL) != 2) {
			throw new Exception('Page not found');
		} else {
			$this->main($anURL);
		}
	}

	private function main($anURL) {
		$this->_adminManager = new AdminManager();
		$this->_adminManager->checkSession();
		if (isset($_POST['add']) || isset($_POST['update']) || isset($_POST['delete'])) {
			$this->CRUDExecuter($anURL[1]);
		} else {
			$this->CRUDRouter($anURL[1]);
		}
	}

	private function CRUDRouter($aCRUD) {
		switch ($aCRUD) {
			case 'admins':
				$this->CRUDRouterAdmin();
				break;
			default:
				throw new Exception('Page not found');
				break;
		}
	}

	private function CRUDExecuter($aCRUD) {
		switch ($aCRUD) {
			case 'admins':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterAdminAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterAdminUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterAdminDelete();
				} else {
					throw new Exception('Page not found');
				}

				$this->CRUDRouter($aCRUD);
				break;
			default:
				throw new Exception('Page not found');
				break;
		}
	}

	private function CRUDRouterAdmin() {
		$admins = $this->_adminManager->getAllAdmins();

		$this->_view = new View('Crudadmin');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'admins' => $admins));
	}

	private function CRUDExecuterAdminAdd() {
		if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
			$email = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST['password']);
			$passwordConfirmation = htmlspecialchars($_POST['confirmPassword']);

			if ($password === $passwordConfirmation) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					if (!$this->_adminManager->getOneAdmin($email)) {
						$this->_adminManager->insertOneAdmin(array('email' => $email, 'password' => $password));

						$this->_informationMessageCreate = 'The new administrator has been correctly created';
					} else {
						$this->_errorMessageCreate = 'This email address is already in use';
						$this-> CRUDRouter('admins');
					}
				} else {
					$this->_errorMessageCreate = 'Please enter a valid email';
					$this->CRUDRouter('admins');
				}
			} else {
				$this->_errorMessageCreate = 'Password and password confirmation do not match';
				$this->CRUDRouter('admins');
			}						
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('admins');
		}
	}

	private function CRUDExecuterAdminUpdate() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			if (isset($_POST['email']) && !empty($_POST['email']) && (isset($_POST['oldPassword']) && !empty($_POST['oldPassword']))) {
				if ((isset($_POST['newPassword']) && !empty($_POST['newPassword'])) || (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
					if ((isset($_POST['newPassword']) && !empty($_POST['newPassword'])) && (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
						$id = htmlspecialchars($_POST['id']);
						$email = htmlspecialchars($_POST['email']);
						$oldPassword = htmlspecialchars($_POST['oldPassword']);
						$newPassword = htmlspecialchars($_POST['newPassword']);
						$passwordConfirmation = htmlspecialchars($_POST['confirmPassword']);

						if ($newPassword === $passwordConfirmation) {
							if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
								$admin = $this->_adminManager->getOneAdmin($id);

								if ($admin) {
									if (password_verify($oldPassword, $admin->getPassword())) {
										$this->_adminManager->updateOneAdmin($id, array('email' => $email, 'password' => $newPassword));

										$this->_informationMessageOthers = 'The administrator has been correctly updated';
									} else {
										$this->_errorMessageOthers = 'Incorrect password';
										$this->CRUDRouter('admins');
									}
								} else {
									$this->_errorMessageOthers = 'An error has occurred';
									$this->CRUDRouter('admins');
								}
							} else {
								$this->_errorMessageOthers = 'Please enter a valid email';
								$this->CRUDRouter('admins');
							}
						} else {
							$this->_errorMessageOthers = 'New password and password confirmation do not match';
							$this->CRUDRouter('admins');
						}
					} else {
						$this->_errorMessageOthers = 'Please fill in all fields';
						$this->CRUDRouter('admins');
					}
				} else {
					$id = htmlspecialchars($_POST['id']);
					$email = htmlspecialchars($_POST['email']);
					$oldPassword = htmlspecialchars($_POST['oldPassword']);

					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$admin = $this->_adminManager->getOneAdmin($id);

						if ($admin) {
							if (password_verify($oldPassword, $admin->getPassword())) {
								$this->_adminManager->updateOneAdmin($id, array('email' => $email));

								$this->_informationMessageOthers = 'The administrator has been correctly updated';
							} else {
								$this->_errorMessageOthers = 'Incorrect password';
								$this->CRUDRouter('admins');
							}
						} else {
							$this->_errorMessageOthers = 'An error has occurred';
							$this->CRUDRouter('admins');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid email';
						$this->CRUDRouter('admins');
					}
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in at least the email and the old password fields';
				$this->CRUDRouter('admins');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('admins');
		}
	}

	private function CRUDExecuterAdminDelete() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$id = htmlspecialchars($_POST['id']);

			$admin = $this->_adminManager->getOneAdmin($id);

			if ($admin) {
				$admins = $this->_adminManager->getAllAdmins();

				if (count($admins) > 1) {
					$this->_adminManager->deleteOneAdmin($id);

					$this->_informationMessageOthers = 'The administrator has been correctly deleted';
				} else {
					$this->_errorMessageOthers = 'There is only one administrator left so it is impossible to delete it';
					$this->CRUDRouter('admins');
				}
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('admins');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('admins');
		}
	}
}
