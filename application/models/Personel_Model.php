<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Personel_Model extends CI_Model {

    function __construct()
    {
       $this->load->database();
       $this->load->Model('Card_Model');
       $this->load->Model('Card_Activity_Model');
       $this->load->Model('Archive_Personels_Model');
       $this->load->Model('Archive_Cards_Model');
       $this->load->library('form_validation');
    }

    public function all($where=NULL)
    {
      $this->db->select('personels.*, departments.title, job_rotations.title as job_rotations');
      $this->db->from('personels');
      $this->db->join('departments', 'personels.departments_id = departments.id','left');
      $this->db->join('job_rotations', 'personels.job_rotations_id=job_rotations.id','left');
      $this->db->join('cards', 'personels.id=cards.personels_id','left');
      if($where!=NULL)
        $this->db->group_by('personels.id');
      $query                       = $this->db->get();
      return $query->result();
    }

    public function create()
    {
      $this->form_validation->set_rules('name', 'Personel Adı', 'required');
      $this->form_validation->set_rules('surname', 'Personel Soyadı', 'required');
      $this->form_validation->set_rules('department_id', 'Departman Adı', 'required');
      $this->form_validation->set_rules('tc_no', 'TC', 'required');
      $this->form_validation->set_rules('date_of_start', 'İşe başlama tarihi düzgün girilmedi', 'required|regex_match[/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/]');

      if( $this->form_validation->run() == FALSE ){
        return FALSE;
      }else{
        $data = array(
          'name'                   => $this->input->post('name'),
          'surname'                => $this->input->post('surname'),
          'departments_id'         => $this->input->post('department_id'),
          'tc_no'                  => $this->input->post('tc_no'),
          'date_of_start'          => $this->input->post('date_of_start'),
          'job_rotations_id'       => $this->input->post('job_rotation_id')
        );

        $this->db->insert('personels', $data);

        return TRUE;
      }
    }

    public function find($id)
    {
      $where                       = array('id' => $id);
      $query                       = $this->db->get_where('personels', $where, 1, 0);
      if($query!=NULL){
        return $query->result()[0];
      }
      else {
        return NULL;
      }
    }

    public function update($id)
    {
      $this->form_validation->set_rules('name', 'Personel Adı', 'required');
      $this->form_validation->set_rules('surname', 'Personel Soyadı', 'required');
      $this->form_validation->set_rules('department_id', 'Departman', 'required');
      $this->form_validation->set_rules('tc_no', 'Tc kimlik', 'required');

      if( $this->form_validation->run() === FALSE ){
        return FALSE;
      }else{
        $where = array(
          'id'                     => $id
        );

        $data = array(
          'name'                   => $this->input->post('name'),
          'surname'                => $this->input->post('surname'),
          'departments_id'         => $this->input->post('department_id'),
          'tc_no'                  => $this->input->post('tc_no'),
          'job_rotations_id'       => $this->input->post('job_rotation_id')
        );

        $this->db->update('personels', $data, $where);

        return TRUE;
      }
    }

    public function delete($where)
    {
      $this->db->delete('personels', $where);

      if( $this->db->affected_rows() ){
        return TRUE;
      }else{
        return FALSE;
      }

    }//delete

    public function archive($personel_id)
    {
      $personel                             =   $this->find($personel_id);

      $card                                 =   $this->Card_Model->find(array('personels_id'  =>  $personel->id));



      //unset($personel->id);

      $this->Archive_Personels_Model->create($personel);

      if(empty($card)){

        return 0;

      }

      foreach ($card as $value) {

        $this->db->insert('archive_card', $value);
        $query                              =  $this->db->get_where('card_activities', array('cards_id'=>$value->id));

        if($query                          !=  NULL){

          $card_activities                  =  $query->result();

          foreach ($card_activities as $card_activity) {

            $this->db->insert('archive_card_activities', $card_activity);

          }//foreach($card_activities as $card_activity)
        }//if($query!=NULL)
      }

      $query                            =  $this->db->get_where('personel_activities', array('personels_id'=>$personel_id));
      $per_activities                   =  $query->result();
      if(empty($per_activities))
      {
        return 0;
      }
      foreach ($per_activities as $per_activity) {
        $this->db->insert('archive_personel_activities', $per_activity);
      }
      return 0;



    }//public function archive



}
