<?php

class Station {
	private $_ip;
	private $_hash;

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

	public function setIP($anIp) {
		$this->_ip = $anIp;
	}

	public function setHash($aHash) {
		$this->_hash = $aHash;
	}

	public function getIp() {
		return $this->_ip;
	}

	public function getHash() {
		return $this->_hash;
	}
}
