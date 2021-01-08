<?php

class EmployeeManager extends Model {
	public function getAllEmployees() {
		return $this->selectAll('EMPLOYEES');
	}

	public function getOneEmployee($anEmail) {
		return $this->selectOne('EMPLOYEES', 'email', $anEmail);
	}

	public function insertOneEmployee($someData) {		
		$this->insertOne('EMPLOYEES', $someData);
	}

	public function updateOneEmployee($anAttribut, $someData) {
		$this->updateOne('EMPLOYEES', 'email', $anAttribut, $someData);
	}

	public function deleteOneEmployee($anEmail) {
		$this->deleteOne('EMPLOYEES', 'email', $anEmail);
	}
}
