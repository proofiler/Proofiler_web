<?php

class ControllerData {
	private $_scanManager;
	private $_adminManager;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found 1');
		} else if (!isset($_POST['data'])) {
			throw new Exception('Page not found 2');
		} else {
			$this->main($_POST['data']);
		}
	}

	private function main($someData) {
		$data = json_decode(base64_decode($someData));

		if ((isset($data->login) && !empty($data->login)) && (isset($data->hash) && !empty($data->hash)) && (isset($data->duration) && ($data->duration === 0 || !empty($data->duration))) && (isset($data->nbFiles) && ($data->nbFiles === 0 || !empty($data->nbFiles))) && (isset($data->nbVirus) && ($data->nbVirus === 0 || !empty($data->nbVirus))) && (isset($data->nbErrors) && ($data->nbErrors === 0 || !empty($data->nbErrors))) && (isset($data->uuidUsb) && ($data->uuidUsb === '0' || !empty($data->uuidUsb)))) {
			$login = htmlspecialchars($data->login);
			$hash = htmlspecialchars($data->hash);
			$duration = htmlspecialchars($data->duration);
			$nbFiles = htmlspecialchars($data->nbFiles);
			$nbVirus = htmlspecialchars($data->nbVirus);
			$nbErrors = htmlspecialchars($data->nbErrors);
			$uuidUsb = htmlspecialchars($data->uuidUsb);

			if ($login == 'raspberry@pr00filer.com') {
				$this->_adminManager = new AdminManager();

				if ($hash == $this->_adminManager->getOneAdmin($login)->getPassword()) {
					if (is_numeric($duration)) {
						if (is_numeric($nbFiles)) {
							if (is_numeric($nbVirus)) {
								if (is_numeric($nbErrors)) {
									$this->_usbManager = new UsbManager();

									if ($this->_usbManager->getOneUsb($uuidUsb)) {
										$this->_scanManager = new ScanManager();

										if ($nbVirus > 0) {
											if (isset($data->viruses) && !empty($data->viruses)) {
												if ((int) $nbVirus === count($data->viruses)) {
													$this->_virusManager = new VirusManager();
													date_default_timezone_set('Europe/Paris');

													$this->_scanManager->insertOneScan(array('id' => $this->_scanManager->getMaximumScan() + 1, 'dateScan' => date('Y-m-d H:i:s'), 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'uuidUsb' => $uuidUsb));

													foreach ($data->viruses as $virus) {
														$virusName = htmlspecialchars($virus->name);
														$virusHash = htmlspecialchars($virus->hash);

														$this->_virusManager->insertOneVirus(array('id' => $this->_virusManager->getMaximumVirus() + 1, 'name' => $virusName, 'hash' => $virusHash, 'idScan' => $this->_scanManager->getMaximumScan()));
													}
												}
											}
										} else {
											date_default_timezone_set('Europe/Paris');

											$this->_scanManager->insertOneScan(array('id' => $this->_scanManager->getMaximumScan() + 1, 'dateScan' => date('Y-m-d H:i:s'), 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'uuidUsb' => $uuidUsb));
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
