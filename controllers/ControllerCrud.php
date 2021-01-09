<?php

class ControllerCrud {
	private $_view;
	private $_usbManager;
	private $_adminManager;
	private $_employeeManager;
	private $_extensionManager;
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
		$this->_usbManager = new UsbManager();
		$this->_adminManager = new AdminManager();
		$this->_employeeManager = new EmployeeManager();
		$this->_extensionManager = new ExtensionManager();
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
			case 'extensions':
				$this->CRUDRouterExtension();
				break;
			case 'employees':
				$this->CRUDRouterEmployee();
				break;
			case 'usbs':
				$this->CRUDRouterUsb();
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
			case 'extensions':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterExtensionAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterExtensionUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterExtensionDelete();
				} else {
					throw new Exception('Page not found');
				}

				$this->CRUDRouter($aCRUD);
				break;
			case 'employees':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterEmployeeAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterEmployeeUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterEmployeeDelete();
				} else {
					throw new Exception('Page not found');
				}

				$this->CRUDRouter($aCRUD);
				break;
			case 'usbs':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterUsbAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterUsbUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterUsbDelete();
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

	private function CRUDRouterExtension() {
		$extensions = $this->_extensionManager->getAllExtensions();

		$this->_view = new View('Crudextension');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'extensions' => $extensions));
	}

	private function CRUDRouterEmployee() {
		$employees = $this->_employeeManager->getAllEmployees();

		$this->_view = new View('Crudemployee');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'employees' => $employees));
	}

	private function CRUDRouterUsb() {
		$usbs = $this->_usbManager->getAllUsbs();

		$this->_view = new View('Crudusb');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'usbs' => $usbs));
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

	private function CRUDExecuterExtensionAdd() {
		if (isset($_POST['name']) && !empty($_POST['name'])) {
			$name = htmlspecialchars($_POST['name']);

			if (!$this->_extensionManager->getOneExtension($name)) {
				$this->_extensionManager->insertOneExtension(array('name' => $name));

				$this->_informationMessageCreate = 'The new extension has been correctly created';
			} else {
				$this->_errorMessageCreate = 'This extension is already in use';
				$this->CRUDRouter('extensions');
			}
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('extensions');
		}
	}

	private function CRUDExecuterEmployeeAdd() {
		if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['firstName']) && !empty($_POST['firstName'])) && (isset($_POST['lastName']) && !empty($_POST['lastName']))) {
			$email = htmlspecialchars($_POST['email']);
			$firstName = htmlspecialchars($_POST['firstName']);
			$lastName = htmlspecialchars($_POST['lastName']);

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				if (!$this->_employeeManager->getOneEmployee($email)) {
					$this->_employeeManager->insertOneEmployee(array('email' => $email, 'firstName' => $firstName, 'lastName' => $lastName));

					$this->_informationMessageCreate = 'The new employee has been correctly created';
				} else {
					$this->_errorMessageCreate = 'This email is already in use';
					$this->CRUDRouter('employees');
				}
			} else {
				$this->_errorMessageCreate = 'Please enter a valid email';
				$this->CRUDRouter('employees');
			}
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('employees');
		}
	}

	private function CRUDExecuterUsbAdd() {
		if ((isset($_POST['uuid']) && !empty($_POST['uuid'])) && (isset($_POST['brand']) && !empty($_POST['brand'])) && (isset($_POST['emailEmployee']) && !empty($_POST['emailEmployee']))) {
			$uuid = htmlspecialchars($_POST['uuid']);
			$brand = htmlspecialchars($_POST['brand']);
			$emailEmployee = htmlspecialchars($_POST['emailEmployee']);

			if (filter_var($emailEmployee, FILTER_VALIDATE_EMAIL)) {
				if ($this->_employeeManager->getOneEmployee($emailEmployee)) {
					date_default_timezone_set('Europe/Paris');
					$this->_usbManager->insertOneUsb(array('id' => $this->_usbManager->getMaximumUsb() + 1, 'uuid' => $uuid, 'brand' => $brand, 'registration' => date('Y-m-d H:i:s'), 'emailEmployee' => $emailEmployee));

					$this->_informationMessageCreate = 'The new USB has been correctly created';
				} else {
					$this->_errorMessageCreate = 'The email does not exist';
					$this->CRUDRouter('usbs');
				}
			} else {
				$this->_errorMessageCreate = 'Please enter a valid email';
				$this->CRUDRouter('usbs');
			}
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('usbs');
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

	private function CRUDExecuterExtensionUpdate() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$id = htmlspecialchars(($_POST['id']));
				$name = htmlspecialchars($_POST['name']);

				$extension = $this->_extensionManager->getOneExtension($id);

				if ($extension) {
					$this->_extensionManager->updateOneExtension($id, array('name' => $name));

					$this->_informationMessageOthers = 'The extension has been correctly updated';
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('extensions');
				}
			} else {
				$this->_errorMessageCreate = 'Please fill in all fields';
				$this->CRUDRouter('extensions');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('extensions');
		}
	}

	private function CRUDExecuterEmployeeUpdate() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['firstName']) && !empty($_POST['firstName'])) && (isset($_POST['lastName']) && !empty($_POST['lastName']))) {
				$id = htmlspecialchars(($_POST['id']));
				$email = htmlspecialchars($_POST['email']);
				$firstName = htmlspecialchars($_POST['firstName']);
				$lastName = htmlspecialchars($_POST['lastName']);

				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$employee = $this->_employeeManager->getOneEmployee($id);

					if ($employee) {
						$this->_employeeManager->updateOneEmployee($id, array('email' => $email, 'firstName' => $firstName, 'lastName' => $lastName));

						$this->_informationMessageOthers = 'The employee has been correctly updated';
					} else {
						$this->_errorMessageOthers = 'An error has occured';
						$this->CRUDRouter('employees');
					}
				} else {
					$this->_errorMessageOthers = 'Please enter a valid email';
					$this->CRUDRouter('employees');
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('employees');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('employees');
		}
	}

	private function CRUDExecuterUsbUpdate() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			if ((isset($_POST['idModified']) && !empty($_POST['idModified'])) && (isset($_POST['uuid']) && !empty($_POST['uuid'])) && (isset($_POST['brand']) && !empty($_POST['brand'])) && (isset($_POST['registration']) && !empty($_POST['registration'])) && (isset($_POST['emailEmployee']) && !empty($_POST['emailEmployee']))) {
				$idNotModified = htmlspecialchars($_POST['idNotModified']);
				$idModified = htmlspecialchars($_POST['idModified']);
				$uuid = htmlspecialchars($_POST['uuid']);
				$brand = htmlspecialchars($_POST['brand']);
				$registration = htmlspecialchars($_POST['registration']);
				$emailEmployee = htmlspecialchars($_POST['emailEmployee']);

				if (is_numeric($idNotModified)) {
					if (is_numeric($idModified)) {
						if (preg_match('/^([0-9]{4})-([0-1][0-9])-([0-3][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/', $registration)) {
							if (filter_var($emailEmployee, FILTER_VALIDATE_EMAIL)) {
								if (!$this->_usbManager->getOneUsb($idModified)) {
									if ($this->_employeeManager->getOneEmployee($emailEmployee)) {
										$this->_usbManager->updateOneUsb($idNotModified, array('id' => $idModified, 'uuid' => $uuid, 'brand' => $brand, 'registration' => $registration, 'emailEmployee' => $emailEmployee));

										$this->_informationMessageOthers = 'The USB has been correctly updated';
									} else {
										$this->_errorMessageOthers = 'The email does not exist';
										$this->CRUDRouter('usbs');
									}
								} else {
									$this->_errorMessageOthers = 'This ID is already in use';
									$this->CRUDRouter('usbs');
								}
							} else {
								$this->_errorMessageOthers = 'Please enter a valid email';
								$this->CRUDRouter('usbs');
							}
						} else {
							$this->_errorMessageOthers = 'Please enter a valid date';
							$this->CRUDRouter('usbs');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid ID';
						$this->CRUDRouter('usbs');
					}
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('usbs');
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('usbs');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('usbs');
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

	private function CRUDExecuterExtensionDelete() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$id = htmlspecialchars($_POST['id']);

			$extension = $this->_extensionManager->getOneExtension($id);

			if ($extension) {
				$this->_extensionManager->deleteOneExtension($id);

				$this->_informationMessageOthers = 'The extension has been correctly deleted';
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('extensions');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('extensions');
		}
	}

	private function CRUDExecuterEmployeeDelete() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$id = htmlspecialchars(($_POST['id']));

			$employee = $this->_employeeManager->getOneEmployee($id);

			if ($employee) {
				$this->_employeeManager->deleteOneEmployee($id);

				$this->_informationMessageOthers = 'The employee has been correctly deleted';
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('employees');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('employees');
		}
	}

	private function CRUDExecuterUsbDelete() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			$idNotModified = htmlspecialchars(($_POST['idNotModified']));

			if (is_numeric($idNotModified)) {

				$usb = $this->_usbManager->getOneUsb($idNotModified);

				if ($usb) {
					$this->_usbManager->deleteOneUsb($idNotModified);

					$this->_informationMessageOthers = 'The USB has been correctly deleted';
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('usbs');
				}
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('usbs');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('usbs');
		}
	}
}
