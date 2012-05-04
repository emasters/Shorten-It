<?php
require_once 'config.php';

class AuthDB {
	private $_db;

	public function __construct() {
		$this->_db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		or die("Problem connect to db. Error: ". mysqli_error());
	}

	public function __destruct() {
		$this->_db->close();
		unset($this->_db);
	}

	public function createUser($email, $password, $salt, $verification) {
		$query = "INSERT INTO tbUsers (email, password, user_salt, is_verified, is_active, is_admin, verification_code) "
		. "VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->_db->prepare($query);

		$ver = 0;
		$act = 1;
		$adm = 0;

		$stmt->bind_param("sssiiis", $email, $password, $salt, $ver, $act, $adm, $verification);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	public function getUserInfo($email) {
		//query
		$query = "SELECT pkUserId, user_salt, password, is_active, is_verified FROM tbUsers where email = ?";

		//prepare the statement
		$stmt = $this->_db->prepare($query);

		//bind parameters
		$stmt->bind_param("s", $email);

		//execute statements
		if ($stmt->execute()) {
			//bind result columnts
			$stmt->bind_result($id, $salt, $pass, $active, $ver);
			
			//fetch first row of results
			$stmt->fetch();

			//place results into new array
			$array = array();
			$array[] = array('pkUserId' => $id, 'user_salt' => $salt, 'password' => $pass, 'is_active' => $active, 'is_verified' => $ver);
			
			//return array
			return $array;
		}
	}

	public function removePriorLogins($userId) {
		$query = "DELETE FROM tbLoggedInUsers where fkUserId = ?";

		$stmt = $this->_db->prepare($query);

		$stmt->bind_param("i", $userId);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	public function markUserLoggedIn($userId, $session, $token) {
		$query = "INSERT INTO tbLoggedInUsers (fkUserId, session_id, token, lastUpdate) VALUES (?, ?, ?, NOW())";

		$stmt = $this->_db->prepare($query);

		$stmt->bind_param("iss", $userId, $session, $token);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
	
	public function checkSession($userId) {
		$query = "SELECT session_id, token FROM tbLoggedInUsers where fkUserId = ?";

		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("i", $userId);
		
		if ($stmt->execute()) {
			$stmt->bind_result($sessionId, $token);
			$stmt->fetch();
			return array('session_id' => $sessionId, 'token' => $token);
		}
	}
	
	public function updateSession($userId, $session, $token) {
		$query = "UPDATE tbLoggedInUsers SET session_id = ?, token = ?, lastUpdate = NOW() where fkUserId = ?";
		
		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("ssi", $session, $token, $userId);
		
		if ($stmt->execute()) {
			return true;
		}
		
		return false;
	}
	
	public function logoutUser($user_id) {
		$query = "DELETE FROM tbLoggedInUsers WHERE fkUserId = ?";
		
		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("i", $user_id);
		
		if ($stmt->execute()) {
			return true;
		}
		
		return false;
	}
	
	public function checkVerification($email, $code) {
		$query = "UPDATE " . USER_TABLE . " SET is_verified = 1, is_active = 1 WHERE email = ? and verification_code = ?"; 

		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("ss", $email, $code);
		
		if ($stmt->execute()) {
			return $stmt->affected_rows;
		}
		
		return 0;
	}
	
	public function retrieveCode($email) {
		$query = "SELECT verification_code FROM " . USER_TABLE . " WHERE email = ?";
		
		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("s", $email);
		
		if ($stmt->execute()) {
			$stmt->bind_result($code);
			$stmt->fetch();
			return $code;
		}
		
		return false;
	}
	
	public function newPassword($email, $password, $salt) {
		$query = "UPDATE " . USER_TABLE . " SET password = ?, user_salt = ? WHERE email = ?";
		
		$stmt = $this->_db->prepare($query);
		
		$stmt->bind_param("sss", $password, $salt, $email);
		
		if ($stmt->execute()) {
			return $stmt->affected_rows;
		}
		
		return -1;
	}
	
	public function updatePassword($userId, $password, $salt) {
		$query = "UPDATE " . USER_TABLE . " SET password = ?, user_salt = ? WHERE pkUserId = ?";
	
		$stmt = $this->_db->prepare($query);
	
		$stmt->bind_param("ssi", $password, $salt, $userId);
	
		if ($stmt->execute()) {
			return $stmt->affected_rows;
		}
	
		return -1;
	}
}