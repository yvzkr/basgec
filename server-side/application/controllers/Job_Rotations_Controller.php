<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Rotations_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Job_Rotation_Model');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	public function index()
	{
		$data = array(
			'title' 					=> 'Vardiya',
			'job_rotations'		=> $this->Job_Rotation_Model->all(),
			'model_name'  		=> 'Vardiya',
			'controller_name'	=> 'Job_Rotations'
		);

    $this->load->view('layouts/top', $data);
		$this->load->view('Job_Rotations/index');
    $this->load->view('layouts/bottom');
	}

	public function add(){
		$data = array(
			'title' 					=> 'Yeni Vardiya Ekle',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Vardiya Adı',
					'type'				=> 'text',
					'name'				=> 'title',
					'class'				=> 'form-control',
					'placeholder' => 'Vardiya Adı',
					'required'		=> 'true',
					'autocomplete'=> 'off'
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Başlama Zamanı',
					'type'				=> 'text',
					'name'				=> 'start_time',
					'class'				=> 'form-control',
					'placeholder' => '08:00:00',
					'required'		=> 'true',
					'autocomplete'=> 'off'
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Bitiş Zamanı',
					'type'				=> 'text',
					'name'				=> 'finish_time',
					'class'				=> 'form-control',
					'placeholder' => '17:00:00',
					'required'		=> 'true',
					'autocomplete'=> 'off'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('job_rotations/form');
		$this->load->view('layouts/bottom');
	}

	public function create(){
		if( $this->Job_Rotation_Model->create() ){
			redirect('/job_rotations');
		}else{
			$data = array(
				'title' 					=> 'Yeni Vardiya Ekle',
				'errors'					=> validation_errors(),
				'inputs'					=> array(
					array(
						'tag'					=> 'input',
						'label'				=> 'Vardiya Adı',
						'type'				=> 'text',
						'name'				=> 'title',
						'class'				=> 'form-control',
						'placeholder' => 'Vardiya Adı',
						'required'		=> 'true',
						'autocomplete'=> 'off'
					),
					array(
						'tag'					=> 'input',
						'label'				=> 'Başlama Zamanı',
						'type'				=> 'text',
						'name'				=> 'start_time',
						'class'				=> 'form-control',
						'placeholder' => '08:00:00',
						'required'		=> 'true',
						'autocomplete'=> 'off'
					),
					array(
						'tag'					=> 'input',
						'label'				=> 'Bitiş Zamanı',
						'type'				=> 'text',
						'name'				=> 'finish_time',
						'class'				=> 'form-control',
						'placeholder' => '17:00:00',
						'required'		=> 'true',
						'autocomplete'=> 'off'
					)
				)
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('job_rotations/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function edit($id){
		$where							=	array('id' => $id);
		$job_rotation = $this->Job_Rotation_Model->find($where);
		$data 							= array(
			'title' 					=> 'VArdiya Düzenle',
			'inputs'					=> array(
				array(
					'tag'					=> 'input',
					'label'				=> 'Vardiya Adı',
					'type'				=> 'text',
					'name'				=> 'title',
					'class'				=> 'form-control',
					'placeholder' => 'Vardiya Adı',
					'required'		=> 'true',
					'autocompete'	=> 'off',
					'value'				=>	$job_rotation->title
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Başlama Zamanı',
					'type'				=> 'text',
					'name'				=> 'start_time',
					'class'				=> 'form-control',
					'placeholder' => '08:00:00',
					'required'		=> 'true',
					'autocompete'	=> 'off',
					'value'				=> $job_rotation->start_time
				),
				array(
					'tag'					=> 'input',
					'label'				=> 'Bitiş Zamanı',
					'type'				=> 'text',
					'name'				=> 'finish_time',
					'class'				=> 'form-control',
					'placeholder' => '17:00:00',
					'required'		=> 'true',
					'autocompete'	=> 'off',
					'value'				=> $job_rotation->finish_time
				),
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('job_rotations/form');
		$this->load->view('layouts/bottom');
	}

	public function update($id){
		if( $this->Job_Rotation_Model->update($id) ){
			redirect('/job_rotations');
		}else{
			$job_rotation 				= $this->Job_Rotation_Model->find($id);
			$data 								= array(
				'title' 					=> 'Vardiya Düzenle',
				'errors'					=> validation_errors(),
				'inputs'					=> array(
					array(
						'tag'					=> 'input',
						'label'				=> 'Vardiya Adı',
						'type'				=> 'text',
						'name'				=> 'title',
						'class'				=> 'form-control',
						'placeholder' => 'Vardiya Adı',
						'required'		=> 'true',
						'autocompete'	=> 'off',
						'value'				=>	$job_rotation->title
					),
					array(
						'tag'					=> 'input',
						'label'				=> 'Başlama Zamanı',
						'type'				=> 'text',
						'name'				=> 'start_time',
						'class'				=> 'form-control',
						'placeholder' => '08:00:00',
						'required'		=> 'true',
						'autocompete'	=> 'off',
						'value'				=> $job_rotation->start_time
					),
					array(
						'tag'					=> 'input',
						'label'				=> 'Bitiş Zamanı',
						'type'				=> 'text',
						'name'				=> 'finish_time',
						'class'				=> 'form-control',
						'placeholder' => '17:00:00',
						'required'		=> 'true',
						'autocompete'	=> 'off',
						'value'				=> $job_rotation->finish_time
					),
				)
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('job_rotations/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function delete($id){
		if( $this->Job_Rotation_Model->delete($id) ){
			redirect('/job_rotations');
		}else{
			$this->session->set_flashdata("danger","Silmek istediğiniz vardiya bulunamadı.");
			redirect('/job_rotations');
		}
	}
}
