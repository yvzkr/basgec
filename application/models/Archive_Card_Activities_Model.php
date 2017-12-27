<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Archive_Card_Activities_Model extends CI_Model {

    function __construct()
    {
       $this->load->database();
       $this->load->library('form_validation');
    }
    public function create($data){

      $this->db->insert('archive_card', $data);
      return TRUE;
    }
    public function all($where=NULL)
  {
    $this->db->select('archive_card_activities.*,activities.id as activities_id,activities.title as title,archive_personel.id as personel_id,archive_card.card_uid as kart,archive_personel.name as name, archive_personel.surname as surname');
    $this->db->from('archive_card_activities');
    $this->db->join('activities', 'activities.id=archive_card_activities.activities_id');
    $this->db->join('archive_card', 'archive_card.id=archive_card_activities.cards_id');
    $this->db->join('archive_personel', 'archive_card.personels_id=archive_personel.id');
    $this->db->order_by('archive_card_activities.created_at_date','desc');
    $this->db->order_by('archive_card_activities.created_at_hour','desc');

    $query = $this->db->get();
    return $query->result();
    
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
          'archive_card_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'archive_card_activities.created_at_date<=' => $this->input->post('date_input_2')
        );
      }else {
        $where = array(
          'archive_card_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'archive_card_activities.created_at_date<=' => $this->input->post('date_input_2'),
          'cards_id'                                  => $this->input->post('cards')
        );
      }

      $this->db->select('archive_card_activities.*,archive_personel.name as name,archive_personel.surname as surname, activities.title as title');
      $this->db->from('archive_card_activities');
      $this->db->join('archive_card','archive_card.id=archive_card_activities.cards_id');
      $this->db->join('archive_personel','archive_personel.id=archive_card.personels_id');
      $this->db->join('activities','activities.id=archive_card_activities.activities_id');

      $this->db->order_by('archive_card_activities.created_at_date','desc');

      $this->db->order_by('archive_card_activities.created_at_hour');



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
        'archive_card_activities.created_at_date>=' => date('Y-m-d', now()),
        'archive_card_activities.created_at_date<=' => date('Y-m-d', now())
      );

      $this->db->select('archive_card_activities.*,archive_personel.name as name,archive_personel.surname as surname, activities.title as title');
      $this->db->from('archive_card_activities');
      $this->db->join('archive_card','archive_card.id=archive_card_activities.cards_id');
      $this->db->join('archive_personel','archive_personel.id=archive_card.personels_id');
      $this->db->join('activities','activities.id=archive_card_activities.activities_id');

      $this->db->order_by('archive_card_activities.created_at_date','desc');
      
      $this->db->order_by('archive_card_activities.created_at_hour');


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




}
