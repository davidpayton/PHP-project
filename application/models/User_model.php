<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the user Model for CodeIgniter CRUD using Ajax Application.
class User_model extends CI_Model
{
 
	var $table = 'users';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
	public function get_all_users()
	{
	$this->db->from('users')
			->where('user_type', "user");
	$query=$this->db->get();
	return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('user_id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function user_add(array $data)
	{
	    
	    $email = $data['user_email'];
	    $query = $this->db->from($this->table)
	            ->where('user_email', $email)
	            ->get();
	    if($query->num_rows() > 0){
            return FALSE;	        
	    }
	    else{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	        
	    }
	}
 
	public function user_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete($this->table);
	}
	public function login_user($email,$pass){
 
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_email',$email);
        $this->db->where('user_password',$pass);
       
        if($query=$this->db->get())
        {
            return $query->row_array();
        }
        else{
            return false;
        }
       
	}


	
	public function forgotpassword($email, $password){
		 
		$this->db->select('user_password')
				->where('user_email', $email)
				->update($this->table, array('user_password' => $password));
				return $this->db->affected_rows();

	}

	// public function sendpassword($data){
	// 	$email = $data['user_email'];
	// 	$query1=$this->db->query("SELECT *  from users where user_email = '".$email."' ");
	// 	$row=$query1->result_array();
	// 	if ($query1->num_rows()>0)
      
	// 	{
	// 			$passwordplain = "";
	// 			$passwordplain  = rand(999999999,9999999999);
	// 			 $newpass['user_password'] = $passwordplain
	// 			$this->db->where('user_email', $email);
	// 			$this->db->update($this->table, $newpass); 
	// 			$mail_message='Dear '.$row[0]['user_name'].','. "\r\n";
	// 			$mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
	// 			$mail_message.='<br>Please Update your password.';
	// 			$mail_message.='<br>Thanks & Regards';
	// 			$mail_message.='<br>Your company name';        
	// 			date_default_timezone_set('Etc/UTC');
	// 			use PHPMailer\PHPMailer\PHPMailer;
	// 			use PHPMailer\PHPMailer\Exception;

	// 			//Load Composer's autoloader
	// 			require 'vendor/autoload.php';
	// 			$mail = new PHPMailer;
	// 			$mail->isSMTP();
	// 			$mail->SMTPSecure = "tls"; 
	// 			$mail->Debugoutput = 'html';
	// 			$mail->Host = "yooursmtp";
	// 			$mail->Port = 587;
	// 			$mail->SMTPAuth = true;   
	// 			$mail->Username = "your@email.com";    
	// 			$mail->Password = "password";
	// 			$mail->setFrom('admin@site', 'admin');
	// 			$mail->IsHTML(true);
	// 			$mail->addAddress("markodreher0511@hotmail.com");
	// 			$mail->Subject = 'OTP from company';
	// 			$mail->Body    = $mail_message;
	// 			$mail->AltBody = $mail_message;
	// 	if (!$mail->send()) {
	// 		 $this->session->set_flashdata('msg','Failed to send password, please try again!');
	// 	} else {
	// 	   $this->session->set_flashdata('msg','Password sent to your email!');
	// 	}
	// 	  redirect(base_url().'user/Login','refresh');        
	// 	}
	// 	else
	// 	{  
	// 	 $this->session->set_flashdata('msg','Email not found try again!');
	// 	 redirect(base_url().'user/Login','refresh');
	// 	}

	// }
 
}