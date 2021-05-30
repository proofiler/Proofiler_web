<?php

class Viruse {
	private $_id;
	private $_name;
	private $_hash;
	private $_idScan;

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

	public function setName($aName) {
		$this->_name = $aName;
	}

	public function setHash($aHash) {
		$this->_hash = $aHash;
	}

	private function setIdScan($anIdScan) {
		$this->_idScan = $anIdScan;
	}

	public function getId() {
		return $this->_id;
	}

	public function getName() {
		return $this->_name;
	}

	public function getHash() {
		return $this ->_hash;
	}

	public function getIdScan() {
		return $this->_idScan;
	}

}
