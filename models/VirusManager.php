<?php

class VirusManager extends Model {
	public function getMaximumVirus() {
		return $this->getMaximum('VIRUSES', 'id');
	}

	public function getAllViruses() {
		return $this->selectAll('VIRUSES');
	}

	public function getOneVirus($anId) {
		return $this->selectOne('VIRUSES', 'id', $anId);
	}

	public function insertOneVirus($someData) {		
		$this->insertOne('VIRUSES', $someData);
	}

	public function updateOneVirus($anAttribut, $someData) {
		$this->updateOne('VIRUSES', 'id', $anAttribut, $someData);
	}

	public function deleteOneVirus($anId) {
		$this->deleteOne('VIRUSES', 'id', $anId);
	}
}