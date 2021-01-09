<?php

class UsbManager extends Model {
	public function getMaximumUsb() {
		return $this->getMaximum('USBS', 'id');
	}

	public function getAllUsbs() {
		return $this->selectAll('USBS');
	}

	public function getOneUsb($anId) {
		return $this->selectOne('USBS', 'id', $anId);
	}

	public function insertOneUsb($someData) {		
		$this->insertOne('USBS', $someData);
	}

	public function updateOneUsb($anAttribut, $someData) {
		$this->updateOne('USBS', 'id', $anAttribut, $someData);
	}

	public function deleteOneUsb($anId) {
		$this->deleteOne('USBS', 'id', $anId);
	}
}
