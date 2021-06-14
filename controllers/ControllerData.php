<?php

class ControllerData {
	private $_scanManager;
	private $_adminManager;

	/**
	 * Redirects to an error page or to the main function according to the parameters provided via the URL
	 * @param array $anURL 
	 * @return void
	 */
	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found 1');
		} else if (!isset($_POST['data'])) {
			throw new Exception('Page not found 2');
		} else {
			$this->main($_POST['data']);
		}
	}

	/**
	 * Verifies the information provided and adds the information from the scan and potential associated viruses to the database
	 * @param string $someData 
	 * @return void
	 */
	private function main($someData) {
		$data = $this->my_decrypt($someData);
		$data = json_decode(base64_decode($data));

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

	/**
	 * Decrypting the received data
	 * @param string $data 
	 * @param string $passphrase 
	 * @return string
	 */
	private function my_decrypt($data, $passphrase='5cd10f8a394a241beae003415a1b4569672696468c5aec18f880d1eb2043ad0c') {
		$secret_key = hex2bin($passphrase);
		$json = json_decode(base64_decode($data));
		$iv = base64_decode($json->{'iv'});
		$encrypted_64 = $json->{'data'};
		$data_encrypted = base64_decode($encrypted_64);
		$decrypted = openssl_decrypt($data_encrypted, 'aes-256-cbc', $secret_key, OPENSSL_RAW_DATA, $iv);
		return $decrypted;
	}
}
