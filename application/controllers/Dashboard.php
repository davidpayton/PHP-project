<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        $this->load->model('dashboard_model');
    }
    
    
    public function index()
	{

        
        $data['users'] = $this->dashboard_model->get_users_num();
        $data['company'] = $this->dashboard_model->get_company_num();
		$data['orders'] = $this->dashboard_model->get_orders_num();
		$data['drivers'] = $this->dashboard_model->get_drivers_num();
        $res["data"] = $data;
        $res["view"] = 'dashboard_view';
        $this->load->view('layout', $res);        
    }

    

}
