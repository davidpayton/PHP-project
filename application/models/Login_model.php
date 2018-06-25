<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the admin Model for CodeIgniter CRUD using Ajax Application.
class Login_model extends CI_Model
{
 
	var $table = 'admins';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
    public function login_admin($email,$pass){
 
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('admin_email',$email);
        $this->db->where('admin_password',$pass);
       
        if($query=$this->db->get())
        {
            return $query->row_array();
        }
        else{
            return false;
        }
       
       
    }
    public function email_check($email){
 
        $this->db->select('*');
        $this->db->from('admins');
        $this->db->where('admin_email',$email);
        $query=$this->db->get();
       
        if($query->num_rows()>0){
          return false;
        }else{
          return true;
        }
       
    }

}