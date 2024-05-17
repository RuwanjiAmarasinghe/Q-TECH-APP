<?php
defined('BASEPATH') or exit('No direct script access allowed') ?>

<?php
class User_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($user_id)
	{
		$this->db->where('id', $user_id);
		return $this->db->get('users')->row_array();
	}

	public function register($username, $password, $email)
	{
		$this->db->where('username', $username);
		$result = $this->db->get('users');

		if ($result->num_rows() > 0) {
			return array('error' => 'Username already taken. Please select a different one.');
		}

		$this->db->where('email', $email);
		$result = $this->db->get('users');

		if ($result->num_rows() > 0) {
			
			return array('error' => '"Email already in use. Please choose another one.');
		}


		if (strlen($password) < 8) {
	
			return array('error' => 'Password must be at least 8 characters.');
		}

	
		$data = array(
			'username' => $username,
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'email' => $email
		);

		$this->db->insert('users', $data);

		return array('success' => 'Registration complete. You can log in.');
	}

	public function login($username, $password)
	{
	
		if (empty($username) || empty($password)) {
			return array('error' => 'required categories - username, password.');
		}

		$this->db->where('username', $username);
		$user = $this->db->get('users')->row();

	
		if ($user && password_verify($password, $user->password)) {
			return $user;
		}

	
		return array('error' => 'Invalid categories: username or password.');

	}

}

