&<?php

class Model {
	private static $_BDD;

	/**
	 * Initiation of the connection to the database
	 * @return void
	 */
	private static function setBDD() {
		self::$_BDD = new PDO('mysql:host=localhost;dbname=Pr00filer;charset=utf8', 'root', 'Pr00filer');
		self::$_BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	/**
	 * Get the database connection instance
	 * @return object PDO
	 */
	protected function getBDD() {
		if (self::$_BDD === null) {
			self::setBDD();
		}
		
		return self::$_BDD;
	}

	/**
	 * Get all the data of a table
	 * @param string $aTable 
	 * @return array
	 */
	protected function selectAll($aTable) {
		$result = [];
		$object = substr(ucfirst(strtolower($aTable)), 0, -1);

		$request = $this->getBDD()->prepare('SELECT * FROM '.$aTable);
		$request->execute();

		while($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result[] = new $object($data);
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Get all the data of a row of a table
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @param string/int $anAttributValue 
	 * @return void
	 */
	protected function selectOne($aTable, $anAttribut, $anAttributValue) {
		$result = false;
		$object = substr(ucfirst(strtolower($aTable)), 0, -1);

		$request = $this->getBDD()->prepare('SELECT * FROM '.$aTable.' WHERE '.$anAttribut.' = :'.$anAttribut);
		$request->bindValue(':'.$anAttribut, $anAttributValue);
		$request->execute();

		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result = new $object($data);
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Adding a new element to a table
	 * @param string $aTable 
	 * @param array $someData 
	 * @return void
	 */
	protected function insertOne($aTable, $someData) {
		$realRequest = 'INSERT INTO '.$aTable.' (';
		foreach ($someData as $key => $value) {
			$realRequest .= $key.', ';
		}
		$realRequest = substr($realRequest, 0, -2);
		$realRequest .= ') VALUES (';
		foreach ($someData as $key => $value) {
			$realRequest .= ':'.$key.', ';
		}
		$realRequest = substr($realRequest, 0, -2);
		$realRequest .= ')';

		$request = $this->getBDD()->prepare($realRequest);
		foreach ($someData as $key => $value) {
			$request->bindValue(':'.$key, $value);
		}
		$request->execute();
		$request->closeCursor();
	}

	/**
	 * Editing a new element in a table
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @param string/int $anAttributValue 
	 * @param arrary $someData 
	 * @return void
	 */
	protected function updateOne($aTable, $anAttribut, $anAttributValue, $someData) {
		$realRequest = 'UPDATE '.$aTable.' SET ';
		foreach ($someData as $key => $value) {
			$realRequest .= $key.' = :'.$key.', ';
		}
		$realRequest = substr($realRequest, 0, -2);
		$realRequest .= ' WHERE '.$anAttribut.' = :'.$anAttribut.'1';
		$request = $this->getBDD()->prepare($realRequest);
		foreach ($someData as $key => $value) {
			$request->bindValue(':'.$key, $value);
		}
		$request->bindValue(':'.$anAttribut.'1', $anAttributValue);
		$request->execute();
		$request->closeCursor();
	}

	/**
	 * Deleting a new element in a table
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @param string/int $anAttributValue 
	 * @return void
	 */
	protected function deleteOne($aTable, $anAttribut, $anAttributValue) {
		$realRequest = 'DELETE FROM '.$aTable.' WHERE '.$anAttribut.' = :'.$anAttribut;
		$request = $this->getBDD()->prepare($realRequest);
		$request->bindValue(':'.$anAttribut, $anAttributValue);
		$request->execute();
		$request->closeCursor();
	}

	/**
	 * Get the maximum id of a table
	 * @param string $aTable 
	 * @param string/int $anAttribut 
	 * @return int
	 */
	protected function getMaximum($aTable, $anAttribut) {
		$result = 0;

		$request = $this->getBDD()->prepare('SELECT MAX('.$anAttribut.') AS '.$anAttribut.' FROM '.$aTable);
		$request->execute();

		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result = $data[$anAttribut];
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Get the number of elements in a table
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @return int
	 */
	protected function getCount($aTable, $anAttribut) {
		$result = 0;

		$request = $this->getBDD()->prepare('SELECT COUNT('.$anAttribut.') AS '.$anAttribut.' FROM '.$aTable);
		$request->execute();

		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result = $data[$anAttribut];
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Get the number of elements in a table with another attribute
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @return array
	 */
	protected function getCountBy($aTable, $anAttribut) {
		$result = [];

		$request = $this->getBDD()->prepare('SELECT COUNT('.$anAttribut.') AS CB,'.$anAttribut.' AS '.$anAttribut.' FROM '.$aTable.' GROUP BY '.$anAttribut.' ORDER BY CB DESC LIMIT 10');
		$request->execute();

		while($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $data;
		}

		$request->closeCursor();

		return $result;

	}

	/**
	 * Recovery of USB keys associated with the most viruses detected
	 * @return array
	 */
	protected function usbsWithMostViruses() {
		$result = [];

		$request = $this->getBDD()->prepare('SELECT SUM(nbVirus) AS nbVirusSum, uuidUsb, emailEmployee FROM SCANS INNER JOIN USBS ON SCANS.uuidUsb = USBS.uuid GROUP BY uuidUsb LIMIT 3');
		$request->execute();

		while($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $data;
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Get the sum of an attribute of the elements of a table
	 * @param string $aTable 
	 * @param string $anAttribut 
	 * @return int
	 */
	protected function getSum($aTable, $anAttribut) {
		$result = 0;

		$request = $this->getBDD()->prepare('SELECT SUM('.$anAttribut.') AS '.$anAttribut.' FROM '.$aTable);
		$request->execute();

		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result = $data[$anAttribut];
		}

		$request->closeCursor();

		return $result;
	}

	/**
	 * Get the average number of viruses detected each month
	 * @return array
	 */
	protected function getVirusPerMonth(){
		
		$result = 0;

		$request = $this->getBDD()->prepare('SELECT ROUND(AVG(result.average),1) AS RES FROM (SELECT YEAR(dateScan) AS year_averageViruses, MONTH(dateScan) AS month_averageViruses, ROUND(AVG(nbVirus), 0) AS average FROM SCANS GROUP BY MONTH(dateScan), YEAR(dateScan)) result');
		$request->execute();

		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$result = $data;
		}

		$request->closeCursor();

		return $result['RES'];
	}
}
