<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Support extends CI_Controller
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
     * @see https://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model('support_model');
    }

    public function index()
    {

        $data['value'] = $this->support_model->get_all_datas();
        $res["data"] = $data;
        $res["view"] = 'support_view';
        $this->load->view('layout', $res);
    }


    public function support_update()
    {


        $data = array(
            'url' => $this->input->post('url'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),

            );
        
            
        // die(print_r($data));
        $this->support_model->support_update(array('id' => '1'), $data);

        // echo json_encode(array("status" => true));
    }


}
