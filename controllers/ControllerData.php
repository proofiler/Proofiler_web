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
		
		if ((isset($data->login) && !empty($data->login)) && (isset($data->hash) && !empty($data->hash)) && (isset($data->duration) && ($data->duration === 0 || !empty($data->duration))) && (isset($data->nbFiles) && ($data->nbFiles === 0 || !empty($data->nbFiles))) && (isset($data->nbVirus) && ($data->nbVirus === 0 || !empty($data->nbVirus))) && (isset($data->nbErrors) && ($data->nbErrors === 0 || !empty($data->nbErrors)))) { //Ajouter check idUSB
			$login = htmlspecialchars($data->login);
			$hash = htmlspecialchars($data->hash);
			$duration = htmlspecialchars($data->duration);
			$nbFiles = htmlspecialchars($data->nbFiles);
			$nbVirus = htmlspecialchars($data->nbVirus);
			$nbErrors = htmlspecialchars($data->nbErrors);
			//Ajouter htmlspecialchars idUSB

			if ($login == 'raspberry@pr00filer.com') {
				$this->_adminManager = new AdminManager();

				if ($hash == $this->_adminManager->getOneAdmin($login)->getPassword()) {
					if (is_numeric($duration)) {
						if (is_numeric($nbFiles)) {
							if (is_numeric($nbVirus)) {
								if (is_numeric($nbErrors)) {
									//Ajouter if is_numeric idUSB
									date_default_timezone_set('Europe/Paris');

									$this->_scanManager = new ScanManager;
									$this->_scanManager->insertOneScan(array('id' => $this->_scanManager->getMaximumScan() + 1, 'dateScan' => date('Y-m-d H:i:s'), 'duration' => $duration, 'nbFiles' => $nbFiles, 'nbVirus' => $nbVirus, 'nbErrors' => $nbErrors, 'idUsb' => 1)); //Modifier idUSB avec $idUSB
								}
							}
						}
					}
				}
			}
		}
	}
}
