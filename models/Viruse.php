<?php

class Viruse {
	private $_id;
	private $_name;
	private $_hash;
	private $_idScan;

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
	 * Setter to define the id of a virus
	 * @param int $anId 
	 * @return void
	 */
	public function setId($anId) {
		$this->_id = $anId;
	}

	/**
	 * Setter to define the name of a virus
	 * @param string $aName 
	 * @return void
	 */
	public function setName($aName) {
		$this->_name = $aName;
	}

	/**
	 * Setter to define the hash of a virus
	 * @param string $aHash 
	 * @return void
	 */
	public function setHash($aHash) {
		$this->_hash = $aHash;
	}

	/**
	 * Setter to define the scan's id of a virus
	 * @param int $anIdScan 
	 * @return void
	 */
	private function setIdScan($anIdScan) {
		$this->_idScan = $anIdScan;
	}

	/**
	 * Getter to get the id of a virus
	 * @return int $this->_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * Getter to get the name of a virus
	 * @return string $this->_name
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * Getter to get the hash of a virus
	 * @return string $this->_hash
	 */
	public function getHash() {
		return $this ->_hash;
	}

	/**
	 * Getter to get the scan's id of a virus
	 * @return string $this->_idScan
	 */
	public function getIdScan() {
		return $this->_idScan;
	}

}
