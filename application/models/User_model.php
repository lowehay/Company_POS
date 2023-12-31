<?php

class User_model extends CI_Model
{

	function insertuser($data)
	{
		$this->db->insert('user', $data);
	}

	function get_all_users()
	{
		$this->db->where('isDelete', 'no');
		$query = $this->db->get('user');
		$result = $query->result();

		return $result;
	}
	function insert1()
	{
		$username = (string) $this->input->post('username');
		$first_name = (string) $this->input->post('first_name');
		$last_name = (string) $this->input->post('last_name');
		$password = (string) $this->input->post('password');
		$role = (string) $this->input->post('role');

		$data = array(
			'username' => $username,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'password' => sha1($password),
			'role' => $role,
			'status' => '1'
		);

		$response = $this->db->insert('user', $data);

		if ($response) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	function get_users($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user');
		$row = $query->row();

		return $row;
	}
	function update_user()
	{
		$user_id = (int) $this->input->post('user_id');

		$username = (string) $this->input->post('username');
		$first_name = (string) $this->input->post('first_name');
		$last_name = (string) $this->input->post('last_name');
		$password = (string) $this->input->post('password');
		$role = (string) $this->input->post('role');


		$data = array(
			'username' => $username,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'password' => sha1($password),
			'role' => $role,
		);

		$this->db->where('user_id', $user_id);

		$response = $this->db->update('user', $data);

		if ($response) {
			return $user_id;
		} else {
			return FALSE;
		}
	}
	public function delete_user($id)
	{
		$data = array(
			'isDelete' => 'yes'
		);
		$this->db->where('user_id', $id);
		$response = $this->db->update('user', $data);
		if ($response) {
			return $id;
		} else {
			return false;
		}
	}
	function checkPassword($password, $username)
	{
		$query = $this->db->query("SELECT * FROM user WHERE password='$password' AND username='$username' AND status='1'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
}
