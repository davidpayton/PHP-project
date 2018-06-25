<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the service Model for CodeIgniter CRUD using Ajax Application.
class Service_model extends CI_Model
{
 
	var $table = 'services';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
	public function get_all_services()
	{
	$this->db->from('services');
	$query=$this->db->get();
	return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('service_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function service_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function service_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('service_id', $id);
		$this->db->delete($this->table);
	}

 
}