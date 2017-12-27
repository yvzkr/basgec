<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Activity_Model');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	public function index()
	{
		$data = array(
			'title' 					=> 'aktivite',
			'activity' 				=> $this->Activity_Model->all(),
			'controller_name'	=> 'activity'
		);

    $this->load->view('layouts/top', $data);
		$this->load->view('activities/index');
    $this->load->view('layouts/bottom');
	}


/*	public function create()
	{
		if( $this->Activity_Model->create() ){
			redirect('/activities');
		}else{
			$data = array(
				'title' 			=> 'Yeni Aktivite Ekle',
				'errors'			=> validation_errors()
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('activities/form');
			$this->load->view('layouts/bottom');
		}
	}
	*/
/*
	public function edit($id)
	{
		$activity 					= $this->Activity_Model->find($id);
		$data     					= array(
			'title' 					=> 'Aktivite Düzenle',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Aktivite Adı',
					'type'				=> 'text',
					'name'				=> 'title',
					'class'				=> 'form-control',
					'placeholder' => 'Aktivite Adı',
					'required'		=> 'true',
					'autocompete'	=> 'off',
					'value'				=>	$activity->title
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('activities/form');
		$this->load->view('layouts/bottom');
	}
	*/
/*
	public function update($id)
	{
		if( $this->Activity_Model->update($id) ){
			redirect('/activities');
		}else{
			$data = array(
				'title' 			=> 'Departman Düzenle',
				'errors'			=> validation_errors()
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('activities/edit');
			$this->load->view('layouts/bottom');
		}
	}
	*/
/*
	public function delete($id)
		if( $this->Activity_Model->delete($id) ){
			redirect('/activities');
		}else{
			$this->session->set_flashdata("danger","Silmek istediğiniz aktvite bulunamadı.");
			redirect('/activities');
		}
	}
*/
}
