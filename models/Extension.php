<?php

class Extension {
	private $_name;

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

	public function setName($aName) {
		$this->_name = $aName;
	}

	public function getName() {
		return $this->_name;
	}
}
