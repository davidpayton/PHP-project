<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Messenger extends CI_Controller
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
        'bank_name' => '',

    );

    public $arr_service = array(
        'service_photo' => '',
        'service_price' => '',
        'service_name' => '',

    );

    public $type = 'bank';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bank_model');
        $this->load->model('service_model');
        $this->load->model('messenger_model');
    }

    public function index()
    {

        $data['banks'] = $this->bank_model->get_all_banks();
        $data['services'] = $this->service_model->get_all_services();
        $data['value'] = $this->messenger_model->get_value();
        $res["data"] = $data;
        $res["view"] = 'messenger_view';
        $this->load->view('layout', $res);
    }

    public function bank_add()
    {

        $this->arr_bank['bank_price'] = $this->input->post('bank_price');
        $this->arr_bank['bank_name'] = $this->input->post('bank_name');
        $insert = $this->bank_model->bank_add($this->arr_bank);
        $type = 'bank';
        $this->bank_uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function bank_ajax_edit($id)
    {
        $data = $this->bank_model->get_by_id($id);
        echo json_encode($data);
    }

    public function bank_update()
    {
        $type = 'bank';
        $this->arr_bank['bank_price'] = $this->input->post('bank_price');
        $this->arr_bank['bank_name'] = $this->input->post('bank_name');
        $this->bank_model->bank_update(array('bank_id' => $this->input->post('bank_id')), $this->arr_bank);
        $this->bank_uploadImage($this->input->post('bank_id'));
        echo json_encode(array("status" => true));
    }

    public function bank_delete($id)
    {
        $this->bank_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function bank_uploadImage($id)
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

    public function service_add()
    {
        $type = 'service';

        $this->arr_service['service_price'] = $this->input->post('service_price');
        $this->arr_service['service_name'] = $this->input->post('service_name');
        $insert = $this->service_model->service_add($this->arr_service);
        $this->service_uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function service_ajax_edit($id)
    {
        $data = $this->service_model->get_by_id($id);
        echo json_encode($data);
    }

    public function service_update()
    {
        $type = 'service';
        $this->arr_service['service_price'] = $this->input->post('service_price');
        $this->arr_service['service_name'] = $this->input->post('service_name');
        $this->service_model->service_update(array('service_id' => $this->input->post('service_id')), $this->arr_service);
        $this->service_uploadImage($this->input->post('service_id'));
        echo json_encode(array("status" => true));
    }

    public function service_delete($id)
    {
        $this->service_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function service_uploadImage($id)
    {
        if (isset($_FILES["service_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('service_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_service['service_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->service_model->service_update(array('service_id' => $id), $this->arr_service);
            }
        }
    }

    public function update_value(){
        $value = $this->input->post('record_id');
        $update_value = array("distance_price_value" => $value);

        $this->messenger_model->update_value($update_value);
    }

}
