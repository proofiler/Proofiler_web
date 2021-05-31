<?php

class ControllerDashboard {
	private $_view;
	private $_scanManager;
	private $_virusManager;
	private $_informationMessage = false;

	public function __construct($anURL) {
		if (count($anURL) != 2) {
			throw new Exception('Page not found');
		} else {
			$this->main($anURL);
		}
	}

	private function main($anURL) {
		$this->_scanManager = new ScanManager();
		$this->_virusManager = new VirusManager();

		$this->dashboardRouter($anURL[1]);
	}

	private function dashboardRouter($anEndpoint) {
		switch ($anEndpoint) {
			case 'information':
				$this->dashboardInformation();
				break;
			case 'top':
				$this->dashboardTop();
				break;
			default:
				throw new Exception('Page not found');
				break;
		}
	}

	private function dashboardInformation() {
		$nbFiles = $this->_scanManager->getSumFile();
		$nbScans = $this->_scanManager->getCountScan();
		$nbViruses = $this->_virusManager->getCountVirus();
		$nbAverageVirus = $this->_virusManager->getVirusPerMonth() ;
		$nbAverageTimeScan = intval($this->_scanManager->getSumDuration() / $this->_scanManager->getCountScan());

		$this->_view = new View('DashboardInformation');
		$this->_view->generate(array('informationMessage' => $this->_informationMessage, 'nbFiles' => $nbFiles, 'nbScans' => $nbScans, 'nbViruses' => $nbViruses, 'nbAverageVirus' => $nbAverageVirus, 'nbAverageTimeScan' => $nbAverageTimeScan));
	}

	private function dashboardTop() {
		$viruses = $this->_virusManager->getCountVirusBy();

		$this->_view = new View('DashboardTop');
		$this->_view->generate(array('informationMessage' => $this->_informationMessage, 'viruses' => $viruses));
	}
}
