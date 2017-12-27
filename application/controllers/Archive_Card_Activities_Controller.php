<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive_Card_Activities_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Archive_Card_Activities_Model');
		$this->load->helper('string');
		$this->load->helper('date');
		
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}
	public function index()
	{
		$option													=	 array(
			"0"													=> "Hepsi"
		);
		$personels												=	 $this->Archive_Card_Activities_Model->all();
		if(!empty($personels))
		{
			foreach ($personels as $personel) {
				$option[$personel->cards_id]					= $personel->name." ".$personel->surname;
			}
		}


		$data 													=	 array(
			'title' 											=> 'Silinmiş Olan Kart Aktiviteleri',
			'card_activity' 									=> $this->Archive_Card_Activities_Model->search(),
			'controller_name'									=> 'card_activity',
			'model_name'  										=> 'Kart aktivite',
			'options'											=> $option,
			'now'												=> UNIX_TO_HUMAN(NOW()),
			'now2'												=> UNIX_TO_HUMAN(NOW()),
			'selected'											=> 0
		);


		$this->load->view('layouts/top', $data);
		$this->load->view('archive_card_activities/index');		
    	$this->load->view('layouts/bottom');
	}

	public function search()
	{
		$option													=	 array(
			"0"													=> "Hepsi"
		);

		$personels												=	 $this->Archive_Card_Activities_Model->all();
		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->cards_id]					= $personel->name." ".$personel->surname;
			}
		}

		$data 													=	 array(
			'title' 											=> 'kart aktivite',
			'card_activity' 									=> $this->Archive_Card_Activities_Model->search(),
			'controller_name'									=> 'card_activity',
			'model_name'  										=> 'Kart aktiviti',
			'options'											=> $option,
			'now'												=> $this->input->post('date_input_1'),
			'now2'												=> $this->input->post('date_input_2'),
			'selected'											=> $this->input->post('cards')
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('archive_card_activities/index');
		$this->load->view('layouts/bottom');
	}






}
