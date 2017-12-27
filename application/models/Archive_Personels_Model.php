<?php
//defined('BASEPATH') OR exit('No direct script access allowed');//direk erişimiengeller

class Archive_Personels_Model extends CI_Model {

    function __construct()
    {
       $this->load->database();
       $this->load->library('form_validation');
    }
    public function create($data){

      $this->db->insert('archive_personel', $data);

      return TRUE;
    }
    public function find($data){
      echo "sd";

    }  
    public function all(){
      
      $this->db->select('*');
      $this->db->from('archive_personel');
      
      $query                       = $this->db->get();
      return $query->result();

    }




}
