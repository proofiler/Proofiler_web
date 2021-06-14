<?php

class UsbManager extends Model {
	/**
	 * Get all the USBs
	 * @return void
	 */
	public function getAllUsbs() {
		return $this->selectAll('USBS');
	}

	/**
	 * Get one USB
	 * @param int $anId
	 * @return void
	 */
	public function getOneUsb($anId) {
		return $this->selectOne('USBS', 'uuid', $anId);
	}

	/**
	 * Insert a new USB
	 * @param array $someData
	 * @return void
	 */
	public function insertOneUsb($someData) {		
		$this->insertOne('USBS', $someData);
	}

	/**
	 * Update an USB
	 * @param string $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneUsb($anAttribut, $someData) {
		$this->updateOne('USBS', 'uuid', $anAttribut, $someData);
	}

	/**
	 * Delete an USB
	 * @param int $anId
	 * @return void
	 */
	public function deleteOneUsb($anId) {
		$this->deleteOne('USBS', 'uuid', $anId);
	}
}
