<?php

class Admin {
	private $_email;
	private $_password;

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
	 * Setter to define the mail of an administrator
	 * @param string $anEmail 
	 * @return void
	 */
	public function setEmail($anEmail) {
		$this->_email = $anEmail;
	}

	/**
	 * Setter to define the password of an administrator
	 * @param string $aPassword 
	 * @return void
	 */
	public function setPassword($aPassword) {
		$this->_password = $aPassword;
	}

	/**
	 * Getter to get the email of an administrator
	 * @return string $this->_email
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * Getter to get the email of an administrator
	 * @return string $this->_password
	 */
	public function getPassword() {
		return $this->_password;
	}
}
