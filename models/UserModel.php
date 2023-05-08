<?php
require_once PROJECT_ROOT_PATH . "/models/database.php";

class UserModel extends Database {
	public function getUser($id) {
		return $this->select("SELECT * FROM users WHERE id = " . $id)[0];
	}

	public function createUser($name, $email, $password) {
		return $this->create("INSERT INTO users (`name`, `email`, `password`, `created_at`, `updated_at`) VALUES ('" . $name . "', '" . $email . "', '" . $password . "', NOW(), NOW())");
	}

	public function getAllUsers() {
    return $this->select("SELECT * FROM users");
  }

	public function getUserByEmail($email) {
		return $this->select("SELECT * FROM users WHERE email = '" . $email . "'");
	}
}
?>