<?php

class ExtensionManager extends Model {
	public function getAllExtensions() {
		return $this->selectAll('EXTENSIONS');
	}

	public function getOneExtension($anName) {
		return $this->selectOne('EXTENSIONS', 'name', $anName);
	}

	public function insertOneExtension($someData) {		
		$this->insertOne('EXTENSIONS', $someData);
	}

	public function updateOneExtension($anAttribut, $someData) {
		$this->updateOne('EXTENSIONS', 'name', $anAttribut, $someData);
	}

	public function deleteOneExtension($aName) {
		$this->deleteOne('EXTENSIONS', 'name', $aName);
	}
}
