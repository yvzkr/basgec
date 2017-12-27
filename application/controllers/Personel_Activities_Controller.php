<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personel_Activities_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->Model('Personel_Activity_Model');
		$this->load->Model('Personel_Model');
		$this->load->Model('Activity_Model');
		$this->load->helper('date');
		$this->load->library('form_validation');

		if(!$this->session->userdata('user'))
		{
			redirect('');
		}
	}

	private function sifirlama($tampon){
		$tampon['id']								  =		NULL;
		$tampon['name']								=		NULL;//
		$tampon['surname']						=		NULL;///
		$tampon['title']							=		NULL;
		$tampon['tarih']							=		NULL;
		$tampon['girisaat']						=		NULL;
		$tampon['giristur']						=		NULL;
		$tampon['cikisaat']						=		NULL;
		$tampon['id1']								=		NULL;
		$tampon['id2']								=		NULL;
		return $tampon;
	}

/*
	private function sirala($personels){
		$tampon=array(
			'name'=>NULL,//
			'surname'=>NULL,///
			'title'=>NULL,
			'tarih'=>NULL,
			'id1'=>NULL,
			'id2'=>NULL,
			'id'=>NULL,
			'personel_id'=>NULL,
			'girisaat'=>NULL,
			'cikisaat'=>NULL,
			'giristur'=>NULL,
			'cikistur'=>NULL
		);
		$per_activity											=	array();

		if(	empty($personels)	){
			return NULL;
		}
		$kontrol													=	0;

		foreach($personels_activity as $value)
		{
			if($tampon["tarih"]!=$value->created_at_date)
			{
				$tampon['id']									=		$value->personels_id;
				$tampon['id1']								=		$value->id;
				$tampon['name']								=		$value->name;
				$tampon['surname']						=		$value->surname;
				$tampon['tarih']							=		$value->created_at_date;
				$tampon['girisaat']						=		$value->created_at_hour;
				$tampon['giristur']						=		$value->title;

				$kontrol											=		1;

			}else if($tampon["tarih"]==$value->created_at_date)
			{
				if($tampon['id']==$value->personels_id)
				{


				}



			}


		}





	}
*/


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
		$option													=	 array(
			"0"														=> "Hepsi"
		);

		$personels											=$this->Personel_Activity_Model->all();
		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->personels_id]			= $personel->name." ".$personel->surname;
			}
		}
		//$personels_activity											= $this->Personel_Activity_Model->search();
		$personels_activity											=	array();


		$personels_activity											=	$this->siralama($this->Personel_Activity_Model->search());


		$data = array(
			'title' 					      			=> 'Personel Aktiviteleri',
			'personel_activities'						=> $personels_activity,
			//'model_name'  		     			    => 'Personel Aktivite',
			'controller_name'	     				    => 'Personel Aktivite',
			'options'									=>	$option,
			'now'										=> UNIX_TO_HUMAN(NOW()),
			'now2'										=> UNIX_TO_HUMAN(NOW()),
			'selected'									=> 0
		);
		$data2=array();

		$data2=$this->add();


    $this->load->view('layouts/top', $data);
		$this->load->view('personel_activities/personel_activities_add',$data2);
		$this->load->view('personel_activities/index');
    $this->load->view('layouts/bottom');
	}

	public function search()
	{
		$option																=	 array(
			"0"																=> "Hepsi"
		);

		$personels															=	$this->Personel_Activity_Model->all();

		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->personels_id]		= $personel->name." ".$personel->surname;
			}
		}
		$personels_activity											=	array();

		$personels_activity											=	$this->siralama($this->Personel_Activity_Model->search());

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

		$data2														=		array();

		$data2														=		$this->add();

    $this->load->view('layouts/top', $data);
	$this->load->view('personel_activities/personel_activities_add',$data2);
	$this->load->view('personel_activities/index');
    $this->load->view('layouts/bottom');
	}

	public function add()
	{

		$option																=	 array();

		$personels														=		$this->Personel_Model->all();
		if(!empty($personels)){
			foreach ($personels as $personel) {
				$option[$personel->id]						= $personel->name." ".$personel->surname;
			}
		}

		$activities   		 										= $this->Activity_Model->all();
		$option_activity   		 								= array();

		foreach ($activities as $activity) {
			$option_activity[$activity->id]			= $activity->title;
		}





		$data = array(
			'title' 										=> 'Yeni kart aktvite Ekle',
			'inputs'										=> array(
				array(
					'tag'										=> 'select',
					'label'									=> 'Personel',
					'name'									=> 'personel',
					'class'									=> 'form-control',
					'options'								=> $option,
					'selected'							=> '',
					'required'							=> 'true',
					'autocomplete'					=> 'off'
				),
				array(
					'tag'										=> 'select',
					'label'									=> 'Aktivite Adi',
					'name'									=> 'activities_id',
					'class'									=> 'form-control',
					'options'								=> $option_activity,
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

		return $data;


		/*$this->load->view('layouts/top', $data);
		$this->load->view('card_activities/form');
		$this->load->view('layouts/bottom');*/
	}

	public function create()
	{

		$this->form_validation->set_rules('personel', 'Personel ', 'required');
		$this->form_validation->set_rules('activities_id', 'Aktivite adi', 'required');
		$this->form_validation->set_rules('tarih', 'Tarih', 'required');
		$this->form_validation->set_rules('saat', 'Saat', 'required');
		if($this->form_validation->run()  != FALSE){
			$data                          = array(
				'personels_id'							 => $this->input->post('personel'),
				'activities_id'              => $this->input->post('activities_id'),
				'created_at_date'            => $this->input->post('tarih'),
				'created_at_hour'            => $this->input->post('saat').":00"
			);
			if($this->Personel_Activity_Model->create($data)){
				//redirect("/personel_activities");
			}else{
				redirect("/personel_activities");
			}

		}








	}

	public function edit($id1=0,$id2=0)
	{

		$activities   		 						= $this->Activity_Model->all();
		$option				     		 				= array();

		foreach ($activities as $activity) {
			$option[$activity->id]			= $activity->title;
		}



		$per_activity1								= $this->Personel_Activity_Model->all($id1);

		$per_activity2								= $this->Personel_Activity_Model->all($id2);

		$data 												= array(
			'title' 										=> 'Personel Giriş Çıkış Düzenleme',
			'inputs'										=> array(
				array(
					'tag'										=> 'input',
					'label'									=> 'Personel',
					'type'									=> 'text',
					'name'									=> 'name',
					'class'									=> 'form-control',
					'placeholder' 					=> 'Personel Adı',
					'required'							=> 'true',
					'disabled'							=> 'disabled',
					'autocomplete'					=> 'off',
					'value'									=> $per_activity1[0]->name." ".$per_activity1[0]->surname
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Tarih',
							'type'									=> 'date',
							'name'									=> 'tarih',
							'class'									=> 'form-control',
							'disabled'							=> 'disabled',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> $per_activity1[0]->created_at_date
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Giriş Saati',
							'type'									=> 'text',
							'name'									=> 'giris_saati',
							'class'									=> 'form-control',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> $per_activity1[0]->created_at_hour
				),
				array(
							'tag'										=> 'select',
							'label'									=> 'Giriş Türü',
							'name'									=> 'giris_türü',
							'class'									=> 'form-control',
							'options'								=> $option,
							'selected'							=> $per_activity1[0]->activities_id,
							'required'							=> 'true',
							'autocomplete'					=> 'off'
				),
				array(
							'tag'										=> 'input',
							'label'									=> 'Çıkış Saati',
							'type'									=> 'text',
							'name'									=> 'cikis_saati',
							'class'									=> 'form-control',
							'required'							=> 'true',
							'autocomplete'					=> 'off',
							'value'									=> $per_activity2[0]->created_at_hour
				),
				array(
							'tag'										=> 'select',
							'label'									=> 'Çıkış Türü',
							'name'									=> 'cikis_türü',
							'class'									=> 'form-control',
							'options'								=> $option,
							'selected'							=> $per_activity2[0]->activities_id,
							'required'							=> 'true',
							'autocomplete'					=> 'off'
				)
			)
		);

		$this->load->view('layouts/top',$data);
		$this->load->view('personel_activities/form');
		$this->load->view('layouts/bottom');

	}

	public function update($id1,$id2)
	{
		if( $this->Personel_Activity_Model->update($id1,$id2) ){
			redirect('/personel_activities');
		}else{
			redirect('/personel_activities');
		}
	}

	public function delete($id1,$id2)
	{

		if($id1=="null" && $id2!="null"){
			//bu yazi olarak NULL yazıldı
			$data = array('id' => $id2 );
			if( $this->Personel_Activity_Model->delete($data) ){
				//echo "naber";
				redirect('/personel_activities');
			}else{
				redirect('/personel_activities');
			}
		}
		else if ($id1!="null" && $id2=="null")
		{
			$data = array('id' => $id1 );
			if( $this->Personel_Activity_Model->delete($data) ){
				redirect('/personel_activities');
			}else{
				redirect('/personel_activities');
			}
		}else if($id1!="null" && $id2!="null")
		{
			$data = array('id' => $id1 );
			$data2 = array('id' => $id2 );

			if( $this->Personel_Activity_Model->delete($data) && $this->Personel_Activity_Model->delete($data2)){
				redirect('/personel_activities');
			}else{
				redirect('/personel_activities');
			}

		}//else if($id1!="null" && $id2!="null")
	}//public function delete($id1,$id2)

}
