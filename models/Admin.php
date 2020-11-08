<?php

class Admin {
	private $_email;
	private $_password;

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

	public function setPassword($aPassword) {
		$this->_password = $aPassword;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function getPassword() {
		return $this->_password;
	}
}
