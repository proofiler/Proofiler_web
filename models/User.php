<?php

class User {
	private $_username;
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

	public function setUsername($anUsername) {
		$this->_username = $anUsername;
	}

	public function setPassword($aPassword) {
		$this->_password = $aPassword;
	}

	public function getUsername() {
		return $this->_username;
	}

	public function getPassword() {
		return $this->_password;
	}
}
