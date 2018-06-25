<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
     * @see https://codeigniter.com/product_guide/general/urls.html
     */

    public $arr_product = array(
        'product_name' => '',
        'product_photo' => '',
        'product_price' => '',
        'product_quantity' => '',
        'product_liter' => '',
        'product_group_name' => '',

    );
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {

        $data['products'] = $this->product_model->get_all_products();
        $res["data"] = $data;
        $res["view"] = 'product_view';
        $this->load->view('layout', $res);
    }

    public function product_add()
    {
        $this->arr_product['product_name'] = $this->input->post('product_name');
        $this->arr_product['product_price'] = $this->input->post('product_price');
        $this->arr_product['product_quantity'] = $this->input->post('product_quantity');
        $this->arr_product['product_liter'] = $this->input->post('product_liter');
        $this->arr_product['product_group_name'] = $this->input->post('product_group_name');

        $insert = $this->product_model->product_add($this->arr_product);
        $this->uploadImage($insert);
        echo json_encode(array("status" => true));
    }
    public function ajax_edit($id)
    {
        $data = $this->product_model->get_by_id($id);
        echo json_encode($data);
    }

    public function product_update()
    {
        $this->arr_product['product_name'] = $this->input->post('product_name');
        $this->arr_product['product_price'] = $this->input->post('product_price');
        $this->arr_product['product_quantity'] = $this->input->post('product_quantity');
        $this->arr_product['product_liter'] = $this->input->post('product_liter');
        $this->arr_product['product_group_name'] = $this->input->post('product_group_name');

        $this->product_model->product_update(array('product_id' => $this->input->post('product_id')), $this->arr_product);
        $this->uploadImage($this->input->post('product_id'));
        echo json_encode(array("status" => true));
    }

    public function product_delete($id)
    {
        $this->product_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["product_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_product['product_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->product_model->product_update(array('product_id' => $id), $this->arr_product);
            }
        }
    }

}
