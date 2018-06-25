<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class Product_model extends CI_Model
{
 
	var $table = 'products';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
    public function get_all_products()
    {
        $this->db->from('products');
        $query=$this->db->get();
        return $query->result();
	}
	
	public function get_products($product_group_name)
	{
		$this->db->from('products')
				->where('product_group_name', $product_group_name);
		$query = $this->db->get();
		return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('product_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function product_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function product_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('product_id', $id);
		$this->db->delete($this->table);
	}
 
 
}