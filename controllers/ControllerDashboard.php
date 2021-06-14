<?php

class ControllerDashboard {
	private $_view;
	private $_scanManager;
	private $_virusManager;
	private $_informationMessage = false;

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
	 * Redirects to the dashboard router according to the parameters sent
	 * @param array $anURL 
	 * @return void
	 */
	private function main($anURL) {
		$this->_scanManager = new ScanManager();
		$this->_virusManager = new VirusManager();

		$this->dashboardRouter($anURL[1]);
	}

	/**
	 * Redirects to the dashboard functions based on the parameter provided
	 * @param string $aCRUD 
	 * @return void
	 */
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

	/**
	 * Redirects to the information dashboard view
	 * @return void
	 */
	private function dashboardInformation() {
		$nbFiles = $this->_scanManager->getSumFile();
		$nbScans = $this->_scanManager->getCountScan();
		$nbViruses = $this->_virusManager->getCountVirus();
		$nbAverageVirus = $this->_virusManager->getVirusPerMonth() ;
		$nbAverageTimeScan = intval($this->_scanManager->getSumDuration() / $this->_scanManager->getCountScan());

		$this->_view = new View('DashboardInformation');
		$this->_view->generate(array('informationMessage' => $this->_informationMessage, 'nbFiles' => $nbFiles, 'nbScans' => $nbScans, 'nbViruses' => $nbViruses, 'nbAverageVirus' => $nbAverageVirus, 'nbAverageTimeScan' => $nbAverageTimeScan));
	}

	/**
	 * Redirects to the top dashboard view
	 * @return void
	 */
	private function dashboardTop() {
		$viruses = $this->_virusManager->getCountVirusBy();

		$this->_view = new View('DashboardTop');
		$this->_view->generate(array('informationMessage' => $this->_informationMessage, 'viruses' => $viruses));
	}
}
