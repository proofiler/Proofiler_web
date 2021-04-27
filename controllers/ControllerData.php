<?php

class ControllerData {
	private $_adminManager;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else if (!isset($_POST['data'])) {
			throw new Exception('Page not found');
		} else {
			$this->main($_POST['data']);
		}
	}

	private function main($someData) {
		$data = json_decode(base64_decode($someData));

		if ((isset($data->login) && !empty($data->login)) && (isset($data->hash) && !empty($data->hash)) && (isset($data->duration) && ($data->duration === 0 || !empty($data->duration))) && (isset($data->nbFiles) && ($data->nbFiles === 0 || !empty($data->nbFiles))) && (isset($data->nbVirus) && ($data->nbVirus === 0 || !empty($data->nbVirus))) && (isset($data->nbErrors) && ($data->nbErrors === 0 || !empty($data->nbErrors)))) {
			$login = htmlspecialchars($data->login);
			$hash = htmlspecialchars($data->hash);
			$duration = htmlspecialchars($data->duration);
			$nbFiles = htmlspecialchars($data->nbFiles);
			$nbVirus = htmlspecialchars($data->nbVirus);
			$nbErrors = htmlspecialchars($data->nbErrors);

			if ($login == 'raspberry@pr00filer.com') {
				$this->_adminManager = new AdminManager();

				if ($hash == $this->_adminManager->getOneAdmin($login)->getPassword()) {
					echo $login;
				}
			}
		}
	}
}
