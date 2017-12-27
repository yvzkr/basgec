<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personels_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Personel_Model');
		$this->load->Model('Department_Model');
		$this->load->Model('Job_Rotation_Model');
		
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	public function index()
	{
		$data = array(
			'title' 										=> 'Personel',
			'personels'		    					=> $this->Personel_Model->all(1),
			'model_name'  							=> 'personel',
			'controller_name'						=> 'Personels'
		);

    	$this->load->view('layouts/top', $data);
		$this->load->view('personels/index');
    	$this->load->view('layouts/bottom');
	}

	public function add()
	{
		$departments 	      					= $this->Department_Model->all('id, title');
		$options			      					= array();

		foreach ($departments as $department) {
			$options[$department->id] = $department->title;
		}


		$job_rotations								= $this->Job_Rotation_Model->all();
		$job_options	      					= array();
		foreach ($job_rotations as $jr) {
			$job_options[$jr->id]				= $jr->title;
		}


		$data              						= array(
			'title' 									=> 'Yeni Personel Ekle',
			'inputs'									=> array(
				array(
					'tag'									=> 'input',
					'label'								=> 'Personel Adı',
					'type'								=> 'text',
					'name'								=> 'name',
					'class'								=> 'form-control',
					'placeholder' 				=> 'personel Adı',
					'required'						=> 'true',
					'autocomplete'				=> 'on'
				),
				array(
					'tag'									=> 'input',
					'label'								=> 'Personel Soyadi',
					'type'								=> 'text',
					'name'								=> 'surname',
					'class'								=> 'form-control',
					'placeholder' 				=> 'Personel Soyadı',
					'required'						=> 'true',
					'autocomplete'				=> 'on'
				),
				array(
					'tag'									=> 'input',
					'label'								=> 'Tc no',
					'type'								=> 'text',
					'name'								=> 'tc_no',
					'class'								=> 'form-control',
					'placeholder' 				=> 'tc_no',
					'required'						=> 'true',
					'autocomplete'				=> 'on'
				),
				array(
					'tag'									=> 'select',
					'label'								=> 'Departman Adi',
					'name'								=> 'department_id',
					'class'								=> 'form-control',
					'options'							=> $options,
					'selected'						=> '',
					'required'						=> 'true'
				),
				array(
					'tag'									=> 'input',
					'label'								=> 'Başlama tarihi',
					'type'								=> 'text',
					'name'								=> 'date_of_start',
					'class'								=> 'form-control',
					'placeholder' 				=> '2007-03-01',
					'required'						=> 'true',
					'autocomplete'				=> 'on'
				),
				array(
					'tag'									=> 'select',
					'label'								=> 'Vardiya',
					'name'								=> 'job_rotation_id',
					'class'								=> 'form-control',
					'options'							=> $job_options,
					'selected'						=> '',
					'required'						=> 'true'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('personels/form');
		$this->load->view('layouts/bottom');
	}

	public function create()
	{
		if( $this->Personel_Model->create() ){
			redirect('/personels');
		}else{
			$departments 	      					= $this->Department_Model->all('id, title');
			$options			      					= array();

			foreach ($departments as $department) {
				$options[$department->id] = $department->title;
			}


			$job_rotations								= $this->Job_Rotation_Model->all();
			$job_options	      					= array();
			foreach ($job_rotations as $jr) {
				$job_options[$jr->id]				= $jr->title;
			}


			$data              						= array(
				'title' 									=> 'Yeni Personel Ekle',
				'errors'									=> validation_errors(),
				'inputs'									=> array(
					array(
						'tag'									=> 'input',
						'label'								=> 'Personel Adı',
						'type'								=> 'text',
						'name'								=> 'name',
						'class'								=> 'form-control',
						'placeholder' 				=> 'personel Adı',
						'required'						=> 'true',
						'autocomplete'				=> 'on'
					),
					array(
						'tag'									=> 'input',
						'label'								=> 'Personel Soyadi',
						'type'								=> 'text',
						'name'								=> 'surname',
						'class'								=> 'form-control',
						'placeholder' 				=> 'Personel Soyadı',
						'required'						=> 'true',
						'autocomplete'				=> 'on'
					),
					array(
						'tag'									=> 'input',
						'label'								=> 'Tc no',
						'type'								=> 'text',
						'name'								=> 'tc_no',
						'class'								=> 'form-control',
						'placeholder' 				=> 'tc_no',
						'required'						=> 'true',
						'autocomplete'				=> 'on'
					),
					array(
						'tag'									=> 'select',
						'label'								=> 'Departman Adi',
						'name'								=> 'department_id',
						'class'								=> 'form-control',
						'options'							=> $options,
						'selected'						=> '',
						'required'						=> 'true'
					),
					array(
						'tag'									=> 'input',
						'label'								=> 'Başlama tarihi',
						'type'								=> 'text',
						'name'								=> 'date_of_start',
						'class'								=> 'form-control',
						'placeholder' 				=> '2007-03-01',
						'required'						=> 'true',
						'autocomplete'				=> 'on'
					),
					array(
						'tag'									=> 'select',
						'label'								=> 'Vardiya',
						'name'								=> 'job_rotation_id',
						'class'								=> 'form-control',
						'options'							=> $job_options,
						'selected'						=> '',
						'required'						=> 'true'
					)
				)
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('personels/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function edit($id)
	{
		$personel 										= $this->Personel_Model->find($id);

		$departments 									= $this->Department_Model->all('id, title');
		$options											= array();
		foreach ($departments as $department) {
			$options[$department->id] 	= $department->title;
		}


		$job_rotations								= $this->Job_Rotation_Model->all();
		$job_options	      					= array();
		foreach ($job_rotations as $jr) {
			$job_options[$jr->id]				= $jr->title;
		}

		$data = array(
			'title' 										=> 'Personel Düzenle',
			'inputs'										=> array(
				array(
					'tag'										=> 'input',
					'label'									=> 'personel Adı',
					'type'									=> 'text',
					'name'									=> 'name',
					'class'									=> 'form-control',
					'placeholder' 					=> 'personel Adı',
					'required'							=> 'true',
					'autocomplete'					=> 'off',
					'value'									=> $personel->name
				),
				array(
					'tag'										=> 'input',
					'label'									=> 'Personel Soyadi',
					'type'									=> 'text',
					'name'									=> 'surname',
					'class'									=> 'form-control',
					'placeholder' 					=> 'Personel Soyadı',
					'required'							=> 'true',
					'autocomplete'					=> 'off',
					'value'									=> $personel->surname
				),
				array(
					'tag'										=> 'input',
					'label'									=> 'Tc no',
					'type'									=> 'select',
					'name'									=> 'tc_no',
					'class'									=> 'form-control',
					'placeholder' 					=> 'tc_no',
					'required'							=> 'true',
					'autocomplete'					=> 'off',
					'value'									=> $personel->tc_no

				),
				array(
					'tag'										=> 'select',
					'label'									=> 'Departman Adi',
					'name'									=> 'department_id',
					'class'									=> 'form-control',
					'options'								=> $options,
					'selected'							=> $personel->departments_id,
					'required'							=> 'true'
				),
				array(
					'tag'									=> 'select',
					'label'								=> 'Vardiya',
					'name'								=> 'job_rotation_id',
					'class'								=> 'form-control',
					'options'							=> $job_options,
					'selected'						=> $personel->job_rotations_id,
					'required'						=> 'true'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('personels/form');
		$this->load->view('layouts/bottom');
	}

	public function update($id)
	{
		if( $this->Personel_Model->update($id) ){
			redirect('/personels');
		}else{
			redirect('/personels');
		}
	}

	public function delete($id)
	{
		$where=array('id'=>$id);
		if( $this->Personel_Model->delete($where) ){
			redirect('/personels');
		}else{
			$this->session->set_flashdata("danger","Silmek istediğiniz personel bulunamadı.");
			redirect('/personels');
		}
	}

	public function archive($id){
		$this->Personel_Model->archive($id);
		redirect('/personels');
	}

}
