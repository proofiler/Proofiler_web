<?php

class UserManager extends Model {
	public function getOneUser($anUsername) {
		return $this->selectOne('USERS', 'username', $anUsername);
	}

	public function connectUser($anUsername, $aPassword) {
		$result = false;

		$user = $this->getOneUser($anUsername);

		if ($user) {
			$aPassword = password_verify($aPassword, $user->getPassword());

			if ($aPassword) {
				$username = $user->getUsername();
				$password = $user->getPassword();

				$request = $this->getBDD()->prepare('SELECT * FROM USERS WHERE username = :username AND password = :password');
				$request->bindValue(':username', $username);
				$request->bindValue(':password', $password);
				$request->execute();

				if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
					$result = new User($data);
				}

				$request->closeCursor();
			}
		}

		return $result;
	}

	public function createUserSession($anUsername) {
		$token = session_id().microtime().rand(0,9999999999);
		$token = hash('sha512', $token);
		setcookie(SESSION_NAME, $token, time() + (60 * 20), '/', null, false, true);
		$_SESSION[SESSION_NAME] = $token;
		$_SESSION['username'] = $anUsername;
	}

	public function checkUserSession() {
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
				header('Location: '.URL.'Signin');
				exit();
			}
		}
	}
}
