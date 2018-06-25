<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the cart Model for CodeIgniter CRUD using Ajax Application.
class Cart_model extends CI_Model
{
 
    var $table = 'carts';
    var $product_table = 'products';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
	public function get_all_carts()
	{
	$this->db->from('carts');
	$query=$this->db->get();
	return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('cart_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function cart_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function cart_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('cart_id', $id);
		$this->db->delete($this->table);
    }
    
    public function displayCart($cart_name){
		$this->db->from('carts as a')
					->join('products as b', "a.product_id = b.product_id")
					->where('cart_name', $cart_name);
		$query = $this->db->get();
		return $query->result();

	}
	
	public function increaseProductQuantity($id, $quantity){
		$this->db->where('cart_id', $id)
				->update($this->table, $quantity);
		
		return $this->db->affected_rows();

	}


 
}