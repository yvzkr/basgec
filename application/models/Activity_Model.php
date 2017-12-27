<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Activity_Model extends CI_Model {
  function __construct(){
     $this->load->database();

     $this->load->library('form_validation');
  }
  public function all()
  {
    $query = $this->db->get('activities');
    return $query->result();
  }

  public function find($id)
  {
    $query = $this->db->get_where('activities', array('id' => $id), 1, 0);

    return $query->result()[0];
  }
/*  public function create()
  {
    $this->form_validation->set_rules('title', 'Aktivite Adı', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $data = array(
        'title' => $this->input->post('title')
      );

      $this->db->insert('activities', $data);

      return TRUE;
    }
  }
  */
/*  public function update($id)
  {
    $this->form_validation->set_rules('title', 'Aktivite Adı', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $where = array(
        'id' => $id
      );

      $data = array(
        'title' => $this->input->post('title')
      );

      $this->db->update('activities', $data, $where);

      return TRUE;
    }
  }
*/
/*  public function delete($id)
  {
    $where = array(
      'id' => $id
    );

    $this->db->delete('activities', $where);

    if( $this->db->affected_rows() ){
      return TRUE;
    }else{
      return FALSE;
    }
  }

*/

}
