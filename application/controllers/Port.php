<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Port extends CI_Controller {	

	public function index()
	{
		$this->load->view('login');
	}
	function registerNow()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->form_validation->set_rules('first_name','First Name','required');
			$this->form_validation->set_rules('last_name','Last Name','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('role','Roles','required');
			if($this->form_validation->run()==TRUE)
			{
				$first_name = $this->input->post('first_name');
				$last_name = $this->input->post('last_name');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$role = $this->input->post('role');
				$data = array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'username'=>$username,
					'password'=>sha1($password),
					'role'=>$role,
					'status'=>'1'
				);
				$this->load->model('user_model');
				$this->user_model->insertuser($data);
				$this->session->set_flashdata('success','Successfully User Created');
				redirect(base_url('port/login'));
			}
		}
	}
	function login()
	{
		$this->load->view('login');
	}
	function loginnow()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('password','Password','required');
			if($this->form_validation->run()==TRUE)
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$password = sha1($password);
				$this->load->model('user_model');
				$status = $this->user_model->checkPassword($password,$username);
				if($status!=false)
				{
					$username = $status->username;
					$password = $status->password;
					$session_data = array(
						'username'=>$username,
						'password'=>$password,
					);
					$this->session->set_userdata('UserLoginSession',$session_data);
					redirect(base_url('main'));
				}
				else
				{
					$this->session->set_flashdata('error','Email or Password is Wrong');
					redirect(base_url('port/login'));
				}
			}
			else
			{
				$this->session->set_flashdata('error','Fill all the required fields');
				redirect(base_url('port/login'));
			}
		}
	}
}