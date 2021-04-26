<?php

class ControllerCrud {
	private $_view;
	private $_usbManager;
	private $_scanManager;
	private $_adminManager;
	private $_virusManager;
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
		$this->_scanManager = new ScanManager();
		$this->_adminManager = new AdminManager();
		$this->_virusManager = new VirusManager();
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
			case 'scans':
				$this->CRUDRouterScan();
				break;
			case 'viruses':
				$this->CRUDRouterVirus();
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
			case 'scans':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterScanAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterScanUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterScanDelete();
				} else {
					throw new Exception('Page not found');
				}

				$this->CRUDRouter($aCRUD);
				break;
			case 'viruses':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterVirusAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterVirusUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterVirusDelete();
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

	private function CRUDRouterScan() {
		$scans = $this->_scanManager->getAllScans();

		$this->_view = new View('Crudscan');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'scans' => $scans));
	}

	private function CRUDRouterVirus() {
		$viruses = $this->_virusManager->getAllViruses();

		$this->_view = new View('Crudvirus');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'viruses' => $viruses));
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

	private function CRUDExecuterScanAdd() {
		if ((isset($_POST['duration']) && !empty($_POST['duration'])) && (isset($_POST['nbFiles']) && !empty($_POST['nbFiles'])) && (isset($_POST['nbVirus']) && !empty($_POST['nbVirus'])) && (isset($_POST['nbErrors']) && !empty($_POST['nbErrors'])) && (isset($_POST['idUsb']) && !empty($_POST['idUsb']))) {
			$duration = htmlspecialchars($_POST['duration']);
			$nbFiles = htmlspecialchars($_POST['nbFiles']);
			$nbVirus = htmlspecialchars($_POST['nbVirus']);
			$nbErrors = htmlspecialchars($_POST['nbErrors']);
			$idUsb = htmlspecialchars($_POST['idUsb']);

			if (is_numeric($duration)) {
				if (is_numeric($nbFiles)) {
					if (is_numeric($nbVirus)) {
						if (is_numeric($nbErrors)) {
							if (is_numeric($idUsb)) {
								if ($this->_usbManager->getOneUsb($idUsb)) {
									date_default_timezone_set('Europe/Paris');
									$this->_scanManager->insertOneScan(array('id' => $this->_scanManager->getMaximumScan() + 1, 'dateScan' => date('Y-m-d H:i:s'), 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'idUsb' => $idUsb));

									$this->_informationMessageCreate = 'The new scan has been correctly created';
								} else {
									$this->_errorMessageCreate = 'This ID does not exist';
									$this->CRUDRouter('scans');
								}
							} else {
								$this->_errorMessageCreate = 'Please enter a valid ID';
								$this->CRUDRouter('scans');
							}
						} else {
							$this->_errorMessageCreate = 'Please enter a valid number of errors';
							$this->CRUDRouter('scans');
						}
					} else {
						$this->_errorMessageCreate = 'Please enter a valid number of virus';
						$this->CRUDRouter('scans');
					}
				} else {
					$this->_errorMessageCreate = 'Please enter a valid number of files';
					$this->CRUDRouter('scans');
				}
			} else {
				$this->_errorMessageCreate = 'Please enter a valid duration';
				$this->CRUDRouter('scans');
			}
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('scans');
		}
	}

	private function CRUDExecuterVirusAdd() {
		if ((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['hash']) && !empty($_POST['hash'])) && (isset($_POST['idScan']) && !empty($_POST['idScan']))) {
			$name = htmlspecialchars($_POST['name']);
			$hash = htmlspecialchars($_POST['hash']);
			$idScan = htmlspecialchars($_POST['idScan']);

			if (is_numeric($idScan)) {
				if ($this->_scanManager->getOneScan($idScan)) {
					$this->_virusManager->insertOneVirus(array('id' => $this->_virusManager->getMaximumVirus() + 1, 'name' => $name, 'hash' => $hash, 'idScan' => $idScan));

					$this->_informationMessageCreate = 'The new virus has been correctly created';
				} else {
					$this->_errorMessageCreate = 'This ID does not exist';
					$this->CRUDRouter('viruses');
				}
			} else {
				$this->_errorMessageCreate = 'Please enter a valid ID';
				$this->CRUDRouter('viruses');
			}
		}
	}

	private function CRUDExecuterAdminUpdate() {
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			if (filter_var($_POST['emailNotModified'], FILTER_VALIDATE_EMAIL)) {
				if (isset($_POST['emailModified']) && !empty($_POST['emailModified']) && (isset($_POST['oldPassword']) && !empty($_POST['oldPassword']))) {
					if ((isset($_POST['newPassword']) && !empty($_POST['newPassword'])) || (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
						if ((isset($_POST['newPassword']) && !empty($_POST['newPassword'])) && (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
							$emailNotModified = htmlspecialchars($_POST['emailNotModified']);
							$emailModified = htmlspecialchars($_POST['emailModified']);
							$oldPassword = htmlspecialchars($_POST['oldPassword']);
							$newPassword = htmlspecialchars($_POST['newPassword']);
							$passwordConfirmation = htmlspecialchars($_POST['confirmPassword']);

							if ($newPassword === $passwordConfirmation) {
								if (filter_var($emailModified, FILTER_VALIDATE_EMAIL)) {
									if (($emailNotModified === $emailModified) || ($emailNotModified !== $emailModified) && !$this->_adminManager->getOneAdmin($emailModified)) {
										$admin = $this->_adminManager->getOneAdmin($emailNotModified);

										if ($admin) {
											if (password_verify($oldPassword, $admin->getPassword())) {
												$this->_adminManager->updateOneAdmin($emailNotModified, array('email' => $emailModified, 'password' => $newPassword));

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
										$this->_errorMessageOthers = 'This email is already in use';
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
						$emailNotModified = htmlspecialchars($_POST['emailNotModified']);
						$emailModified = htmlspecialchars($_POST['emailModified']);
						$oldPassword = htmlspecialchars($_POST['oldPassword']);

						if (filter_var($_POST['emailModified'], FILTER_VALIDATE_EMAIL)) {
							if (($emailNotModified === $emailModified) || ($emailNotModified !== $emailModified) && !$this->_adminManager->getOneAdmin($emailModified)) {
								$admin = $this->_adminManager->getOneAdmin($emailNotModified);

								if ($admin) {
									if (password_verify($oldPassword, $admin->getPassword())) {
										$this->_adminManager->updateOneAdmin($emailNotModified, array('email' => $emailModified));

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
								$this->_errorMessageOthers = 'This email is already in use';
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
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('admins');
		}
	}

	private function CRUDExecuterExtensionUpdate() {
		if (isset($_POST['nameNotModified']) && !empty($_POST['nameNotModified'])) {
			if (isset($_POST['nameModified']) && !empty($_POST['nameModified'])) {
				$nameNotModified = htmlspecialchars(($_POST['nameNotModified']));
				$nameModified = htmlspecialchars($_POST['nameModified']);

				if (($nameNotModified === $nameModified) || ($nameNotModified !== $nameModified) && !$this->_extensionManager->getOneExtension($nameModified)) {
					if ($this->_extensionManager->getOneExtension($nameNotModified)) {
						$this->_extensionManager->updateOneExtension($nameNotModified, array('name' => $nameModified));

						$this->_informationMessageOthers = 'The extension has been correctly updated';
					} else {
						$this->_errorMessageOthers = 'An error has occurred';
						$this->CRUDRouter('extensions');
					}
				} else {
					$this->_errorMessageOthers = 'This extension is already in use';
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
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			if ((isset($_POST['emailModified']) && !empty($_POST['emailModified'])) && (isset($_POST['firstName']) && !empty($_POST['firstName'])) && (isset($_POST['lastName']) && !empty($_POST['lastName']))) {
				$emailNotModified = htmlspecialchars(($_POST['emailNotModified']));
				$emailModified = htmlspecialchars($_POST['emailModified']);
				$firstName = htmlspecialchars($_POST['firstName']);
				$lastName = htmlspecialchars($_POST['lastName']);

				if (filter_var($emailNotModified, FILTER_VALIDATE_EMAIL)) {
					if (filter_var($emailModified, FILTER_VALIDATE_EMAIL)) {
						if (($emailNotModified === $emailModified) || ($emailNotModified !== $emailModified) && !$this->_employeeManager->getOneEmployee($emailModified)) {
							if ($this->_employeeManager->getOneEmployee($emailNotModified)) {
								$this->_employeeManager->updateOneEmployee($emailNotModified, array('email' => $emailModified, 'firstName' => $firstName, 'lastName' => $lastName));

								$this->_informationMessageOthers = 'The employee has been correctly updated';
							} else {
								$this->_errorMessageOthers = 'An error has occured';
								$this->CRUDRouter('employees');
							}
						} else {
							$this->_errorMessageOthers = 'This email is already in use';
							$this->CRUDRouter('employees');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid email';
						$this->CRUDRouter('employees');
					}
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
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
								if (($idNotModified === $idModified) || ($idNotModified !== $idModified) && !$this->_usbManager->getOneUsb($idModified)) {
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

	private function CRUDExecuterScanUpdate() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			if ((isset($_POST['idModified']) && !empty($_POST['idModified'])) && (isset($_POST['dateScan']) && !empty($_POST['dateScan'])) && (isset($_POST['duration']) && ($_POST['duration'] === '0' || !empty($_POST['duration']))) && (isset($_POST['nbFiles']) && ($_POST['nbFiles'] === '0' || !empty($_POST['nbFiles']))) && (isset($_POST['nbVirus']) && ($_POST['nbVirus'] === '0' || !empty($_POST['nbVirus']))) && (isset($_POST['nbErrors']) && ($_POST['nbErrors'] === '0' || !empty($_POST['nbErrors']))) && (isset($_POST['idUsb']) && !empty($_POST['idUsb']))) {
				$idNotModified = htmlspecialchars($_POST['idNotModified']);
				$idModified = htmlspecialchars($_POST['idModified']);
				$dateScan = htmlspecialchars($_POST['dateScan']);
				$duration = htmlspecialchars($_POST['duration']);
				$nbFiles = htmlspecialchars($_POST['nbFiles']);
				$nbVirus = htmlspecialchars($_POST['nbVirus']);
				$nbErrors = htmlspecialchars($_POST['nbErrors']);
				$idUsb = htmlspecialchars($_POST['idUsb']);

				if (is_numeric($idNotModified)) {
					if (is_numeric($idModified)) {
						if (preg_match('/^([0-9]{4})-([0-1][0-9])-([0-3][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/', $dateScan)) {
							if (is_numeric($duration)) {
								if (is_numeric($nbFiles)) {
									if (is_numeric($nbVirus)) {
										if (is_numeric($nbErrors)) {
											if (is_numeric($idUsb)) {
												if (($idNotModified === $idModified) || ($idNotModified !== $idModified) && !$this->_scanManager->getOneScan($idModified)) {
													if ($this->_usbManager->getOneUsb($idUsb)) {
														$this->_scanManager->updateOneScan($idNotModified, array('id' => $idModified, 'dateScan' => $dateScan, 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'idUsb' => $idUsb));

														$this->_informationMessageOthers = 'The scan has been correctly updated';
													} else {
														$this->_errorMessageOthers = 'This USB ID does not exist';
														$this->CRUDRouter('scans');
													}
												} else {
													$this->_errorMessageOthers = 'This ID is already in use';
													$this->CRUDRouter('scans');
												}
											} else {
												$this->_errorMessageOthers = 'Please enter a valid USB ID';
												$this->CRUDRouter('scans');
											}
										} else {
											$this->_errorMessageOthers = 'Please enter a valid number of errors';
											$this->CRUDRouter('scans');
										}
									} else {
										$this->_errorMessageOthers = 'Please enter a valid number of virus';
										$this->CRUDRouter('scans');
									}
								} else {
									$this->_errorMessageOthers = 'Please enter a valid number of files';
									$this->CRUDRouter('scans');
								}
							} else {
								$this->_errorMessageOthers = 'Please enter a valid duration';
								$this->CRUDRouter('scans');
							}
						} else {
							$this->_errorMessageOthers = 'Please enter a valid date';
							$this->CRUDRouter('scans');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid ID';
						$this->CRUDRouter('scans');
					}
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('scans');
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('scans');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('scans');
		}
	}

	private function CRUDExecuterVirusUpdate() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			if ((isset($_POST['idModified']) && !empty($_POST['idModified'])) && (isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['hash']) && !empty($_POST['hash'])) && (isset($_POST['idScan']) && !empty($_POST['idScan']))) {
				$idNotModified = htmlspecialchars($_POST['idNotModified']);
				$idModified = htmlspecialchars($_POST['idModified']);
				$name = htmlspecialchars($_POST['name']);
				$hash = htmlspecialchars($_POST['hash']);
				$idScan = htmlspecialchars($_POST['idScan']);

				if (is_numeric($idNotModified)) {
					if (is_numeric($idModified)) {
						if (is_numeric($idScan)) {
							if (($idNotModified === $idModified) || ($idNotModified !== $idModified) && !$this->_virusManager->getOneVirus($idModified)) {
								if ($this->_scanManager->getOneScan($idScan)) {
									$this->_virusManager->updateOneVirus($idNotModified, array('id' => $idModified, 'name' => $name, 'hash' => $hash, 'idScan' => $idScan));

									$this->_informationMessageOthers = 'The virus has been correctly updated';
								} else {
									$this->_errorMessageOthers = 'This scan ID does not exist';
									$this->CRUDRouter('viruses');
								}
							} else {
								$this->_errorMessageOthers = 'This ID is already in use';
								$this->CRUDRouter('viruses');
							}
						} else {
							$this->_errorMessageOthers = 'Please enter a valid scan ID';
							$this->CRUDRouter('viruses');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid ID';
						$this->CRUDRouter('viruses');
					}
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('viruses');
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('viruses');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('viruses');
		}
	}

	private function CRUDExecuterAdminDelete() {
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			$emailNotModified = htmlspecialchars($_POST['emailNotModified']);

			$admin = $this->_adminManager->getOneAdmin($emailNotModified);
			if ($admin) {
				if ($admin->getEmail() != 'pr00filer@pr00filer.com') {
					$this->_adminManager->deleteOneAdmin($emailNotModified);

					$this->_informationMessageOthers = 'The administrator has been correctly deleted';
				} else {
					$this->_errorMessageOthers = 'This administrator cannot be removed';
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
		if (isset($_POST['nameNotModified']) && !empty($_POST['nameNotModified'])) {
			$nameNotModified = htmlspecialchars($_POST['nameNotModified']);

			if ($this->_extensionManager->getOneExtension($nameNotModified)) {
				$this->_extensionManager->deleteOneExtension($nameNotModified);

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
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			$emailNotModified = htmlspecialchars(($_POST['emailNotModified']));

			if ($this->_employeeManager->getOneEmployee($emailNotModified)) {
				$this->_employeeManager->deleteOneEmployee($emailNotModified);

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
				if ($this->_usbManager->getOneUsb($idNotModified)) {
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

	private function CRUDExecuterScanDelete() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			$idNotModified = htmlspecialchars(($_POST['idNotModified']));

			if (is_numeric($idNotModified)) {
				if ($this->_scanManager->getOneScan($idNotModified)) {
					$this->_scanManager->deleteOneScan($idNotModified);

					$this->_informationMessageOthers = 'The scan has been correctly deleted';
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

	private function CRUDExecuterVirusDelete() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			$idNotModified = htmlspecialchars(($_POST['idNotModified']));

			if (is_numeric($idNotModified)) {
				if ($this->_virusManager->getOneVirus($idNotModified)) {
					$this->_virusManager->deleteOneVirus($idNotModified);

					$this->_informationMessageOthers = 'The virus has been correctly deleted';
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
