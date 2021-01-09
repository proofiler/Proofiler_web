<?php

class Usb {
	private $_id;
	private $_uuid;
	private $_brand;
	private $_registration;
	private $_emailEmployee;

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

	public function setUuid($anUuid) {
		$this->_uuid = $anUuid;
	}

	public function setBrand($aBrand) {
		$this->_brand = $aBrand;
	}

	private function setRegistration($aRegistration) {
		$this->_registration = $aRegistration;
	}

	private function setEmailemployee($anEmailEmployee) {
		$this->_emailEmployee = $anEmailEmployee;
	}

	public function getId() {
		return $this->_id;
	}

	public function getUuid() {
		return $this->_uuid;
	}

	public function getBrand() {
		return $this ->_brand;
	}

	public function getRegistration() {
		return $this->_registration;
	}

	public function getEmailemployee() {
		return $this->_emailEmployee;
	}
}
