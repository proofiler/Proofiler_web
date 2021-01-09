<?php

class Employee {
	private $_email;
	private $_firstName;
	private $_lastName;

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

	public function setEmail($anEmail) {
		$this->_email = $anEmail;
	}

	public function setFirstName($aFirstName) {
		$this->_firstName = $aFirstName;
	}

	public function setLastName($aLastname) {
		$this->_lastName = $aLastname;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function getFirstName() {
		return $this->_firstName;
	}

	public function getLastName() {
		return $this ->_lastName;
	}
}
