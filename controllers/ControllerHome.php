<?php

class ControllerHome {
	private $_view;
	private $_scanManager;
	private $_virusManager;
	private $_errorMessageCreate = false;
	private $_errorMessageOthers = false;
	private $_informationMessageCreate = false;
	private $_informationMessageOthers = false;


	public function __construct($anURL) {
		if ((count($anURL) == 0) || (count($anURL) == 1)) {
			$this->main();
		}
		else if (count($anURL) == 2) {
			$this->HomeRouter($anURL[1]);
		} 
		else {
			throw new Exception('Page not found');
		}
	}

	private function main() {
		$this->_view = new View('Home');
		$this->_view->generate(array());
	}

	private function HomeRouter($aHOME) {
		$this->_scanManager = new ScanManager();
		$this->_virusManager = new VirusManager();
		switch ($aHOME) {
			case 'total':
				$this->HomeRoutertotal();
				break;
			case 'info':
				$this->HomeRouterinfo();
				break;
			case 'mostdetected':
				$this->HomeRoutermostdetected();
				break;
			default:
				throw new Exception('Page not found');
				break;
		}
	}

	private function HOMEExecuter($aHOME) {
		switch ($aHOME) {
			case 'total':
				if (isset($_POST['viruses'])) {
					$this->HOMEExecuterVirusCount();
				} else if (isset($_POST['scans'])) {
					$this->HOMEExecuterScanCount();
				} else {
					throw new Exception('Page not found');
				}
				$this->HOMERouter($aHOME);
				break;
			case 'info':
				if (isset($_POST['scanfiles'])) {
					$this->HOMEExecuterFilesCount();
				} 
				else if (isset($_POST['detectedviruses'])) {
					$this->HOMEExecuterScanViruses();
				}
				else if(isset($_POST['virusesmonth'])) {
					$this->HomeExecuterVirusesMonth();
				} 
				else if(isset($_POST['averagetimescans'])){
					$this->HOMEExecuterAverageTimeScans();
				}
				else {
					throw new Exception('Page not found');
				}
				$this->HOMERouter($aHOME);
				break;
			case 'mostdetected':
				if (isset($_POST['namevirus'])) {
					$this->HOMEExecuterVirusName();
				}
				else {
					throw new Exception('Page not found');
				}
				$this->HOMERouter($aHOME);
				break;
		}
	
	}

	private function HomeRoutertotal(){
		$virus = $this->_virusManager->getCountVirus();
		$scan = $this->_scanManager->getCountScan();

		$this->_view = new View('Hometotal');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'viruses' => $virus, 'scans' => $scan));

	}
	private function HomeRouterinfo() {
		$file = $this->_scanManager->getSumFile();
		$virus = $this->_virusManager->getCountVirus();
		$virusM = $this->_virusManager->getVirusMonth() ;
		$AverageVirus = intval($this->_scanManager->getSumDuration()/ $this->_scanManager->getCountScan());

		$this->_view = new View('Homeinfo');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'files' => $file, 'viruses' => $virus, 'virusesM' => $virusM, 'AverageViruses' => $AverageVirus));
	}

		

	private function HomeRoutermostdetected() {
		$virus = $this->_virusManager->getCountVirusBy();

		$this->_view = new View('Homemostdetected');
		$this->_view->generate(array('errorMessageCreate' => $this->_errorMessageCreate, 'errorMessageOthers' => $this->_errorMessageOthers, 'informationMessageCreate' => $this->_informationMessageCreate, 'informationMessageOthers' => $this->_informationMessageOthers, 'viruses' => $virus));
	}

	private function HOMEExecuterVirusCount() {
		if ((isset($_POST['viruses']))){
			$virus = htmlspecialchars($_POST['viruses']);
			$this->_virusManager->getCountVirus();
			$this-> CRUDRouter('total');
		}		
	}
	private function HOMEExecuterScanCount(){
		if ((!empty($_POST['scans']))){
			$scan = htmlspecialchars($_POST['scans']);
			$this->_scanManager->getCountScan();
			$this-> CRUDRouter('total');
		}
	}
	private function HOMEExecuterFilesCount(){
		if ((!empty($_POST['scansfiles']))){
			$file = htmlspecialchars($_POST['scansfiles']);
			$this->_scanManager->getSumFile();
			$this-> CRUDRouter('info');
		}
	}
	private function HOMEExecuterScanViruses(){
		if ((!empty($_POST['detectedviruses']))){
			$virus = htmlspecialchars($_POST['detectedviruses']);
			$this->_virusManager->getCountVirus();
			$this-> CRUDRouter('info');
		}
	}

	private function HomeExecuterVirusesMonth(){
		if ((!empty($_POST['virusesmonth']))){
			$virus = htmlspecialchars($_POST['virusesmonth']);
			$this->_virusManager->getCountVirus();
			$this-> CRUDRouter('info');	
		}
	}

	private function HOMEExecuterAverageTimeScans(){
		if ((!empty($_POST['averagetimescans']))){
			$scan = htmlspecialchars($_POST['averagetimescans']);
			$this->_virusManager->getSumDuration();
			$this-> CRUDRouter('info');	
		}
	}

	private function HOMEExecuterVirusName(){
		if ((!empty($_POST['namevirus']))){
			$scan = htmlspecialchars($_POST['namevirus']);
			$this->_virusManager->getCountBy();
			$this-> CRUDRouter('mostdetected');	
		}
	}
	


}
