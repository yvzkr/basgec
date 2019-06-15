<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Card_Model extends CI_Model {
  function __construct(){
     $this->load->database();
     $this->load->library('form_validation');
  }

  public function all(){
    $this->db->select('cards.*, personels.name, personels.surname');
    $this->db->from('cards');
    $this->db->join('personels', 'cards.personels_id = personels.id','left');
    $query = $this->db->get();
    return $query->result();
  }

  public function find($data){
    $query                  = $this->db->get_where('cards', $data);
    if($query->num_rows()  != 0){
      return $query->result();
    }else{
      return NULL;
    }

  }

  public function create(){
    $this->form_validation->set_rules('card_uid', 'Kart Adi', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $data = array(
        'card_uid'                    => $this->input->post('card_uid')
      );

      $query                  = $this->db->get_where('cards', $data);

      if($query->num_rows()  != 0){
        $data=array(//eger kart var ise
          'status'=>2
        );
        return $data;
      }else{
        $data = array(
          'card_uid'                    => $this->input->post('card_uid')
        );
        $this->db->insert('cards', $data);
        $data=array(//kart eklendiginde
          'status'=>1
        );

        return $data;
      }
    /*
      $data = array(
        'card_uid'                    => $this->input->post('card_uid')
      );

      $this->db->insert('cards', $data);

      return TRUE;*/
    }
  }

  public function update($id){
    $this->form_validation->set_rules('personel_id', 'Personel Adı', 'required');
    $this->form_validation->set_rules('card_uid', 'Kart', 'required');

    if( $this->form_validation->run() === FALSE ){
      return FALSE;
    }else{
      $where                          = array(
        'id'                          => $id
      );

      $data = array(
        'card_uid'                    => $this->input->post('card_uid'),
        'personels_id'                => $this->input->post('personel_id')
      );

      $this->db->update('cards', $data, $where);
      return TRUE;
    }
  }

  public function delete($where){

    $this->db->delete('cards', $where);

    if( $this->db->affected_rows() ){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function get_empty_Card($id)
  {//Non-carded Personnel
    $where = array(
      'personels_id'                  => 'NULL'
    );

    $this->db->where('personels', $where);
    if( $this->db->affected_rows() ){
      return TRUE;
    }else{
      return FALSE;
    }
  }

}
