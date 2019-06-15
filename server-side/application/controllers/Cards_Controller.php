<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cards_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Card_Model');
		$this->load->Model('Personel_Model');

	}

	public function index()
	{

		$data = array(
			'title' 											=> 'Kart Bilgileri',
			'card' 												=> $this->Card_Model->all(),
			'model_name'  										=> 'cards',
			'controller_name'									=> 'card'
		);

    	$this->load->view('layouts/top', $data);
		$this->load->view('cards/index');
    	$this->load->view('layouts/bottom');
	}

	public function add()
	{
		$data = array(
			'title' 											=> 'Yeni Kart Ekle ',
			'inputs'											=> array(
				array(
					'tag'											=> 'input',
					'label'										=> 'Kart',
					'name'										=> 'card_uid',
					'class'										=> 'form-control',
					'required'								=> 'true'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('cards/form');
		$this->load->view('layouts/bottom');
	}

	public function create()
	{

		if( $data=$this->Card_Model->create() ){

			echo json_encode($data);
			//redirect('/cards');
		}else{
			$data = array(
				'status' 									=> 0//'hatali kart '
			);
			echo json_encode($data);
			//redirect('cards');

		}
	}

	public function edit($id)
	{
		$personels											= $this->Personel_Model->all();
		$options												= array();
		foreach ($personels as $personel) {
			$options[$personel->id] 			= $personel->name." ".$personel->surname;
		}

		$data 													= array(
			'id' 													=> $id
		);

		$card 													= $this->Card_Model->find($data);

		if($card == NULL){
			redirect('/cards');
		}


		$data = array(
			'title' 											=> 'Kart Düzenleme Paneli : #'.$card[0]->card_uid."# nolu kart ".$card[0]->created_at." Tarihinde eklenmiştir",
			'inputs'											=> array(
				array(
					'tag'											=> 'select',
					'label'										=> 'Personel Adi',
					'name'										=> 'personel_id',
					'class'										=> 'form-control',
					'options'									=> $options,
					'selected'								=> $card[0]->personels_id,
					'required'								=> 'true'
				),
				array(
					'tag'											=> 'input',
					'type'										=> 'hidden',
					'label'										=> '',
					'name'										=> 'card_uid',
					'class'										=> 'form-control',
					'value'										=> $card[0]->card_uid
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('cards/form');
		$this->load->view('layouts/bottom');
	}

	public function update($id)
	{
		if( $this->Card_Model->update($id) ){
			redirect('/cards');
		}else{

			$data = array(
				'title' 										=> 'Kart Bilgilerini Düzenle',
				'errors'										=> validation_errors()
			);

			$this->load->view('layouts/top', $data);
			$this->load->view('cards/form');
			$this->load->view('layouts/bottom');
		}
	}

	public function delete($id)
	{
		$where=array('id'=>$id);

		if( $this->Card_Model->delete($where) ){
			redirect('/cards');
		}else{
			$this->session->set_flashdata("danger","Silmek istediğiniz Kart bulunamadı.");
			redirect('/cards');
		}
	}


}
