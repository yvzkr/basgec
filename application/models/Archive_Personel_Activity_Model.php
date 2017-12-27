<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Archive_Personel_Activity_Model extends CI_Model {
  function __construct(){
     $this->load->database();

     $this->load->library('form_validation');
  }

  public function all($id=NULL)
  {
    if($id==NULL){
      $this->db->select('archive_personel_activities.*, archive_personel.name as name,archive_personel.surname as surname');
      $this->db->from('archive_personel_activities');
      $this->db->join('archive_personel', 'archive_personel_activities.personels_id = archive_personel.id');
      $query = $this->db->get();
      return $query->result();
    }else {
      $this->db->select('archive_personel_activities.*, archive_personel.name as name,archive_personel.surname as surname');
      $this->db->from('archive_personel_activities');
      $this->db->join('archive_personel', 'archive_personel_activities.personels_id = archive_personel.id');
      $this->db->where('archive_personel_activities.id',$id);
      $query = $this->db->get();
      return $query->result();
    }

  }

  public function search()
  {
    $this->form_validation->set_rules('date_input_1', 'İlk Tarih gereklidir', 'required');
    $this->form_validation->set_rules('date_input_2', 'Son Tarih gereklidir', 'required');
    $this->form_validation->set_rules('personels', 'Personel Ismi gereklidir', 'required');
    if($this->form_validation->run()  != FALSE)
    {
      if ($this->input->post('personels') ==  0){
        $where = array(
          'archive_personel_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'archive_personel_activities.created_at_date<=' => $this->input->post('date_input_2')
        );
      }else {
        $where = array(
          'archive_personel_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'archive_personel_activities.created_at_date<=' => $this->input->post('date_input_2'),
          'personels_id'                                  => $this->input->post('personels')
        );
      }

      $this->db->select('archive_personel_activities.*, archive_personel.name as name,archive_personel.surname as surname,activities.title as title');
      $this->db->from('archive_personel_activities');
      $this->db->join('archive_personel', 'archive_personel_activities.personels_id = archive_personel.id');
      $this->db->join('activities', 'archive_personel_activities.activities_id = activities.id');
      $this->db->order_by('archive_personel_activities.created_at_date','desc');
      $this->db->order_by('archive_personel_activities.personels_id','desc');
      $this->db->order_by('archive_personel_activities.created_at_hour');
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
    }//buraya kadar if($this->form_validation->run()  != FALSE)
    else
    {

      $where = array(
          'archive_personel_activities.created_at_date>=' =>  date('Y-m-d', now()),
          'archive_personel_activities.created_at_date<=' =>  date('Y-m-d', now())
      );

      $this->db->select('archive_personel_activities.*, archive_personel.name as name,archive_personel.surname as surname,activities.title as title');
      $this->db->from('archive_personel_activities');
      $this->db->join('archive_personel', 'archive_personel_activities.personels_id = archive_personel.id');
      $this->db->join('activities', 'archive_personel_activities.activities_id = activities.id');
      $this->db->order_by('archive_personel_activities.created_at_date','desc');
      $this->db->order_by('archive_personel_activities.personels_id','desc');
      $this->db->order_by('archive_personel_activities.created_at_hour');
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
    }//else



  }









}
