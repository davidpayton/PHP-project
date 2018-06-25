<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productgroup extends CI_Controller
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
     * @see https://codeigniter.com/productgroup_guide/general/urls.html
     */

    public $arr_productgroup = array(
        'product_group_name' => '',
        'product_group_image' => '',

    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('productgroup_model');
    }

    public function index()
    {

        $data['productgroups'] = $this->productgroup_model->get_all_productgroups();
        $res["data"] = $data;
        $res["view"] = 'productgroup_view';
        $this->load->view('layout', $res);
    }

    public function productgroup_add()
    {

        $this->arr_productgroup['product_group_name'] = $this->input->post('productgroup_name');


        $insert = $this->productgroup_model->productgroup_add($this->arr_productgroup);
        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->productgroup_model->get_by_id($id);
        echo json_encode($data);
    }

    public function productgroup_update()
    {
        $this->arr_productgroup['productgroup_name'] = $this->input->post('productgroup_name');


        $this->productgroup_model->productgroup_update(array('product_group_id' => $this->input->post('productgroup_id')), $this->arr_productgroup);
        $this->uploadImage($this->input->post('productgroup_id'));
        echo json_encode(array("status" => true));
    }

    public function productgroup_delete($id)
    {
        $this->productgroup_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["productgroup_image"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('productgroup_image')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_productgroup['product_group_image'] = base_url() . 'upload/' . $data["file_name"];
                $this->productgroup_model->productgroup_update(array('product_group_id' => $id), $this->arr_productgroup);
            }
        }
    }

}
