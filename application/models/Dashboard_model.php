<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class Dashboard_model extends CI_Model
{
 
	var $table_user = 'users';
    var $table_order = 'orders';
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
    public function get_users_num()
    {
        $query = $this->db->query("SELECT COUNT(user_id) as cntuser FROM users WHERE user_type='user'");

        return $query->row("cntuser");
    }

    public function get_company_num()
    {
        $query = $this->db->query("SELECT COUNT(user_id) as cntuser FROM users WHERE user_type='company'");

        return $query->row("cntuser");
    }
    public function get_orders_num()
    {
        $query = $this->db->query("SELECT COUNT(order_id) as cntuser FROM orders");

        return $query->row("cntuser");
    }

    public function get_drivers_num()
    {
        $query = $this->db->query("SELECT COUNT(driver_id) as cntuser FROM drivers");

        return $query->row("cntuser");
    }
    
}