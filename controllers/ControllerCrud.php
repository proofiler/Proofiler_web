<?php

class ControllerCrud {
	private $_view;
	private $_usbManager;
	private $_scanManager;
	private $_adminManager;
	private $_virusManager;
	private $_stationManager;
	private $_employeeManager;
	private $_extensionManager;
	private $_errorMessageCreate = false;
	private $_errorMessageOthers = false;
	private $_informationMessageCreate = false;
	private $_informationMessageOthers = false;

	/**
	 * Redirects to an error page or to the main function according to the parameters provided via the URL
	 * @param array $anURL 
	 * @return void
	 */
	public function __construct($anURL) {
		if (count($anURL) != 2) {
			throw new Exception('Page not found');
		} else {
			$this->main($anURL);
		}
	}

	/**
	 * Redirects to the main router or the main executor according to the parameters sent
	 * @param array $anURL 
	 * @return void
	 */
	private function main($anURL) {
		$this->_usbManager = new UsbManager();
		$this->_scanManager = new ScanManager();
		$this->_adminManager = new AdminManager();
		$this->_virusManager = new VirusManager();
		$this->_stationManager = new StationManager();
		$this->_employeeManager = new EmployeeManager();
		$this->_extensionManager = new ExtensionManager();
		$this->_adminManager->checkSession();
		
		if (isset($_POST['add']) || isset($_POST['update']) || isset($_POST['delete'])) {
			$this->CRUDExecuter($anURL[1]);
		} else {
			$this->CRUDRouter($anURL[1]);
		}
	}

