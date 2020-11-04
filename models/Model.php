<?php

class Model {
	private static $_BDD;

	private static function setBDD() {
		self::$_BDD = new PDO('mysql:host=localhost;dbname=Pr00filer;charset=utf8', 'root', 'Pr00filer');
		self::$_BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	protected function getBDD() {
		if (self::$_BDD === null) {
			self::setBDD();
		}
		
		return self::$_BDD;
	}

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
}
