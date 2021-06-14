<?php

class ScanManager extends Model {
	public function getMaximumScan() {
		return $this->getMaximum('SCANS', 'id');
	}

	/**
	 * Get all the scans
	 * @return void
	 */
	public function getAllScans() {
		return $this->selectAll('SCANS');
	}

	/**
	 * Get one scan
	 * @param int $anId
	 * @return void
	 */
	public function getOneScan($anId) {
		return $this->selectOne('SCANS', 'id', $anId);
	}

	/**
	 * Insert a new scan
	 * @param array $someData
	 * @return void
	 */
	public function insertOneScan($someData) {		
		$this->insertOne('SCANS', $someData);
	}

	/**
	 * Update a scan
	 * @param int $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneScan($anAttribut, $someData) {
		$this->updateOne('SCANS', 'id', $anAttribut, $someData);
	}

	/**
	 * Delete a scan
	 * @param int $anId 
	 * @return void
	 */
	public function deleteOneScan($anId) {
		$this->deleteOne('SCANS', 'id', $anId);
	}

	/**
	 * Recover the total number of scans
	 * @return int
	 */
	public function getCountScan() {
		return $this->getCount('SCANS', 'id');
	}

	/**
	 * Recover the total number of scanned files
	 * @return int
	 */
	public function getSumFile() {
		return $this->getSum('SCANS', 'nbFiles');
	}

	/**
	 * Recover the total duration of scans
	 * @return int
	 */
	public function getSumDuration(){
		return $this->getSum('SCANS','duration');
	}

	/**
	 * Recover the 3 most detected viruses
	 * @return array
	 */
	public function usbsWithMostViruses() {
		return parent::usbsWithMostViruses();
	}
}
