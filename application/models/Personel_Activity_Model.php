<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Personel_Activity_Model extends CI_Model {
  function __construct(){
     $this->load->database();

     $this->load->library('form_validation');
  }

  public function all($id=NULL)
  {
    if($id==NULL){
      $this->db->select('personel_activities.*, personels.name as name,personels.surname as surname');
      $this->db->from('personel_activities');
      $this->db->join('personels', 'personel_activities.personels_id = personels.id');
      $query = $this->db->get();
      return $query->result();
    }else {
      $this->db->select('personel_activities.*, personels.name as name,personels.surname as surname');
      $this->db->from('personel_activities');
      $this->db->join('personels', 'personel_activities.personels_id = personels.id');
      $this->db->where('personel_activities.id',$id);
      $query = $this->db->get();
      return $query->result();
    }

  }

  public function create($data)
  {

      $this->db->insert('personel_activities', $data);

      return TRUE;
  }

  public function delete($data)
  {
    //BU FONKSİYON BİR TANE ARRAY ALARAK ÇALIŞIR...
    $this->db->delete('personel_activities', $data);
    if($this->db->affected_rows()){
      return TRUE;
    }else{
      return FALSE;
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
          'personel_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'personel_activities.created_at_date<=' => $this->input->post('date_input_2')
        );
      }else {
        $where = array(
          'personel_activities.created_at_date>=' => $this->input->post('date_input_1'),
          'personel_activities.created_at_date<=' => $this->input->post('date_input_2'),
          'personels_id'                          => $this->input->post('personels')
        );
      }

      $this->db->select('personel_activities.*, personels.name as name,personels.surname as surname,activities.title as title');
      $this->db->from('personel_activities');
      $this->db->join('personels', 'personel_activities.personels_id = personels.id');
      $this->db->join('activities', 'personel_activities.activities_id = activities.id');
      $this->db->order_by('personel_activities.created_at_date','desc');
      $this->db->order_by('personel_activities.personels_id','desc');
      $this->db->order_by('personel_activities.created_at_hour');
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
          'personel_activities.created_at_date>=' =>  date('Y-m-d', now()),
          'personel_activities.created_at_date<=' =>  date('Y-m-d', now())
      );

      $this->db->select('personel_activities.*, personels.name as name,personels.surname as surname,activities.title as title');
      $this->db->from('personel_activities');
      $this->db->join('personels', 'personel_activities.personels_id = personels.id');
      $this->db->join('activities', 'personel_activities.activities_id = activities.id');
      $this->db->order_by('personel_activities.created_at_date','desc');
      $this->db->order_by('personel_activities.personels_id','desc');
      $this->db->order_by('personel_activities.created_at_hour');
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

  public function find($where)
  {

    $query                             =  $this->db->get_where('personel_activities', $where,1,0);
    if($query                         !=  NULL){
      return $query->result()[0];
    }else {
      return NULL;
    }
  }

  public function update($id1,$id2)
  {//burasi update

    $this->form_validation->set_rules('giris_saati', 'Giriş Saati girilmemiş', 'required');
    $this->form_validation->set_rules('giris_türü', 'Giriş Türü girilmemiş', 'required');
    $this->form_validation->set_rules('cikis_saati', 'Çıkış Saati girilmemiş', 'required');
    $this->form_validation->set_rules('cikis_türü', 'Çıkış Türü girilmemis', 'required');

    if( $this->form_validation->run() == TRUE )
    {
      /*echo $this->input->post('giris_saati');
      echo $this->input->post('giris_türü');
      echo $this->input->post('cikis_saati');
      echo $this->input->post('cikis_türü');*/
      $where                        = array(
        'id'                        => $id1
      );

      $data                         = array(
        'created_at_hour'           =>  $this->input->post('giris_saati'),
        'activities_id'             =>  $this->input->post('giris_türü')
      );

      $this->db->update('personel_activities', $data, $where);

      $where                        = array(
        'id'                        => $id2
      );

      $data                         = array(
        'created_at_hour'           =>  $this->input->post('cikis_saati'),
        'activities_id'             =>  $this->input->post('cikis_türü')
      );
      $this->db->update('personel_activities', $data, $where);

      return TRUE;

    }else{
      return FALSE;
    }



  }


}
