<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class Drivermap_model extends CI_Model
{
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

 
}