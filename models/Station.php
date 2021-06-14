<?php

class Station {
	private $_ip;
	private $_hash;

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
	 * Setter to define the IP of a station
	 * @param string $anIp 
	 * @return void
	 */
	public function setIP($anIp) {
		$this->_ip = $anIp;
	}

	/**
	 * Setter to define the hash of a station
	 * @param string $aHash 
	 * @return void
	 */
	public function setHash($aHash) {
		$this->_hash = $aHash;
	}

	/**
	 * Getter to get the IP of a station
	 * @return int $this->_ip
	 */
	public function getIp() {
		return $this->_ip;
	}

	/**
	 * Getter to get the hash of a station
	 * @return string $this->_hash
	 */
	public function getHash() {
		return $this->_hash;
	}
}
