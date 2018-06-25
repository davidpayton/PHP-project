<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
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

    public $arr_Driver = array(
        'driver_name' => '',
        'driver_photo' => '',
        'driver_email' => '',
        'driver_password' => '',
        'driver_phone_num' => '',

    );
    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
    }

    public function index()
    {

        $data['drivers'] = $this->driver_model->get_all_drivers();
        $res["data"] = $data;
        $res["view"] = 'driver_view';
        $this->load->view('layout', $res);
    }

    public function driver_add()
    {
        $this->arr_Driver['driver_name'] = $this->input->post('driver_name');
        $this->arr_Driver['driver_email'] = $this->input->post('driver_email');
        $this->arr_Driver['driver_password'] = $this->input->post('driver_password');
        $this->arr_Driver['driver_phone_num'] = $this->input->post('driver_phone_num');

        //   $this->arr_Driver = array(
        //             'driver_name' => $this->input->post('driver_name'),
        //             'driver_photo' => $this->input->post('driver_photo'),
        //             'driver_email' => $this->input->post('driver_email'),
        //             'driver_password' => $this->input->post('driver_password'),
        //             'driver_phone_num' => $this->input->post('driver_phone_num'),

        //         );
        $insert = $this->driver_model->driver_add($this->arr_Driver);
        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->driver_model->get_by_id($id);
        echo json_encode($data);
    }

    public function driver_update()
    {

        $this->arr_Driver['driver_name'] = $this->input->post('driver_name');
        $this->arr_Driver['driver_photo'] = $this->input->post('driver_photo');
        $this->arr_Driver['driver_email'] = $this->input->post('driver_email');
        $this->arr_Driver['driver_password'] = $this->input->post('driver_password');
        $this->arr_Driver['driver_phone_num'] = $this->input->post('driver_phone_num');

        // $data = array(
        //     'driver_name' => $this->input->post('driver_name'),
        //     'driver_photo' => $this->input->post('driver_photo'),
        //     'driver_email' => $this->input->post('driver_email'),
        //     'driver_password' => $this->input->post('driver_password'),
        //     'driver_phone_num' => $this->input->post('driver_phone_num'),
        //     );
        $this->driver_model->driver_update(array('driver_id' => $this->input->post('driver_id')), $this->arr_Driver);
        $this->uploadImage($this->input->post('driver_id'));
        echo json_encode(array("status" => true));
    }

    public function driver_delete($id)
    {
        $this->driver_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["driver_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('driver_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_Driver['driver_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->driver_model->driver_update(array('driver_id' => $id), $this->arr_Driver);
            }
        }
    }

}
