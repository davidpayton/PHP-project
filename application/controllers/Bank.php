<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
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
     * @see https://codeigniter.com/bank_guide/general/urls.html
     */

    public $arr_bank = array(
        'bank_photo' => '',
        'bank_price' => '',

    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bank_model');
    }

    public function index()
    {

        $data['banks'] = $this->bank_model->get_all_banks();
        $res["data"] = $data;
        $res["view"] = 'bank_view';
        $this->load->view('layout', $res);
    }

    public function bank_add()
    {

        $this->arr_bank['bank_price'] = $this->input->post('bank_price');
        $insert = $this->bank_model->bank_add($this->arr_bank);
        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->bank_model->get_by_id($id);
        echo json_encode($data);
    }

    public function bank_update()
    {
        $this->arr_bank['bank_price'] = $this->input->post('bank_price');
        $this->bank_model->bank_update(array('bank_id' => $this->input->post('bank_id')), $this->arr_bank);
        $this->uploadImage($this->input->post('bank_id'));
        echo json_encode(array("status" => true));
    }

    public function bank_delete($id)
    {
        $this->bank_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["bank_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('bank_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_bank['bank_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->bank_model->bank_update(array('bank_id' => $id), $this->arr_bank);
            }
        }
    }

}
