<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Department_Model');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	public function index()
	{
		$data = array(
			'title' 					=> 'Departmanlar',
			'departments' 		=> $this->Department_Model->all(),
			'model_name'  		=> 'Departman',
			'controller_name'	=> 'departments'
		);

    $this->load->view('layouts/top', $data);
		$this->load->view('departments/index');
    $this->load->view('layouts/bottom');
	}

	public function add()
	{
		$data = array(
			'title' 					=> 'Yeni Departmant Ekle',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Departmant Adı',
					'type'				=> 'text',
					'name'				=> 'title',
					'class'				=> 'form-control',
					'placeholder' => 'Departmant Adı',
					'required'		=> 'true',
					'autocomplete'=> 'off'
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Açıklama',
					'type'				=> 'text',
					'name'				=> 'description',
					'class'				=> 'form-control',
					'placeholder' => 'Açıklama',
					'required'		=> 'true',
					'autocomplete'=> 'off'
				)
			)
		);

    $this->load->view('layouts/top', $data);
		$this->load->view('departments/form');
    $this->load->view('layouts/bottom');
	}

	public function create()
	{
		if( $this->Department_Model->create() ){
			redirect('/departments');
		}else{
			$data = array(
				'title' 			=> 'Yeni Departman Ekle',
				'errors'			=> validation_errors()
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('departments/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function edit($id)
	{
		$deparment = $this->Department_Model->find($id);
		$data = array(
			'title' 					=> 'Yeni Departmant Ekle',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Departmant Adı',
					'type'				=> 'text',
					'name'				=> 'title',
					'class'				=> 'form-control',
					'placeholder' => 'Departmant Adı',
					'required'		=> 'true',
					'autocomplete'=> 'off',
					'value'				=> $deparment->title
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Açıklama',
					'type'				=> 'text',
					'name'				=> 'description',
					'class'				=> 'form-control',
					'placeholder' => 'Açıklama',
					'autocomplete'=> 'off',
					'value'				=> $deparment->description
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('departments/form');
    $this->load->view('layouts/bottom');
	}

	public function update($id)
	{
		if( $this->Department_Model->update($id) ){
			redirect('/departments');
		}else{
			$data = array(
				'title' 			=> 'Departman Düzenle',
				'errors'			=> validation_errors()
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('departments/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function delete($id)
	{
		if( $this->Department_Model->delete($id) ){
			redirect('/departments');
		}else{
			$this->session->set_flashdata("danger","Silmek istediğiniz departman bulunamadı.");
			redirect('/departments');
		}
	}
}
