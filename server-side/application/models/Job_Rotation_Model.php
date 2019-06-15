<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Job_Rotation_Model extends CI_Model {

  function __construct(){
     $this->load->database();

     $this->load->library('form_validation');
  }

  public function all()
  {
    $query = $this->db->get('job_rotations');
    return $query->result();
  }

  public function find($where)
  {
    $query = $this->db->get_where('job_rotations', $where, 1, 0);
    return $query->result()[0];
  }

  public function create()
  {
    $this->form_validation->set_rules('title', 'Vardiya Adı', 'required');
    $this->form_validation->set_rules('start_time', 'Başlama Saati', 'required|regex_match[/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/]');
    $this->form_validation->set_rules('finish_time', 'Bitiş Saati',  'required|regex_match[/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/]');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $data = array(
        'title'               => $this->input->post('title'),
        'start_time'          => $this->input->post('start_time'),
        'finish_time'         => $this->input->post('finish_time')
      );

      $this->db->insert('job_rotations', $data);

      return TRUE;
    }
  }

  public function update($id)
  {
    $this->form_validation->set_rules('title', 'Vardiya Adı', 'required');
    $this->form_validation->set_rules('start_time', 'Başlama Saati', 'required|regex_match[/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/]');
    $this->form_validation->set_rules('finish_time', 'Bitiş Saati',  'required|regex_match[/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/]');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $where = array(
        'id' => $id
      );

      $data = array(
        'title'               => $this->input->post('title'),
        'start_time'          => $this->input->post('start_time'),
        'finish_time'         => $this->input->post('finish_time')
      );

      $this->db->update('job_rotations', $data, $where);

      return TRUE;
    }
  }

  public function delete($id)
  {
    $where = array(
      'id' => $id
    );

    $this->db->delete('job_rotations', $where);

    if( $this->db->affected_rows() ){
      return TRUE;
    }else{
      return FALSE;
    }
  }

}
