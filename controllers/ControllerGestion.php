<?php

class ControllerGestion {
	private $_view;
	private $_scanManager;
	private $_adminManager;
	private $_stationManager;
	private $_informationMessage = false;

	public function __construct($anURL) {
		if (count($anURL) > 1) {
			throw new Exception('Page not found');
		} else {
			$this->main();
		}
	}

	private function main() {
		$this->_scanManager = new ScanManager();
		$this->_adminManager = new AdminManager();
		$this->_adminManager->checkSession();

		if (isset($_POST['viruses'])) {
			system('/usr/bin/php /var/www/html/Proofiler_web/MailSender.php');
			$this->_informationMessage = 'The viruses mail report has been sent correctly';
		} else if (isset($_POST['configuration'])) {
			system('/usr/bin/php /var/www/html/Proofiler_web/ConfigurationSender.php');
			$this->_informationMessage = 'The configuration data has been sent correctly';
		}

		$stats = $this->_scanManager->usbsWithMostViruses();

		$this->_view = new View('Gestion');
		$this->_view->generate(array('informationMessage' => $this->_informationMessage, 'stats' => $stats));
	}
}
