<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Home_Model');

	}

	public function index()
	{
		$data = array(
			'title' 					=> 'Kullanıcı Giriş',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Email',
					'type'				=> 'email',
					'name'				=> 'email',
					'class'				=> 'form-control',
					'placeholder' => 'Kullanıcı Adi',
					'required'		=> 'true',
					'autocomplete'=> 'on'
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Password',
					'type'				=> 'password',
					'name'				=> 'password',
					'class'				=> 'form-control',
					'placeholder' => 'Password',
					'required'		=> 'true',
					'autocomplete'=> 'on'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('home/form');
		$this->load->view('layouts/bottom');
	}

	public function control()
	{
		if( $this->Home_Model->find() ){
			redirect('/personels');
		}else{
			redirect('');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		redirect('');
	}

}
