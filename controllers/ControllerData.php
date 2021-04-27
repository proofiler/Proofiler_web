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
		//Voir ou assainir les données (avant basedecode ? avant jsondecode ? juste les valeurs finales ? Partout ?)

		$data = json_decode(base64_decode($someData));

		if (isset($data->login) && !empty($data->login)) {
			echo $data->login;
		} else {
			echo 'KO';
		}
	}
}
