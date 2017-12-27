<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card_Activities_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Card_Activity_Model');
		$this->load->Model('Activity_Model');
		$this->load->Model('Card_Model');
		$this->load->Model('Personel_Model');
		$this->load->Model('Job_Rotation_Model');
		$this->load->helper('string');
		$this->load->helper('date');
	}

	public function index()
	{
		$option													=	 array(
			"0"													=> "Hepsi"
		);
		$personels												=	 $this->Card_Activity_Model->all();
		if(!empty($personels))
		{
			foreach ($personels as $personel) {
				$option[$personel->cards_id]					= $personel->name." ".$personel->surname;
			}
		}


		$data 													=	 array(
			'title' 											=> 'kart aktivite',
			'card_activity' 									=> $this->Card_Activity_Model->search(),
			'controller_name'									=> 'card_activity',
			'model_name'  										=> 'Kart aktivite',
			'options'											=> $option,
			'now'												=> UNIX_TO_HUMAN(NOW()),
			'now2'												=> UNIX_TO_HUMAN(NOW()),
			'selected'											=> 0
		);


		$this->load->view('layouts/top', $data);
		$this->load->view('card_activities/index');
		$this->load->view('layouts/bottom');
	}

	public function add()
	{

		$cards			 	     		 				= $this->Card_Model->all();
		$options			     		 				= array();

		foreach ($cards as $card) {
			$options[$card->card_uid] 	= $card->name." ".$card->surname."(".$card->card_uid.")";
		}

		$activities   		 						= $this->Activity_Model->all();
		$option				     		 				= array();

		foreach ($activities as $activity) {
			$option[$activity->id]			= $activity->title;
		}

		$data = array(
			'title' 										=> 'Yeni kart aktvite Ekle',
			'inputs'										=> array(
				array(
					'tag'										=> 'select',
					'label'									=> 'Kart id',
					'name'									=> 'card_uid',
					'class'									=> 'form-control',
					'options'								=> $options,
					'selected'							=> '',
					'required'							=> 'true',
					'autocomplete'					=> 'off'
				),
				array(
					'tag'										=> 'select',
					'label'									=> 'Aktivite Adi',
					'name'									=> 'activities_id',
					'class'									=> 'form-control',
					'options'								=> $option,
					'selected'							=> '',
					'required'							=> 'true',
					'autocomplete'					=> 'off'
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Tarih',
							'type'									=> 'date',
							'name'									=> 'tarih',
							'class'									=> 'form-control',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> date('Y-m-d', now())
				),
				array(
					'tag'										=> 'input',
					'label'									=> 'Saat',
					'type'									=> 'time',
					'name'									=> 'saat',
					'class'									=> 'form-control',
					'autocomplete'					=> 'off',
					'value'									=> '00:00:00'
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('card_activities/form');
		$this->load->view('layouts/bottom');
	}

	public function create()
	{
		if($personels=$this->Card_Activity_Model->create(NULL)){
			$personel=$this->Personel_Model->find($personels->personels_id);
			$data = array(
				'status' 									=> 1,//'yeni aktivite eklendi'
				'personelName'						=> $personel->name,
				'personelSurname'					=> $personel->surname
			);
			echo json_encode($data);
			//redirect("/card_activities");
		}else{
			$data = array(
				'status' 									=> '0'//hatili
			);
			echo json_encode($data);
			//redirect("/card_activities");
		}
	}

	public function edit($id)
	{
		$card_activity								=  $this->Card_Activity_Model->all($id);
		$data 												= array(
			'title' 										=> 'Personel Giriş Çıkış Düzenleme',
			'inputs'										=> array(
				array(
					'tag'										=> 'input',
					'label'									=> 'Personel Adı',
					'type'									=> 'text',
					'name'									=> 'name',
					'class'									=> 'form-control',
					'placeholder' 					=> 'Personel Adı',
					'required'							=> 'true',
					'disabled'							=> 'disabled',
					'autocomplete'					=> 'off',
					'value'									=> $card_activity[0]->name." ".$card_activity[0]->surname
				),
				array(
						'tag'										=> 'input',
						'label'									=> 'Aktivite',
						'type'									=> 'text',
						'name'									=> 'aktivite',
						'class'									=> 'form-control',
						'required'							=> 'true',
						'disabled'							=> 'disabled',
						'autocomplete'					=> 'off',
						'value'									=> $card_activity[0]->title
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Tarih',
							'type'									=> 'date',
							'name'									=> 'tarih',
							'class'									=> 'form-control',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> $card_activity[0]->created_at_date
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Saat',
							'type'									=> 'time',
							'name'									=> 'saat',
							'class'									=> 'form-control',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> $card_activity[0]->created_at_hour
				),
				array(
					'tag'											=> 'input',
					'type'										=> 'hidden',
					'label'										=> '',
					'name'										=> 'id',
					'class'										=> 'form-control',
					'value'										=> $card_activity[0]->id
				),
				array(
					'tag'											=> 'input',
					'type'										=> 'hidden',
					'label'										=> '',
					'name'										=> 'cards_id',
					'class'										=> 'form-control',
					'value'										=> $card_activity[0]->cards_id
				),
				array(
					'tag'											=> 'input',
					'type'										=> 'hidden',
					'label'										=> '',
					'name'										=> 'personel_id',
					'class'										=> 'form-control',
					'value'										=> $card_activity[0]->personel_id
				)
			)
		);

		$this->load->view('layouts/top', $data);
		$this->load->view('card_activities/form');
		$this->load->view('layouts/bottom');
	}

	public function update($id)
	{
		//echo increment_string($this->input->post('tarih'), ' ');
		if( $this->Card_Activity_Model->update($id)){
			redirect('/card_activities');
		}else{
			redirect('/card_activities');
		}
	}

	public function delete($id)
	{
		$data = array('id' => $id );
		if( $this->Card_Activity_Model->delete($data) ){
			redirect('/card_activities');
		}else{
			redirect('/card_activities');
		}
	}//public function delete($id)

	public function search()
	{
		$option													=	 array(
			"0"														=> "Hepsi"
		);

		$personels											=	 $this->Card_Activity_Model->all();
		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->cards_id]			= $personel->name." ".$personel->surname;
			}
		}

		$data 										=	 array(
			'title' 											=> 'kart aktivite',
			'card_activity' 									=> $this->Card_Activity_Model->search(),
			'controller_name'									=> 'card_activity',
			'model_name'  										=> 'Kart aktiviti',
			'options'											=> $option,
			'now'												=> $this->input->post('date_input_1'),
			'now2'												=> $this->input->post('date_input_2'),
			'selected'											=> $this->input->post('cards')
		);

		$this->load->view('layouts/top', $data);

		$this->load->view('card_activities/index');
		$this->load->view('layouts/bottom');
	}

	public function find()
	{
		//raspberry icin
		$where												=		array(
			'card_uid'									=>	$this->input->post("card_uid")
		);
		$card=$this->Card_Model->find($where);
		if($card											==	NULL){
			$mesaj 											= 	array(
				'status'									=> 	0,
				'information'							=>	'Boyle bir kart yoktur.'
			);
			echo json_encode($mesaj);
			return NULL;
		}
		$id														=		$card[0]->personels_id;
		$personel_info								=		$this->Personel_Model->find($id);
		if(empty($personel_info))
		{
				$mesaj 										= 	array(
					'status'								=> 	0,
					'information'						=>	'Bu kart hicbir kisiye atanmamistir.'
				);
				echo json_encode($mesaj);
				return NULL;
		}

		$where 												= array(
			'id' 												=> 	$personel_info->job_rotations_id
		);

		$job_rotation									=		$this->Job_Rotation_Model->find($where);

		$vardiya											=		strtotime($job_rotation->start_time);
		$alt_saat											=		date('H:i:s', $vardiya - 60*60);
		$ust_saat											=		date('H:i:s', $vardiya + 60*60);

		if($alt_saat<date('H:i:s', time()) && $ust_saat>date('H:i:s', time()) )
		{
			$this->Card_Activity_Model->create($card[0]->id);
			//eger vardiya saati arasinda ise giris yapilir
			$mesaj = array(
					'status' 								=> 		2,
					'information'						=>		"Giris islemi yapilmistir.",
					'personelName'					=>		$personel_info->name,
					'personelSurname' 			=>		$personel_info->surname
				);

				echo json_encode($mesaj);
				return NULL;
		}else{

			$mesaj = array(
				'status' 									=> 		1,//"Vardiya saatleri arasinda degil ise "
				'information'							=>		"Giris yapmamistir.",
				'personelName'				 		=>		$personel_info->name,
				'personelSurname'				  =>		$personel_info->surname
			);

			echo json_encode($mesaj);
			return NULL;

		}

	}//public function find(){

	public function approve($id){
		if( $this->Card_Activity_Model->approve($id)){
			redirect('/card_activities');
		}else{
			redirect('/card_activities');
		}
	}


}//class Card_Activities_Controller extends CI_Controller {
