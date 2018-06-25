<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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

    public $arr_user = array(
        'user_name' => '',
        'user_photo' => '',
        'user_password' => '',
        'user_phone_num' => '',
        'user_email' => '',
        'user_type' => 'user',

    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {

        $data['users'] = $this->user_model->get_all_users();
        $res["data"] = $data;
        $res["view"] = 'user_view';
        $this->load->view('layout', $res);
    }

    public function user_add()
    {

        $this->arr_user['user_name'] = $this->input->post('user_name');
        $this->arr_user['user_password'] = $this->input->post('user_password');
        $this->arr_user['user_phone_num'] = $this->input->post('user_phone_num');
        $this->arr_user['user_email'] = $this->input->post('user_email');

        $insert = $this->user_model->user_add($this->arr_user);
        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->user_model->get_by_id($id);
        echo json_encode($data);
    }

    public function user_update()
    {
        $this->arr_user['user_name'] = $this->input->post('user_name');
        // $this->arr_user['user_photo'] = $this->input->post('user_photo');
        $this->arr_user['user_password'] = $this->input->post('user_password');
        $this->arr_user['user_phone_num'] = $this->input->post('user_phone_num');
        $this->arr_user['user_email'] = $this->input->post('user_email');

        $this->user_model->user_update(array('user_id' => $this->input->post('user_id')), $this->arr_user);
        $this->uploadImage($this->input->post('user_id'));
        echo json_encode(array("status" => true));
    }

    public function user_delete($id)
    {
        $this->user_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

  

    public function uploadImage($id)
    {
        if (isset($_FILES["user_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('user_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_user['user_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->user_model->user_update(array('user_id' => $id), $this->arr_user);
            }
        }
    }

}
