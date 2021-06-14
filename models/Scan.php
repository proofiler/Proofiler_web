<?php

class Scan {
	private $_id;
	private $_dateScan;
	private $_duration;
	private $_nbFiles;
	private $_nbVirus;
	private $_nbErrors;
	private $_uuidUsb;

	/**
	 * Data transmission to the hydration function
	 * @param array $someData 
	 * @return void
	 */
	public function __construct($someData) {
		$this->hydrate($someData);
	}

	/**
	 * Automatic calls to the setter to implement the object from the received data
	 * @param array $someData 
	 * @return void
	 */
	public function hydrate($someData) {
		foreach ($someData as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	/**
	 * Setter to define the id of a scan
	 * @param int $anId 
	 * @return void
	 */
	public function setId($anId) {
		$this->_id = $anId;
	}

	/**
	 * Setter to define the date of a scan
	 * @param string $aDateScan 
	 * @return void
	 */
	public function setDatescan($aDateScan) {
		$this->_dateScan = $aDateScan;
	}

	/**
	 * Setter to define the duration of a scan
	 * @param int $aDuration 
	 * @return void
	 */
	public function setDuration($aDuration) {
		$this->_duration = $aDuration;
	}

	/**
	 * Setter to define the number of files of a scan
	 * @param int $aNbFiles 
	 * @return void
	 */
	public function setNbfiles($aNbFiles) {
		$this->_nbFiles = $aNbFiles;
	}

	/**
	 * Setter to define the number of viruses of a scan
	 * @param int $aNbVirus 
	 * @return void
	 */
	public function setNbVirus($aNbVirus) {
		$this->_nbVirus = $aNbVirus;
	}

	/**
	 * Setter to define the number of errors of a scan
	 * @param int $aNbErrors 
	 * @return void
	 */
	public function setNbErrors($aNbErrors) {
		$this->_nbErrors = $aNbErrors;
	}

	/**
	 * Setter to define the USB's UUID of a scan
	 * @param string $anUUidUsb 
	 * @return void
	 */
	public function setUuidUsb($anUuidUsb) {
		$this->_uuidUsb = $anUuidUsb;
	}

	/**
	 * Getter to get the id of a scan
	 * @return int $this->_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * Getter to get the date of a scan
	 * @return string $this->_dateScan
	 */
	public function getDatescan() {
		return $this->_dateScan;
	}

	/**
	 * Getter to get the duration of a scan
	 * @return int $this->_duration
	 */
	public function getDuration() {
		return $this->_duration;
	}

	/**
	 * Getter to get the number of files of a scan
	 * @return int $this->_nbFiles
	 */
	public function getNbfiles() {
		return $this->_nbFiles;
	}

	/**
	 * Getter to get the number of viruses of a scan
	 * @return int $this->_nbVirus
	 */
	public function getNbvirus() {
		return $this->_nbVirus;
	}

	/**
	 * Getter to get the number of errors of a scan
	 * @return int $this->_nbErrors
	 */
	public function getNberros() {
		return $this->_nbErrors;
	}

	/**
	 * Getter to get the USB's UUID of a scan
	 * @return string $this->_uuidUsb
	 */
	public function getUuidUsb() {
		return $this->_uuidUsb;
	}
}
