<?php

class EmployeeManager extends Model {
	/**
	 * Get all the employees
	 * @return void
	 */
	public function getAllEmployees() {
		return $this->selectAll('EMPLOYEES');
	}

	/**
	 * Get one employee
	 * @param string $anEmail
	 * @return void
	 */
	public function getOneEmployee($anEmail) {
		return $this->selectOne('EMPLOYEES', 'email', $anEmail);
	}

	/**
	 * Insert a new employee
	 * @param array $someData
	 * @return void
	 */
	public function insertOneEmployee($someData) {		
		$this->insertOne('EMPLOYEES', $someData);
	}

	/**
	 * Update an employee
	 * @param string $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneEmployee($anAttribut, $someData) {
		$this->updateOne('EMPLOYEES', 'email', $anAttribut, $someData);
	}

	/**
	 * Delete an employee
	 * @param string $anEmail 
	 * @return void
	 */
	public function deleteOneEmployee($anEmail) {
		$this->deleteOne('EMPLOYEES', 'email', $anEmail);
	}
}
