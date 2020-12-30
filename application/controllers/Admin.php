<?php


class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function login()
	{
		$this->form_validation->set_rules('username','Username','required',['required' => 'Username wajib diisi!']);
		$this->form_validation->set_rules('password','Password','required',['required' => 'Password wajib diisi!']);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates_admin/header');
			$this->load->view('admin/v_login');
		}else{
			$auth = $this->m_admin->cek_login();
			if($auth == FALSE)
			{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Username atau Password Anda Salah !</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
				redirect('admin/login');
			}else{
				$this->session->set_userdata('username',$auth->username);
				redirect('kelola');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('cari');
	}
}