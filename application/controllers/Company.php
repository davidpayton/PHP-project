<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('company_model');
    }
    
    
     public function index()
	{

        
        $data['users'] = $this->company_model->get_all_users();
        $res["data"] = $data;
        $res["view"] = 'company_view';
        $this->load->view('layout', $res);        
    }

    public function user_add()
    {
        $data = array(
                'user_name' => $this->input->post('user_name'),
                'user_photo' => "",
                'user_password' => $this->input->post('user_password'),
                'user_phone_num' => $this->input->post('user_phone_num'),
                'user_email' => $this->input->post('user_email'),
                'user_office_num' => $this->input->post('user_office_num'),
                'user_business' => $this->input->post('user_business'),
                'user_month_ship' => $this->input->post('user_month_ship'),
                'user_type'=> 'company',
                'user_credit_limit' => $this->input->post('user_credit_limit'),

            );
        $insert = $this->company_model->user_add($data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_edit($id)
    {
        $data = $this->company_model->get_by_id($id);
        echo json_encode($data);
    }

    public function user_update()
    {
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'user_password' => $this->input->post('user_password'),
            'user_phone_num' => $this->input->post('user_phone_num'),
            'user_email' => $this->input->post('user_email'),
            'user_office_num' => $this->input->post('user_office_num'),
            'user_business' => $this->input->post('user_business'),
            'user_month_ship' => $this->input->post('user_month_ship'),
            'user_credit_limit' => $this->input->post('user_credit_limit'),
            );
        $this->company_model->user_update(array('user_id' => $this->input->post('user_id')), $data);
        echo json_encode(array("status" => TRUE));
}

public function user_delete($id)
{
    $this->company_model->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
}

    

}
