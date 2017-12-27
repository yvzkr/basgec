<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Department_Model extends CI_Model {
  function __construct(){
		 $this->load->database();
     $this->load->library('form_validation');
	}

  public function all( $select = '*' )
  {
    $this->db->select($select);
    $query = $this->db->get('departments');
    return $query->result();
  }

  public function create()
  {
    $this->form_validation->set_rules('title', 'Departman Adı', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $data = array(
        'title'       => $this->input->post('title'),
        'description' => $this->input->post('description')
      );

      $this->db->insert('departments', $data);

      return TRUE;
    }
  }

  public function find($id)
  {
    $query = $this->db->get_where('departments', array('id' => $id), 1, 0);

    return $query->result()[0];
  }

  public function update($id)
  {
    $this->form_validation->set_rules('title', 'Departman Adı', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $where = array(
        'id' => $id
      );

      $data = array(
        'title' => $this->input->post('title')
      );

      $this->db->update('departments', $data, $where);

      return TRUE;
    }
  }

  public function delete($id)
  {
    $where = array(
      'id' => $id
    );

    $this->db->delete('departments', $where);

    if( $this->db->affected_rows() ){
      return TRUE;
    }else{
      return FALSE;
    }
  }
}
