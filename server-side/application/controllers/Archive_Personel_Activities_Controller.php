<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive_Personel_Activities_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Archive_Personels_Model');
		$this->load->Model('Archive_Personel_Activity_Model');
		$this->load->helper('date');
		$this->load->library('form_validation');
		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	private function sifirlama($tampon){
		$tampon['id']								  =		NULL;
		$tampon['name']								  =		NULL;//
		$tampon['surname']							  =		NULL;///
		$tampon['title']							  =		NULL;
		$tampon['tarih']							  =		NULL;
		$tampon['girisaat']							  =		NULL;
		$tampon['giristur']						      =		NULL;
		$tampon['cikisaat']						      =		NULL;
		$tampon['id1']								  =		NULL;
		$tampon['id2']								  =		NULL;
		return $tampon;
	}

	private function siralama($personels_activity)
	{
		$tampon=array(
			'id'	=>NULL,
			'name'=>NULL,//
			'surname'=>NULL,///
			'title'=>NULL,
			'id1'=>NULL,
			'id2'=>NULL,
			'girisaat'=>NULL,
			'cikisaat'=>NULL,
			'giristur'=>NULL,
			'cikistur'=>NULL,
			'tarih'		=>NULL
		);

		$i																=	0;
		$per_activity											=	array();
		$onceki_per												=	0;
		$girisvar													=	0;
		$onceki_tarih											=	"";

		if(empty($personels_activity)){
			return NULL;
		}

		foreach($personels_activity as $value)
		{

			if($onceki_per									!=	$value->personels_id && $value->activities_id			==	1){
				if($girisvar==1){
					$per_activity[$i]						=		$tampon;
					$tampon											=   $this->sifirlama($tampon);
					$i													=		$i+1;
				}

				$tampon['id1']								=		$value->id;
				$tampon['name']								=		$value->name;
				$tampon['surname']						=		$value->surname;
				$tampon['tarih']							=		$value->created_at_date;
				$tampon['girisaat']						=		$value->created_at_hour;
				$tampon['giristur']						=		$value->title;
				$onceki_tarih									=		$value->created_at_date;
				$girisvar											=		1;
				$onceki_per										=		$value->personels_id;

			}else if ($onceki_per						==	$value->personels_id && $onceki_tarih			==	$value->created_at_date) {

				$tampon['cikisaat']						=		$value->created_at_hour;
				$tampon['cikistur']						=		$value->title;
				$tampon['id2']								=		$value->id;
				$onceki_tarih									=		"";
				$onceki_per										=		0;
				$per_activity[$i]							=		$tampon;
				$i														=		$i+1;
				$girisvar											=		0;
				$tampon=$this->sifirlama($tampon);

			}else if($onceki_per						!=	$value->personels_id && $value->activities_id			!=	1){
				if($girisvar==1){
					$per_activity[$i]						=		$tampon;
					$tampon=$this->sifirlama($tampon);
					$i													=		$i+1;
				}
				$tampon['id2']								=		$value->id;
				$tampon['name']								=		$value->name;
				$tampon['surname']						=		$value->surname;
				$tampon['tarih']							=		$value->created_at_date;
				$tampon['cikisaat']						=		$value->created_at_hour;
				$tampon['cikistur']						=		$value->title;
				$onceki_tarih									=		"";
				$onceki_per										=		0;
				$per_activity[$i]							=		$tampon;
				$i														=		$i+1;
				$girisvar											=		0;
				$tampon												=		$this->sifirlama($tampon);
			}else if($onceki_per						==	$value->personels_id && $onceki_tarih			==	$value->created_at_date)
			{

				if($girisvar==1){
					$per_activity[$i]						=		$tampon;
					$tampon=$this->sifirlama($tampon);
					$i													=		$i+1;
				}


				$tampon['id1']								=		$value->id;
				$tampon['name']								=		$value->name;
				$tampon['surname']						=		$value->surname;
				$tampon['tarih']							=		$value->created_at_date;
				$tampon['girisaat']						=		$value->created_at_hour;
				$tampon['giristur']						=		$value->title;
				$onceki_tarih									=		$value->created_at_date;
				$girisvar											=		1;
				$onceki_per										=		$value->personels_id;
			}else if($onceki_per						==	$value->personels_id && $onceki_tarih			!=	$value->created_at_date)
			{
				if($girisvar==1){
					$per_activity[$i]						=		$tampon;
					$tampon=$this->sifirlama($tampon);
					$i													=		$i+1;
				}
				$tampon['id1']									=		$value->id;
				$tampon['name']								=		$value->name;
				$tampon['surname']						=		$value->surname;
				$tampon['tarih']							=		$value->created_at_date;
				$tampon['girisaat']						=		$value->created_at_hour;
				$tampon['giristur']						=		$value->title;
				$onceki_tarih									=		$value->created_at_date;
				$girisvar											=		1;
				$onceki_per										=		$value->personels_id;
			}

		}
		if($girisvar==1)
		{
			$per_activity[$i]						=		$tampon;
		}

		return $per_activity;
	}




	public function index()
	{
		$option													    =	 array(
			"0"													    => "Hepsi"
		);

		$personels												    =	$this->Archive_Personel_Activity_Model->all();
		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->personels_id]				    = $personel->name." ".$personel->surname;
			}
		}
		$personels_activity											=	array();

		//$personels_activity											= $this->Personel_Activity_Model->search();
		$personels_activity											=	$this->siralama($this->Archive_Personel_Activity_Model->search());

		$data 														= array(
			'title' 					      						=>	'Personel Aktiviteleri',
			'personel_activities'									=>	$personels_activity,
			//'model_name'  		      							=>	'Personel Aktivite',
			'controller_name'	      								=>	'Personel Aktivite',
			'options'												=>	$option,
			'now'													=>	UNIX_TO_HUMAN(NOW()),
			'now2'													=>	UNIX_TO_HUMAN(NOW()),
			'selected'												=>	$this->input->post('personels')
		);



		$this->load->view('layouts/top', $data);
		$this->load->view('archive_personel_activities/index');
    	$this->load->view('layouts/bottom');
	}


	public function search()
	{
		$option																=	 array(
			"0"																=> "Hepsi"
		);

		$personels															=	$this->Archive_Personel_Activity_Model->all();

		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->personels_id]							= $personel->name." ".$personel->surname;
			}
		}
		$personels_activity											=	array();

		$personels_activity											=	$this->siralama($this->Archive_Personel_Activity_Model->search());

		$data 														= array(
			'title' 					      						=>	'Personel Aktiviteleri',
			'personel_activities'									=>	$personels_activity,
			//'model_name'  		      							=>	'Personel Aktivite',
			'controller_name'	      								=>	'Personel Aktivite',
			'options'												=>	$option,
			'now'													=>	$this->input->post('date_input_1'),
			'now2'													=>	$this->input->post('date_input_2'),
			'selected'												=>	$this->input->post('personels')
		);


    $this->load->view('layouts/top', $data);
	$this->load->view('archive_personel_activities/index');
    $this->load->view('layouts/bottom');
	}





}
