<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_rental');
		
	}
	

	public function index()
	{
		$this->load->view('login');
	}

	public function login()		
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		//var_dump($password);die;
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if($this->form_validation->run() != false){ 
			$where = array( 
				'admin_username' => $username, 
				'admin_password' => md5($password) 
			); 
			// var_dump($where);die;

			$data = $this->m_rental->edit_data($where,'admin'); 
			$d = $this->m_rental->edit_data($where,'admin')->row(); 
			$cek = $data->num_rows(); 
			
			if($cek > 0){ 
				$session = array( 
					'id'=> $d->admin_id, 
					'nama'=> $d->admin_nama, 
					'status' => 'login' 
				); 
				$this->session->set_userdata($session); 
				redirect(base_url().'admin'); 
			}else{ 
				redirect(base_url().'welcome?pesan=gagal'); 
			}
		} else {
			$this->load->view('login');
			
		}	
	}
	function logout(){
		
		$this->session->sess_destroy();
		
		redirect('welcome','refresh');
		
	}
}
