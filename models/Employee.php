<?php

class Employee {
	private $_email;
	private $_firstName;
	private $_lastName;

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
	 * Setter to define the mail of an employee
	 * @param string $anEmail 
	 * @return void
	 */
	public function setEmail($anEmail) {
		$this->_email = $anEmail;
	}

	/**
	 * Setter to define the firstname of an employee
	 * @param string $aFirstName 
	 * @return void
	 */
	public function setFirstName($aFirstName) {
		$this->_firstName = $aFirstName;
	}

	/**
	 * Setter to define the lastname of an employee
	 * @param string $aLastname 
	 * @return void
	 */
	public function setLastName($aLastname) {
		$this->_lastName = $aLastname;
	}

	/**
	 * Getter to get the email of an employee
	 * @return string $this->_email
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * Getter to get the firstname of an employee
	 * @return void $this->_firstName
	 */
	public function getFirstName() {
		return $this->_firstName;
	}

	/**
	 * Getter to get the lastname of an employee
	 * @return string $this->_lastName
	 */
	public function getLastName() {
		return $this ->_lastName;
	}
}
