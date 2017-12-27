<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Card_Activity_Model extends CI_Model {

  function __construct()
  {
     $this->load->database();
     $this->load->Model('Personel_Activity_Model');
     $this->load->Model('Job_Rotation_Model');
     $this->load->helper('date');
  }

  public function all($where=NULL)
  {
    $this->db->select('card_activities.*,activities.id as activities_id,activities.title as title,personels.id as personel_id,cards.card_uid as kart,personels.name as name, personels.surname as surname');
    $this->db->from('card_activities');
    $this->db->join('activities', 'activities.id=card_activities.activities_id');
    $this->db->join('cards', 'cards.id=card_activities.cards_id');
    $this->db->join('personels', 'cards.personels_id=personels.id');
    $this->db->order_by('card_activities.created_at_date','desc');
    $this->db->order_by('card_activities.created_at_hour','desc');
    if($where!=NULL)
      $this->db->where('card_activities.id',$where);
    $query = $this->db->get();
    if($query->num_rows() != 0)
    {
        return $query->result();
    }
    else
    {
        return false;
    }
  }

  public function create($kontrol=NULL)
  {
    if($kontrol!=NULL){

      $data                          = array(
        'cards_id'                   => $kontrol,
        'activities_id'              => 1,
        'created_at_date'            => date('Y-m-d', now()),
        'created_at_hour'            => date('H:i:s', now())
      );
      $this->db->insert('card_activities', $data);
    }

    $this->form_validation->set_rules('card_uid', 'Kart Adi', 'required');
    $this->form_validation->set_rules('activities_id', 'Aktivite adi', 'required');
    if($this->form_validation->run()  != FALSE)
    {
      $data=array(
        'card_uid'                       => $this->input->post('card_uid')
      );

      $card                              = $this->Card_Model->find($data);
      //var mı
      $now                               = time();
  		$datestring                        = '%Y-%m-%d';
  		$date                              = mdate($datestring, $now);

      if( $card !=  NULL and $card[0]->personels_id !=  NULL )
      {
        if($this->input->post('tarih')!=NULL and $this->input->post('saat')!=NULL){
          $data                          = array(
            'cards_id'                   => $card[0]->id,
            'activities_id'              => $this->input->post('activities_id'),
            'created_at_date'            => $this->input->post('tarih'),
            'created_at_hour'            => $this->input->post('saat').":00"
          );

        }else{

          $data                          = array(
            'cards_id'                   => $card[0]->id,
            'activities_id'              => $this->input->post('activities_id'),
            'created_at_date'            => date('Y-m-d', now()),
            'created_at_hour'            => date('H:i:s', now())
          );
        }
        $this->db->insert('card_activities', $data);
        return $card[0];
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  public function find($where)
  {
    $query                             = $this->db->get_where('card_activities', $where,1,0);
    if($query!=NULL){
      return $query->result();
    }else {
      return NULL;
    }
  }

  public function delete($data)
  {
    //BU FONKSİYON BİR TANE ARRAY ALARAK ÇALIŞIR...
    $this->db->delete('card_activities', $data);
    if($this->db->affected_rows()){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function update($id)
  {
    $this->form_validation->set_rules('id', 'Kart Adı', 'required');
    $this->form_validation->set_rules('activities_id', 'Aktivite adi', 'required');
    $this->form_validation->set_rules('tarih', 'Tarih girilmemis', 'required');
    $this->form_validation->set_rules('saat', 'Saat girilmemis', 'required');

    if( $this->form_validation->run() == FALSE )
    {
      $data = array(
          'approve'                   => 1
      );

      $where                        = array(
        'id'                        => $id
      );

      $this->db->update('card_activities', $data, $where);
      $query                             = $this->db->get_where('card_activities', $where);
      $card_aktivity                     = $query->result()[0];


      $data=array(
        'card_activities_id'        =>  $this->input->post('id'),
        'personels_id'              =>  $this->input->post('personel_id'),
        //'diffrence'                 =>  "08:00:00"-$this->input->post('saat'),
        'created_at_hour'           =>  $this->input->post('saat'),
        'created_at_date'           =>  $this->input->post('tarih'),
        'activities_id'             =>  $card_aktivity->activities_id
      );
      $this->Personel_Activity_Model->create($data);
      return true;
    }else{
      return false;
    }

  }

  public function search()
  {
    $this->form_validation->set_rules('date_input_1', 'İlk Tarih gereklidir', 'required');
    $this->form_validation->set_rules('date_input_2', 'Son Tarih gereklidir', 'required');
    $this->form_validation->set_rules('cards', 'Personel Ismi gereklidir', 'required');

    if($this->form_validation->run()  != FALSE)
    {
      if ($this->input->post('cards')==0){
        $where = array(
          'card_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'card_activities.created_at_date<=' => $this->input->post('date_input_2')
        );
      }else {
        $where = array(
          'card_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'card_activities.created_at_date<=' => $this->input->post('date_input_2'),
          'cards_id'                          => $this->input->post('cards')
        );
      }

      $this->db->select('card_activities.*,activities.id as activities_id,activities.title as title,personels.id as personel_id,cards.card_uid as kart,personels.name as name, personels.surname as surname');
      $this->db->from('card_activities');
      $this->db->join('activities', 'activities.id=card_activities.activities_id');
      $this->db->join('cards', 'cards.id=card_activities.cards_id');
      $this->db->join('personels', 'cards.personels_id=personels.id');
      $this->db->order_by('card_activities.created_at_date','desc');
      $this->db->order_by('cards.card_uid','desc');
      $this->db->order_by('card_activities.created_at_hour');



      if($where!=NULL)
        $this->db->where($where);


      $query = $this->db->get();
      if($query->num_rows() != 0)
      {
          return $query->result();
      }
      else
      {
          return false;
      }
    }//if($this->form_validation->run()  != FALSE)
    else{

      $where = array(
        'card_activities.created_at_date>=' => date('Y-m-d', now()),
        'card_activities.created_at_date<=' => date('Y-m-d', now())
      );

      $this->db->select('card_activities.*,activities.id as activities_id,activities.title as title,personels.id as personel_id,cards.card_uid as kart,personels.name as name, personels.surname as surname');
      $this->db->from('card_activities');
      $this->db->join('activities', 'activities.id=card_activities.activities_id');
      $this->db->join('cards', 'cards.id=card_activities.cards_id');
      $this->db->join('personels', 'cards.personels_id=personels.id');
      $this->db->order_by('card_activities.created_at_date','desc');
      $this->db->order_by('cards.card_uid','desc');
      $this->db->order_by('card_activities.created_at_hour');


      if($where!=NULL)
        $this->db->where($where);
      $query = $this->db->get();
      if($query->num_rows() != 0)
      {
          return $query->result();
      }
      else
      {
          return false;
      }

    }
  }//public function search(){

  public function approve($id)
  {
    $data = array(
        'approve'                       => 1
    );

    $where                              = array(
      'id'                              => $id
    );



    $this->db->update('card_activities', $data, $where);//446

    $query                              = $this->db->get_where('card_activities', $where);
    $card_aktivity                      = $query->result()[0];

    $card_id                            = $card_aktivity->cards_id;//6
    $where                              = array(
      'id'                              => $card_id
    );

    $query                              = $this->db->get_where('cards', $where);
    $card                               = $query->result()[0];

    $data=array(
      'card_activities_id'              =>  $card_aktivity->id,
      'personels_id'                    =>  $card->personels_id,
      //'diffrence'                 =>  "08:00:00"-$this->input->post('saat'),
      'created_at_hour'                 =>  $card_aktivity->created_at_hour,
      'created_at_date'                 =>  $card_aktivity->created_at_date,
      'activities_id'                   =>  $card_aktivity->activities_id
    );
    $this->Personel_Activity_Model->create($data);

    return true;


  }



}
