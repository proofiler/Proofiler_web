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
}
