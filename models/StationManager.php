<?php

class StationManager extends Model {
	public function getAllStations() {
		return $this->selectAll('STATIONS');
	}

	public function getOneStation($anIp) {
		return $this->selectOne('STATIONS', 'ip', $anIp);
	}

	public function getOneHashStation($aHash) {
		return $this->selectOne('STATIONS', 'hash', $aHash);
	}

	public function insertOneStation($someData) {		
		$this->insertOne('STATIONS', $someData);
	}

	public function updateOneStation($anAttribut, $someData) {
		$this->updateOne('STATIONS', 'ip', $anAttribut, $someData);
	}

	public function deleteOneStation($anIp) {
		$this->deleteOne('STATIONS', 'ip', $anIp);
	}
}
