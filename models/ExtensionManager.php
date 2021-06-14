<?php

class ExtensionManager extends Model {
	/**
	 * Get all the extensinos
	 * @return void
	 */
	public function getAllExtensions() {
		return $this->selectAll('EXTENSIONS');
	}

	/**
	 * Get one extension
	 * @param string $aName
	 * @return void
	 */
	public function getOneExtension($aName) {
		return $this->selectOne('EXTENSIONS', 'name', $aName);
	}

	/**
	 * Insert a new extension
	 * @param array $someData
	 * @return void
	 */
	public function insertOneExtension($someData) {		
		$this->insertOne('EXTENSIONS', $someData);
	}

	/**
	 * Update an extension
	 * @param string $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneExtension($anAttribut, $someData) {
		$this->updateOne('EXTENSIONS', 'name', $anAttribut, $someData);
	}

	/**
	 * Delete an extension
	 * @param string $aName 
	 * @return void
	 */
	public function deleteOneExtension($aName) {
		$this->deleteOne('EXTENSIONS', 'name', $aName);
	}
}
