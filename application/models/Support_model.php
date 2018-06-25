<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the bank Model for CodeIgniter CRUD using Ajax Application.
class Support_model extends CI_Model
{
 
	var $table = 'support';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
    public function get_all_datas(){
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
        
    }



 	public function support_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		
		echo $this->db->last_query();
// 		return $this->db->affected_rows();
	}
 
}