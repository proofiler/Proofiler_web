<?php

class AdminManager extends Model {
	/**
	 * Get all the administrators
	 * @return void
	 */
	public function getAllAdmins() {
		return $this->selectAll('ADMINS');
	}

	/**
	 * Get one administrator
	 * @param string $anEmail
	 * @return void
	 */
	public function getOneAdmin($anEmail) {
		return $this->selectOne('ADMINS', 'email', $anEmail);
	}

	/**
	 * Insert a new administrator
	 * @param array $someData
	 * @return void
	 */
	public function insertOneAdmin($someData) {
		$someData['password'] = password_hash($someData['password'], PASSWORD_DEFAULT);
		
		$this->insertOne('ADMINS', $someData);
	}

	/**
	 * Update an administrator
	 * @param string $anAttribut 
	 * @param array $someData 
	 * @return void
	 */
	public function updateOneAdmin($anAttribut, $someData) {
		if (isset($someData['password']) && !empty($someData['password'])) {
			$someData['password'] = password_hash($someData['password'], PASSWORD_DEFAULT);
		}

		$this->updateOne('ADMINS', 'email', $anAttribut, $someData);
	}

	/**
	 * Delete an administrator
	 * @param string $anEmail 
	 * @return void
	 */
	public function deleteOneAdmin($anEmail) {
		$this->deleteOne('ADMINS', 'email', $anEmail);
	}

	/**
	 * Checks the provided credentials to see if an administrator matches them
	 * @param string $anEmail 
	 * @param string $aPassword 
	 * @return object Admin
	 */
	public function connect($anEmail, $aPassword) {
		$result = false;

		$admin = $this->getOneAdmin($anEmail);

		if ($admin) {
			$aPassword = password_verify($aPassword, $admin->getPassword());

			if ($aPassword) {
				$email = $admin->getEmail();
				$password = $admin->getPassword();

				$request = $this->getBDD()->prepare('SELECT * FROM ADMINS WHERE email = :email AND password = :password');
				$request->bindValue(':email', $email);
				$request->bindValue(':password', $password);
				$request->execute();

				if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
					$result = new Admin($data);
				}

				$request->closeCursor();
			}
		}

		return $result;
	}

	/**
	 * Creating a session token for an administrator
	 * @param string $anEmail 
	 * @return void
	 */
	public function createSession($anEmail) {
		$token = session_id().microtime().rand(0,9999999999);
		$token = hash('sha512', $token);
		setcookie(SESSION_NAME, $token, time() + (60 * 20), '/', null, false, true);
		$_SESSION[SESSION_NAME] = $token;
		$_SESSION['email'] = $anEmail;
	}

	/**
	 * Verification of the administrator's session token
	 * @return void
	 */
	public function checkSession() {
		if (!isset($_COOKIE[SESSION_NAME])) {
			$_SESSION = array();
			session_destroy();
			throw new Exception('Your browser does not seem to accept cookies');
		} else {
			if ((isset($_COOKIE[SESSION_NAME]) && isset($_SESSION[SESSION_NAME])) && ($_COOKIE[SESSION_NAME] === $_SESSION[SESSION_NAME])) {
				$token = session_id().microtime().rand(0,9999999999);
				$token = hash('sha512', $token);
				setcookie(SESSION_NAME, $token, time() + (60 * 20), '/', null, false, true);
				$_SESSION[SESSION_NAME] = $token;
			} else {
				setcookie(SESSION_NAME, '', time() - 3600);
				unset($_COOKIE[SESSION_NAME]);
				$_SESSION = array();
				session_destroy();
				header('Location: '.URL.'signin');
				exit();
			}
		}
	}
}
