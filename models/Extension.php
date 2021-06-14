<?php

class Extension {
	private $_name;

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
	 * Setter to define the name of an extension
	 * @param string $aName 
	 * @return void
	 */
	public function setName($aName) {
		$this->_name = $aName;
	}

	/**
	 * Getter to get the name of an extension
	 * @return void $this->_name
	 */
	public function getName() {
		return $this->_name;
	}
}
