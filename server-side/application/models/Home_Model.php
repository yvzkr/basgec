<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Home_Model extends CI_Model {
  function __construct(){
     $this->load->database();
     $this->load->library('session');

  }
  public function find()
  {
    $this->db->where('password', $this->input->post('password'));
    $this->db->where('email',    $this->input->post('email'));
    $query = $this->db->get('users');
    if($query->num_rows() != 0)
    {
      $data=$query->result();
      $user=array(
        'id'      =>$data[0]->id,
        'name'    =>$data[0]->name,
        'surname' =>$data[0]->surname,
        'email'   =>$data[0]->email
      );
      $this->session->set_userdata('user',$user);
      return true;
    }
    else
    {
        return false;
    }

  }
}
