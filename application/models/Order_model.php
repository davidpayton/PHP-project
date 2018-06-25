<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class Order_model extends CI_Model
{
 
	var $table = 'orders';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
    public function get_all_orders()
    {
        $this->db->from('orders');
        $query=$this->db->get();
        return $query->result();
	}
	
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('order_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function order_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function order_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('order_id', $id);
		$this->db->delete($this->table);
	}

	function get_cartkey($user_id){

		$this->db->from($this->table)
				->where('order_user_id', $user_id);
				
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->num_rows();
		}
		
		return true;
	}
	
	function getorders($user_id){
	    $this->db->from($this->table)
	            ->where('order_user_id', $user_id)
	            ->where('order_status', 'Start');
	   $query = $this->db->get();
	   
	   if($query->num_rows() > 0){
	       return $query->result();
	   }
	}
 
 
}