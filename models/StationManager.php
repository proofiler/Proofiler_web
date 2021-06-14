<?php

class StationManager extends Model {
	/**
	 * Get all the stations
	 * @return void
	 */
	public function getAllStations() {
		return $this->selectAll('STATIONS');
	}

	/**
	 * Get one station
	 * @param string $anIp
	 * @return void
	 */
	public function getOneStation($anIp) {
		return $this->selectOne('STATIONS', 'ip', $anIp);
	}

	/**
	 * Get one station by its hash
	 * @param string $aHash 
	 * @return void
	 */
	public function getOneHashStation($aHash) {
		return $this->selectOne('STATIONS', 'hash', $aHash);
	}

	/**
	 * Insert a new station
	 * @param array $someData
	 * @return void
	 */
	public function insertOneStation($someData) {		
		$this->insertOne('STATIONS', $someData);
	}

	/**
	 * Update a station
	 * @param string $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneStation($anAttribut, $someData) {
		$this->updateOne('STATIONS', 'ip', $anAttribut, $someData);
	}

	/**
	 * Delete a station
	 * @param string $anIp 
	 * @return void
	 */
	public function deleteOneStation($anIp) {
		$this->deleteOne('STATIONS', 'ip', $anIp);
	}
}