	/**
	 * Redirects to the correct CRUD router based on the parameter provided
	 * @param string $aCRUD 
	 * @return void
	 */
	private function CRUDRouter($aCRUD) {
		switch ($aCRUD) {
			case 'admins':
				$this->CRUDRouterAdmin();
				break;
			case 'extensions':
				$this->CRUDRouterExtension();
				break;
			case 'stations':
				$this->CRUDRouterStation();
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

	/**
	 * Redirects to the correct CRUD executor based on the provided parameter
	 * @param string $aCRUD 
	 * @return void
	 */
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
			case 'stations':
				if (isset($_POST['add'])) {
					$this->CRUDExecuterStationAdd();
				} else if (isset($_POST['update'])) {
					$this->CRUDExecuterStationUpdate();
				} else if (isset($_POST['delete'])) {
					$this->CRUDExecuterStationDelete();
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

	/**
	 * Redirects to the administrators CRUD view
	 * @return void
	 */
	private function CRUDRouterAdmin() {
		$admins = $this->_adminManager->getAllAdmins();

		$this->_view = new View('Crudadmin');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'admins' => $admins));
	}

	/**
	 * Redirects to the extensions CRUD view
	 * @return void
	 */
	private function CRUDRouterExtension() {
		$extensions = $this->_extensionManager->getAllExtensions();

		$this->_view = new View('Crudextension');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'extensions' => $extensions));
	}

	/**
	 * Redirects to the stations CRUD view
	 * @return void
	 */
	private function CRUDRouterStation() {
		$stations = $this->_stationManager->getAllStations();

		$this->_view = new View('Crudstation');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'stations' => $stations));
	}

	/**
	 * Redirects to the employees CRUD view
	 * @return void
	 */
	private function CRUDRouterEmployee() {
		$employees = $this->_employeeManager->getAllEmployees();

		$this->_view = new View('Crudemployee');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'employees' => $employees));
	}

	/**
	 * Redirects to the USBs CRUD view
	 * @return void
	 */
	private function CRUDRouterUsb() {
		$usbs = $this->_usbManager->getAllUsbs();

		$this->_view = new View('Crudusb');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'usbs' => $usbs));
	}

	/**
	 * Redirects to the scans CRUD view
	 * @return void
	 */
	private function CRUDRouterScan() {
		$scans = $this->_scanManager->getAllScans();

		$this->_view = new View('Crudscan');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'scans' => $scans));
	}

	/**
	 * Redirects to the viruses CRUD view
	 * @return void
	 */
	private function CRUDRouterVirus() {
		$viruses = $this->_virusManager->getAllViruses();

		$this->_view = new View('Crudvirus');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'viruses' => $viruses));
	}

	/**
	 * Verifies the information provided and adds the new administrator's information to the database
	 * @return void
	 */
	private function CRUDExecuterAdminAdd() {
		if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))) {
			$email = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST['password']);
			$passwordConfirmation = htmlspecialchars($_POST['confirmPassword']);

			if ($password === $passwordConfirmation) {
				if (preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
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
					$this->_errorMessageCreate = 'The password must have a minimum length of 8 characters and must be composed of at least one upper case letter one lower case letter one number and one special character';
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

	/**
	 * Verifies the information provided and adds the new extension's information to the database
	 * @return void
	 */
	private function CRUDExecuterExtensionAdd() {
		if ((isset($_POST['name']) && ($_POST['name'] === '0' || !empty($_POST['name'])))) {
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

	/**
	 * Verifies the information provided and adds the new station's information to the database
	 * @return void
	 */
	private function CRUDExecuterStationAdd() {
		if ((isset($_POST['ip']) && !empty($_POST['ip']))) {
			$ip = htmlspecialchars($_POST['ip']);

			if (filter_var($ip, FILTER_VALIDATE_IP)) {
				if (!$this->_stationManager->getOneStation($ip)) {
					$this->_stationManager->insertOneStation(array('ip' => $ip, 'hash' => bin2hex(hash('sha256', date('Y-m-d H:i:s').(float)rand() / (float)getrandmax().sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff))))));

					$this->_informationMessageCreate = 'The new station has been correctly created';
				} else {
					$this->_errorMessageCreate = 'This IP is already in use';
					$this->CRUDRouter('stations');
				}
			} else {
				$this->_errorMessageCreate = 'Please enter a valid IP';
				$this->CRUDRouter('stations');
			}
		} else {
			$this->_errorMessageCreate = 'Please fill in all fields';
			$this->CRUDRouter('stations');
		}
	}

	/**
	 * Verifies the information provided and adds the new employee's information to the database
	 * @return void
	 */
	private function CRUDExecuterEmployeeAdd() {
		if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['firstName']) && ($_POST['firstName'] === '0' || !empty($_POST['firstName']))) && (isset($_POST['lastName']) && ($_POST['lastName'] === '0' || !empty($_POST['lastName'])))) {
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

	/**
	 * Verifies the information provided and adds the new USB's information to the database
	 * @return void
	 */
	private function CRUDExecuterUsbAdd() {
		if ((isset($_POST['uuid']) && ($_POST['uuid'] === '0' || !empty($_POST['uuid']))) && (isset($_POST['brand']) && ($_POST['brand'] === '0' || !empty($_POST['brand']))) && (isset($_POST['emailEmployee']) && !empty($_POST['emailEmployee']))) {
			$uuid = htmlspecialchars($_POST['uuid']);
			$brand = htmlspecialchars($_POST['brand']);
			$emailEmployee = htmlspecialchars($_POST['emailEmployee']);

			if (filter_var($emailEmployee, FILTER_VALIDATE_EMAIL)) {
				if (!$this->_usbManager->getOneUsb($uuid)) {
					if ($this->_employeeManager->getOneEmployee($emailEmployee)) {
						date_default_timezone_set('Europe/Paris');
						$this->_usbManager->insertOneUsb(array('uuid' => $uuid, 'brand' => $brand, 'registration' => date('Y-m-d H:i:s'), 'emailEmployee' => $emailEmployee));

						$this->_informationMessageCreate = 'The new USB has been correctly created';
					} else {
						$this->_errorMessageCreate = 'The email does not exist';
						$this->CRUDRouter('usbs');
					}
				} else {
					$this->_errorMessageCreate = 'This UUID is already in use';
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

	/**
	 * Verifies the information provided and adds the new scan's information to the database
	 * @return void
	 */
	private function CRUDExecuterScanAdd() {
		if ((isset($_POST['duration']) && ($_POST['duration'] === '0' || !empty($_POST['duration']))) && (isset($_POST['nbFiles']) && ($_POST['nbFiles'] === '0' || !empty($_POST['nbFiles']))) && (isset($_POST['nbVirus']) && ($_POST['nbVirus'] === '0' || !empty($_POST['nbVirus']))) && (isset($_POST['nbErrors']) && ($_POST['nbErrors'] === '0' || !empty($_POST['nbErrors']))) && (isset($_POST['uuidUsb']) && ($_POST['uuidUsb'] === '0' || !empty($_POST['uuidUsb'])))) {
			$duration = htmlspecialchars($_POST['duration']);
			$nbFiles = htmlspecialchars($_POST['nbFiles']);
			$nbVirus = htmlspecialchars($_POST['nbVirus']);
			$nbErrors = htmlspecialchars($_POST['nbErrors']);
			$uuidUsb = htmlspecialchars($_POST['uuidUsb']);

			if (is_numeric($duration)) {
				if (is_numeric($nbFiles)) {
					if (is_numeric($nbVirus)) {
						if (is_numeric($nbErrors)) {
							if ($this->_usbManager->getOneUsb($uuidUsb)) {
								date_default_timezone_set('Europe/Paris');
								$this->_scanManager->insertOneScan(array('id' => $this->_scanManager->getMaximumScan() + 1, 'dateScan' => date('Y-m-d H:i:s'), 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'uuidUsb' => $uuidUsb));

								$this->_informationMessageCreate = 'The new scan has been correctly created';
							} else {
								$this->_errorMessageCreate = 'This ID does not exist';
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

	/**
	 * Verifies the information provided and adds the new virus information to the database
	 * @return void
	 */
	private function CRUDExecuterVirusAdd() {
		if ((isset($_POST['name']) && ($_POST['name'] === '0' || !empty($_POST['name']))) && (isset($_POST['hash']) && !empty($_POST['hash'])) && (isset($_POST['idScan']) && !empty($_POST['idScan']))) {
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

	/**
	 * Verifies the information provided and modifies the administrator's information in the database
	 * @return void
	 */
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
								if (preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $newPassword)) {
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
									$this->_errorMessageOthers = 'The password must have a minimum length of 8 characters and must be composed of at least one upper case letter one lower case letter one number and one special character';
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

	/**
	 * Verifies the information provided and modifies the extension's information in the database
	 * @return void
	 */
	private function CRUDExecuterExtensionUpdate() {
		if ((isset($_POST['nameNotModified']) && ($_POST['nameNotModified'] === '0' || !empty($_POST['nameNotModified'])))) {
			if ((isset($_POST['nameModified']) && ($_POST['nameModified'] === '0' || !empty($_POST['nameModified'])))) {
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

	/**
	 * Verifies the information provided and modifies the station's information in the database
	 * @return void
	 */
	private function CRUDExecuterStationUpdate() {
		if (isset($_POST['ipNotModified']) && !empty($_POST['ipNotModified']) && (isset($_POST['hashNotModified']) && !empty($_POST['hashNotModified']))) {
			if ((isset($_POST['ipModified']) && !empty($_POST['ipModified'])) && (isset($_POST['hashModified']) && ($_POST['hashModified'] === '0' || !empty($_POST['hashModified'])))) {
				$ipNotModified = htmlspecialchars(($_POST['ipNotModified']));
				$hashNotModified = htmlspecialchars($_POST['hashNotModified']);
				$ipModified = htmlspecialchars($_POST['ipModified']);
				$hashModified = htmlspecialchars($_POST['hashModified']);
				$hash = htmlspecialchars($_POST['hash']);

				if (filter_var($ipNotModified, FILTER_VALIDATE_IP)) {
					if (filter_var($ipModified, FILTER_VALIDATE_IP)) {
						if (($ipNotModified === $ipModified) || ($ipNotModified !== $ipModified) && !$this->_stationManager->getOneStation($ipModified)) {
							if (($hashNotModified === $hashModified) || ($hashNotModified !== $hashModified) && !$this->_stationManager->getOneHashStation($hashModified)) {
								if ($this->_stationManager->getOneStation($ipNotModified)) {
									$this->_stationManager->updateOneStation($ipNotModified, array('ip' => $ipModified, 'hash' => $hashModified));

									$this->_informationMessageOthers = 'The station has been correctly updated';
								} else {
									$this->_errorMessageOthers = 'An error has occured';
									$this->CRUDRouter('stations');
								}
							} else {
								$this->_errorMessageOthers = 'This hash is already in use';
								$this->CRUDRouter('stations');
							}
						} else {
							$this->_errorMessageOthers = 'This IP is already in use';
							$this->CRUDRouter('stations');
						}
					} else {
						$this->_errorMessageOthers = 'Please enter a valid IP';
						$this->CRUDRouter('stations');
					}
				} else {
					$this->_errorMessageOthers = 'An error has occurred';
					$this->CRUDRouter('stations');
				}
			} else {
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('stations');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('stations');
		}
	}

	/**
	 * Verifies the information provided and modifies the employee's information in the database
	 * @return void
	 */
	private function CRUDExecuterEmployeeUpdate() {
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			if ((isset($_POST['emailModified']) && !empty($_POST['emailModified'])) && (isset($_POST['firstName']) && ($_POST['firstName'] === '0' || !empty($_POST['firstName']))) && (isset($_POST['lastName']) && ($_POST['lastName'] === '0' || !empty($_POST['lastName'])))) {
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

	/**
	 * Verifies the information provided and modifies the USB's information in the database
	 * @return void
	 */
	private function CRUDExecuterUsbUpdate() {
		if ((isset($_POST['uuidNotModified']) && ($_POST['uuidNotModified'] === '0' || !empty($_POST['uuidNotModified'])))) {
			if ((isset($_POST['uuidModified']) && ($_POST['uuidModified'] === '0' || !empty($_POST['uuidModified']))) && (isset($_POST['brand']) && ($_POST['brand'] === '0' || !empty($_POST['brand']))) && (isset($_POST['registration']) && !empty($_POST['registration'])) && (isset($_POST['emailEmployee']) && !empty($_POST['emailEmployee']))) {
				$uuidNotModified = htmlspecialchars($_POST['uuidNotModified']);
				$uuidModified = htmlspecialchars($_POST['uuidModified']);
				$brand = htmlspecialchars($_POST['brand']);
				$registration = htmlspecialchars($_POST['registration']);
				$emailEmployee = htmlspecialchars($_POST['emailEmployee']);

				if (preg_match('/^([0-9]{4})-([0-1][0-9])-([0-3][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/', $registration)) {
					if (filter_var($emailEmployee, FILTER_VALIDATE_EMAIL)) {
						if (($uuidNotModified === $uuidModified) || ($uuidNotModified !== $uuidModified) && !$this->_usbManager->getOneUsb($uuidModified)) {
							if ($this->_employeeManager->getOneEmployee($emailEmployee)) {
								$this->_usbManager->updateOneUsb($uuidNotModified, array('uuid' => $uuidModified, 'brand' => $brand, 'registration' => $registration, 'emailEmployee' => $emailEmployee));

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
				$this->_errorMessageOthers = 'Please fill in all fields';
				$this->CRUDRouter('usbs');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('usbs');
		}
	}

	/**
	 * Verifies the information provided and modifies the scan's information in the database
	 * @return void
	 */
	private function CRUDExecuterScanUpdate() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			if ((isset($_POST['idModified']) && !empty($_POST['idModified'])) && (isset($_POST['dateScan']) && !empty($_POST['dateScan'])) && (isset($_POST['duration']) && ($_POST['duration'] === '0' || !empty($_POST['duration']))) && (isset($_POST['nbFiles']) && ($_POST['nbFiles'] === '0' || !empty($_POST['nbFiles']))) && (isset($_POST['nbVirus']) && ($_POST['nbVirus'] === '0' || !empty($_POST['nbVirus']))) && (isset($_POST['nbErrors']) && ($_POST['nbErrors'] === '0' || !empty($_POST['nbErrors']))) && (isset($_POST['uuidUsb']) && ($_POST['uuidUsb'] === '0' || !empty($_POST['uuidUsb'])))) {
				$idNotModified = htmlspecialchars($_POST['idNotModified']);
				$idModified = htmlspecialchars($_POST['idModified']);
				$dateScan = htmlspecialchars($_POST['dateScan']);
				$duration = htmlspecialchars($_POST['duration']);
				$nbFiles = htmlspecialchars($_POST['nbFiles']);
				$nbVirus = htmlspecialchars($_POST['nbVirus']);
				$nbErrors = htmlspecialchars($_POST['nbErrors']);
				$uuidUsb = htmlspecialchars($_POST['uuidUsb']);

				if (is_numeric($idNotModified)) {
					if (is_numeric($idModified)) {
						if (preg_match('/^([0-9]{4})-([0-1][0-9])-([0-3][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/', $dateScan)) {
							if (is_numeric($duration)) {
								if (is_numeric($nbFiles)) {
									if (is_numeric($nbVirus)) {
										if (is_numeric($nbErrors)) {
											if (($idNotModified === $idModified) || ($idNotModified !== $idModified) && !$this->_scanManager->getOneScan($idModified)) {
												if ($this->_usbManager->getOneUsb($uuidUsb)) {
													$this->_scanManager->updateOneScan($idNotModified, array('id' => $idModified, 'dateScan' => $dateScan, 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'uuidUsb' => $uuidUsb));

													$this->_informationMessageOthers = 'The scan has been correctly updated';
												} else {
													$this->_errorMessageOthers = 'This USB UUID does not exist';
													$this->CRUDRouter('scans');
												}
											} else {
												$this->_errorMessageOthers = 'This ID is already in use';
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

	/**
	 * Verifies the information provided and modifies the virus information in the database
	 * @return void
	 */
	private function CRUDExecuterVirusUpdate() {
		if (isset($_POST['idNotModified']) && !empty($_POST['idNotModified'])) {
			if ((isset($_POST['idModified']) && !empty($_POST['idModified'])) && (isset($_POST['name']) && ($_POST['name'] === '0' || !empty($_POST['name']))) && (isset($_POST['hash']) && !empty($_POST['hash'])) && (isset($_POST['idScan']) && !empty($_POST['idScan']))) {
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

	/**
	 * Verifies the information provided and removes the administrator's information from the database.
	 * @return void
	 */
	private function CRUDExecuterAdminDelete() {
		if (isset($_POST['emailNotModified']) && !empty($_POST['emailNotModified'])) {
			$emailNotModified = htmlspecialchars($_POST['emailNotModified']);

			$admin = $this->_adminManager->getOneAdmin($emailNotModified);
			if ($admin) {
				if ($admin->getEmail() != 'raspberry@pr00filer.com' && $admin->getEmail() != 'pr00filer@pr00filer.com') {
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

	/**
	 * Verifies the information provided and removes the extension's information from the database.
	 * @return void
	 */
	private function CRUDExecuterExtensionDelete() {
		if ((isset($_POST['nameNotModified']) && ($_POST['nameNotModified'] === '0' || !empty($_POST['nameNotModified'])))) {
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

	/**
	 * Verifies the information provided and removes the station's information from the database.
	 * @return void
	 */
	private function CRUDExecuterStationDelete() {
		if (isset($_POST['ipNotModified']) && !empty($_POST['ipNotModified'])) {
			$ipNotModified = htmlspecialchars(($_POST['ipNotModified']));

			if ($this->_stationManager->getOneStation($ipNotModified)) {
				$this->_stationManager->deleteOneStation($ipNotModified);

				$this->_informationMessageOthers = 'The station has been correctly deleted';
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('stations');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('stations');
		}
	}

	/**
	 * Verifies the information provided and removes the employee's information from the database.
	 * @return void
	 */
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

	/**
	 * Verifies the information provided and removes the USB's information from the database.
	 * @return void
	 */
	private function CRUDExecuterUsbDelete() {
		if ((isset($_POST['uuidNotModified']) && ($_POST['uuidNotModified'] === '0' || !empty($_POST['uuidNotModified'])))) {
			$uuidNotModified = htmlspecialchars(($_POST['uuidNotModified']));

			if ($this->_usbManager->getOneUsb($uuidNotModified)) {
				$this->_usbManager->deleteOneUsb($uuidNotModified);

				$this->_informationMessageOthers = 'The USB has been correctly deleted';
			} else {
				$this->_errorMessageOthers = 'An error has occurred';
				$this->CRUDRouter('usbs');
			}
		} else {
			$this->_errorMessageOthers = 'An error has occurred';
			$this->CRUDRouter('usbs');
		}
	}

	/**
	 * Verifies the information provided and removes the scan's information from the database.
	 * @return void
	 */
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

	/**
	 * Verifies the information provided and removes the virus information from the database.
	 * @return void
	 */
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
