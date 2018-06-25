<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the bank Model for CodeIgniter CRUD using Ajax Application.
class Messenger_model extends CI_Model
{
 
	var $table = 'distance_prices';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 

    public function get_value(){
		$this->db->from($this->table)
				->where('distance_price_id',1);
        $query=$this->db->get();
        return $query->row();
    }

 	public function update_value($data)
	{
        $this->db->where('distance_price_id', 1)
				->update($this->table, $data);
		// echo $this->db->last_query();
		return $this->db->affected_rows();
	}
 
}