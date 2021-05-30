<?php

class ScanManager extends Model {
	public function getMaximumScan() {
		return $this->getMaximum('SCANS', 'id');
	}

	public function getAllScans() {
		return $this->selectAll('SCANS');
	}

	public function getOneScan($anId) {
		return $this->selectOne('SCANS', 'id', $anId);
	}

	public function insertOneScan($someData) {		
		$this->insertOne('SCANS', $someData);
	}

	public function updateOneScan($anAttribut, $someData) {
		$this->updateOne('SCANS', 'id', $anAttribut, $someData);
	}

	public function deleteOneScan($anId) {
		$this->deleteOne('SCANS', 'id', $anId);
	}


	public function getCountScan() {
		return $this->getCount('SCANS', 'id');
	}

	public function getSumFile() {
		return $this->getSum('SCANS', 'nbFiles');
	}

	public function getSumDuration(){
		return $this->getSum('SCANS','duration');
	}

	public function usbsWithMostViruses() {
		return parent::usbsWithMostViruses();
	}
}
