<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class Card_model extends CI_Model
{
 
	var $table = 'user_credit_cards';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
    public function get_all_cards()
    {
        $this->db->from($this->table);
        $query=$this->db->get();
        return $query->result();
	}
	
	public function get_cards($user_id)
	{
		$this->db->from($this->table)
				->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function card_add(array $data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_card_names($user_id){

		$this->db->select('name')
				->from($this->table)
				->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_card_info($user_id, $card_name){

		$this->db->from($this->table);
		$this->db->where('user_id', $user_id);
		$this->db->where('name', $card_name);
		$query = $this->db->get();
		return $query->result();
	}
 
	public function card_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
 
 
}