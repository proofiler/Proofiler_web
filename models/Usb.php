<?php

class Usb {
	private $_uuid;
	private $_brand;
	private $_registration;
	private $_emailEmployee;

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
	 * Setter to define the UUID of an USB
	 * @param string $anUuid 
	 * @return void
	 */
	public function setUuid($anUuid) {
		$this->_uuid = $anUuid;
	}

	/**
	 * Setter to define the brand of an USB
	 * @param string $aBrand 
	 * @return void
	 */
	public function setBrand($aBrand) {
		$this->_brand = $aBrand;
	}

	/**
	 * Setter to define the registration date of an USB
	 * @param string $aRegistration 
	 * @return void
	 */
	private function setRegistration($aRegistration) {
		$this->_registration = $aRegistration;
	}

	/**
	 * Setter to define the employee's mail of an USB
	 * @param string $anEmailEmployee 
	 * @return void
	 */
	private function setEmailemployee($anEmailEmployee) {
		$this->_emailEmployee = $anEmailEmployee;
	}

	/**
	 * Getter to get the UUID of an USB
	 * @return string $this->_uuid
	 */
	public function getUuid() {
		return $this->_uuid;
	}

	/**
	 * Getter to get the brand of an USB
	 * @return string $this->_brand
	 */
	public function getBrand() {
		return $this ->_brand;
	}

	/**
	 * Getter to get the registration date of an USB
	 * @return string $this->_registration
	 */
	public function getRegistration() {
		return $this->_registration;
	}

	/**
	 * Getter to get the employee's email of an USB
	 * @return string $this->_emailEmployee
	 */
	public function getEmailemployee() {
		return $this->_emailEmployee;
	}
}
