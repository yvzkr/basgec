<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive_Personels_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Archive_Personels_Model');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}
	public function index()
	{
		$data = array(
			'title' 								=> 'Silinmiş Olan Personel Bilgileri',
			'personels'		    					=> $this->Archive_Personels_Model->all(),
			'controller_name'						=> 'Personels'
		);


		$this->load->view('layouts/top', $data);
		$this->load->view('archive_personels/index');
    	$this->load->view('layouts/bottom');
	}





}
