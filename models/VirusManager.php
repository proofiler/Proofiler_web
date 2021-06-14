<?php

class VirusManager extends Model {
	public function getMaximumVirus() {
		return $this->getMaximum('VIRUSES', 'id');
	}

	/**
	 * Get all the viruses
	 * @return void
	 */
	public function getAllViruses() {
		return $this->selectAll('VIRUSES');
	}

	/**
	 * Get one virus
	 * @param int $anId
	 * @return void
	 */
	public function getOneVirus($anId) {
		return $this->selectOne('VIRUSES', 'id', $anId);
	}

	/**
	 * Insert a new virus
	 * @param array $someData
	 * @return void
	 */
	public function insertOneVirus($someData) {		
		$this->insertOne('VIRUSES', $someData);
	}

	/**
	 * Update a virus
	 * @param int $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneVirus($anAttribut, $someData) {
		$this->updateOne('VIRUSES', 'id', $anAttribut, $someData);
	}

	/**
	 * Delete a virus
	 * @param int $anId 
	 * @return void
	 */
	public function deleteOneVirus($anId) {
		$this->deleteOne('VIRUSES', 'id', $anId);
	}

	/**
	 * Recover the total number of viruses by name
	 * @return int
	 */
	public function getCountVirus() {
		return $this->getCount('VIRUSES', 'name');
	}

	/**
	 * Retrieve the number of times each virus was detected
	 * @return array
	 */
	public function getCountVirusBy() {
		return $this->getCountBy('VIRUSES', 'name');
	}

	/**
	 * Recover the total number of viruses by id
	 * @return int
	 */
	public function getCountVirusId() {
		return $this->getCount('VIRUSES', 'id');
	}

	/**
	 * Recover the average number of viruses detected per month
	 * @return int
	 */
	public function getVirusPerMonth() {
		return parent::getVirusPerMonth();
	}
}
