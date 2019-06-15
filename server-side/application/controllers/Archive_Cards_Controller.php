<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive_Cards_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Archive_Cards_Model');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}
	public function index()
	{
		$data = array(
			'title' 								=> 'Silinmiş Olan Kartlar Bilgileri',
			'cards'		    						=> $this->Archive_Cards_Model->all(),
			'controller_name'						=> 'Cards'
		);


		$this->load->view('layouts/top', $data);
		$this->load->view('archive_cards/index');		
    	$this->load->view('layouts/bottom');
	}





}
