<?php

class Scan {
	private $_id;
	private $_dateScan;
	private $_duration;
	private $_nbFiles;
	private $_nbVirus;
	private $_nbErrors;
	private $_idUsb;

	public function __construct($someData) {
		$this->hydrate($someData);
	}

	public function hydrate($someData) {
		foreach ($someData as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function setId($anId) {
		$this->_id = $anId;
	}

	public function setDatescan($aDateScan) {
		$this->_dateScan = $aDateScan;
	}

	public function setDuration($aDuration) {
		$this->_duration = $aDuration;
	}

	public function setNbfiles($aNbFiles) {
		$this->_nbFiles = $aNbFiles;
	}

	public function setNbVirus($aNbVirus) {
		$this->_nbVirus = $aNbVirus;
	}

	public function setNbErrors($aNbErrors) {
		$this->_nbErrors = $aNbErrors;
	}

	public function setUuidUsb($anIdUsb) {
		$this->_idUsb = $anIdUsb;
	}

	public function getId() {
		return $this->_id;
	}

	public function getDatescan() {
		return $this->_dateScan;
	}

	public function getDuration() {
		return $this->_duration;
	}

	public function getNbfiles() {
		return $this->_nbFiles;
	}

	public function getNbvirus() {
		return $this->_nbVirus;
	}

	public function getNberros() {
		return $this->_nbErrors;
	}

	public function getUuidUsb() {
		return $this->_idUsb;
	}
}
