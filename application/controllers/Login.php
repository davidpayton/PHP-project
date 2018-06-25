<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/admin_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }
    public function index()
    {
       $this->load->view('login_view');
    }

    function login_admin(){
        $admin_login=array(
       
        'admin_email'=>$this->input->post('admin_email'),
        'admin_password'=>md5($this->input->post('admin_password'))
       
          );
       
          $data=$this->login_model->login_admin($admin_login['admin_email'],$admin_login['admin_password']);
            if($data)
            {
              $this->session->set_userdata('admin_id',$data['admin_id']);
              $this->session->set_userdata('admin_email',$data['admin_email']);
              $this->session->set_userdata('admin_name',$data['admin_name']);
              $this->session->set_userdata('admin_photo',$data['admin_photo']);
              $this->session->set_userdata('admin_phone_num',$data['admin_phone_num']);
       
            //   $this->load->view('layout', $data);
            echo "true";
       
            }
            else{
              $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
              $this->load->view('login_view');
            echo "false";
       
            }
       
       
      }
}
