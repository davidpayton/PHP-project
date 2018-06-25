<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the productgroup Model for CodeIgniter CRUD using Ajax Application.
class Productgroup_model extends CI_Model
{
 
	var $table = 'product_group';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
	public function get_all_productgroups()
	{
	$this->db->from('product_group');
	$query=$this->db->get();
	return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('product_group_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function productgroup_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function productgroup_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('product_group_id', $id);
		$this->db->delete($this->table);
	}
}