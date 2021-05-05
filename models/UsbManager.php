<?php

class UsbManager extends Model {

	public function getAllUsbs() {
		return $this->selectAll('USBS');
	}

	public function getOneUsb($anId) {
		return $this->selectOne('USBS', 'uuid', $anId);
	}

	public function insertOneUsb($someData) {		
		$this->insertOne('USBS', $someData);
	}

	public function updateOneUsb($anAttribut, $someData) {
		$this->updateOne('USBS', 'uuid', $anAttribut, $someData);
	}

	public function deleteOneUsb($anId) {
		$this->deleteOne('USBS', 'uuid', $anId);
	}
}
