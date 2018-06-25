<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

    public $arr_admin = array(
        'admin_name' => '',
        'admin_photo' => '',
        'admin_email' => '',
        'admin_password' => '',
        'admin_phone_num' => '',

    );
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {

        $data['admins'] = $this->admin_model->get_all_admins();
        $res["data"] = $data;
        $res["view"] = 'admin_view';
        $this->load->view('layout', $res);
    }

    public function admin_add()
    {
        
            $this->arr_admin['admin_name'] = $this->input->post('admin_name');
            $this->arr_admin['admin_email'] = $this->input->post('admin_email');
            $this->arr_admin['admin_password'] = $this->input->post('admin_password');
            $this->arr_admin['admin_phone_num'] = $this->input->post('admin_phone_num');

        
        $insert = $this->admin_model->admin_add($this->arr_admin);

        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->admin_model->get_by_id($id);
        echo json_encode($data);
    }

    public function admin_update()
    {
        $this->arr_admin['admin_name'] = $this->input->post('admin_name');
        $this->arr_admin['admin_email'] = $this->input->post('admin_email');
        $this->arr_admin['admin_password'] = $this->input->post('admin_password');
        $this->arr_admin['admin_phone_num'] = $this->input->post('admin_phone_num');

        $this->admin_model->admin_update(array('admin_id' => $this->input->post('admin_id')), $this->arr_admin);
        $this->uploadImage($this->input->post('admin_id'));
        echo json_encode(array("status" => true));
    }

    public function admin_delete($id)
    {
        $this->admin_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["admin_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('admin_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_admin['admin_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->admin_model->admin_update(array('admin_id' => $id), $this->arr_admin);
            }
        }
    }

}
