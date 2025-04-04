<?php

class Student_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_student()
  {
    $this->db->select("*");
    $this->db->from("students");
    $query = $this->db->get();

    return $query->result();
  }

  public function insert_student($data=array())
  {
    return $this->db->insert("students",$data);
  }
  
}

 ?>
