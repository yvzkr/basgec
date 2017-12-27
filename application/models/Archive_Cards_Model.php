<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Archive_Cards_Model extends CI_Model {

    function __construct()
    {
       $this->load->database();
       $this->load->library('form_validation');
    }
    public function create($data){

      $this->db->insert('archive_card', $data);
      return TRUE;
    }
    public function all(){
    $this->db->select('archive_card.*, archive_personel.name, archive_personel.surname');
    $this->db->from('archive_card');
    $this->db->join('archive_personel', 'archive_card.personels_id = archive_personel.id','left');
    $query = $this->db->get();
    return $query->result();
    }

}
