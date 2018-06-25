<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivermap extends CI_Controller {

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
        $this->load->model('drivermap_model');
    }
	public function index()
	{
        $this->load->library('gmaps');

        $config['center'] = '37.4419, -122.1419';
        $config['zoom'] = 'auto';
        $this->gmaps->initialize($config);
        
        $marker = array();
        $marker['position'] = '37.429, -122.1519';
        $marker['infowindow_content'] = '1 - Hello World!';
        $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
        $this->gmaps->add_marker($marker);
        
        $marker = array();
        $marker['position'] = '37.409, -122.1319';
        $marker['draggable'] = TRUE;
        $marker['animation'] = 'DROP';
        $this->gmaps->add_marker($marker);
        
        $marker = array();
        $marker['position'] = '37.449, -122.1419';
        $marker['onclick'] = 'alert("You just clicked me!!")';
        $this->gmaps->add_marker($marker);
        $data['map'] = $this->gmaps->create_map();
        $res["data"] = $data;
        $res["view"] = 'drivermap_view';
        $this->load->view('layout', $res);
	}
}
