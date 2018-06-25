<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
     * @see https://codeigniter.com/order_guide/general/urls.html
     */

    public $arr_order = array(
        'order_user_id' => '',
        'order_start_time' => '',
        'order_end_time' => '',
        'order_pick_address' => '',
        'order_mid_address' => '',
        'order_delivery_address' => '',
        'order_type' => '',
        'order_amount' => '',
        'order_status' =>'',
        'order_driver_id' => '',
        'order_pick_lat' => '',
        'order_pick_long' => '',
        'order_mid_lat' => '',
        'order_mid_long' => '',
        'order_delivery_lat' => '',
        'order_delivery_long' => '',
        'cart_name' => '',
        'order_pick_lugar' => '',
        'order_deli_lugar' => '',
        'order_mid_lugar' => '',
        'order_contact_name' => '',
        'order_contact_num' => '',
        
        
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }

    public function index()
    {

        $data['orders'] = $this->order_model->get_all_orders();
        $res["data"] = $data;
        $res["view"] = 'order_view';
        $this->load->view('layout', $res);
    }

    public function order_add()
    {

        $this->arr_order['order_user_id'] = $this->input->post('order_user_id');
        $this->arr_order['order_start_time'] = $this->input->post('order_start_time');
        $this->arr_order['order_end_time'] = $this->input->post('order_end_time');
        $this->arr_order['order_pick_address'] = $this->input->post('order_pick_address');
        $this->arr_order['order_mid_address'] = $this->input->post('order_mid_address');
        $this->arr_order['order_delivery_address'] = $this->input->post('order_delivery_address');
        $this->arr_order['order_type'] = $this->input->post('order_type');
        $this->arr_order['order_amount'] = $this->input->post('order_amount');
        $this->arr_order['order_status'] = $this->input->post('order_status');
        $this->arr_order['order_driver_id'] = $this->input->post('order_driver_id');
        $this->arr_order['order_pick_lat'] = $this->input->post('order_pick_lat');
        $this->arr_order['order_pick_long'] = $this->input->post('order_pick_long');
        $this->arr_order['order_mid_lat'] = $this->input->post('order_mid_lat');
        $this->arr_order['order_mid_long'] = $this->input->post('order_mid_long');
        $this->arr_order['order_delivery_lat'] = $this->input->post('order_delivery_lat');
        $this->arr_order['order_delivery_long'] = $this->input->post('order_delivery_long');
        $this->arr_order['cart_name'] = $this->input->post('cart_name');
        $this->arr_order['order_pick_lugar'] = $this->input->post('order_pick_lugar');
        $this->arr_order['order_deli_lugar'] = $this->input->post('order_deli_lugar');
        $this->arr_order['order_mid_lugar'] = $this->input->post('order_midl_lugar');
        $this->arr_order['order_contact_name'] = $this->input->post('order_contact_name');
        $this->arr_order['order_contact_num'] = $this->input->post('order_contact_num');


        $insert = $this->order_model->order_add($this->arr_order);
        echo json_encode(array("status" => true));
    }


    public function ajax_edit($id)
    {
        $data = $this->order_model->get_by_id($id);
        echo json_encode($data);
    }

    public function order_update()
    {
        $this->arr_order['order_user_id'] = $this->input->post('order_user_id');
        $this->arr_order['order_start_time'] = $this->input->post('order_start_time');
        $this->arr_order['order_end_time'] = $this->input->post('order_end_time');
        $this->arr_order['order_pick_address'] = $this->input->post('order_pick_address');
        $this->arr_order['order_mid_address'] = $this->input->post('order_mid_address');
        $this->arr_order['order_delivery_address'] = $this->input->post('order_delivery_address');
        $this->arr_order['order_type'] = $this->input->post('order_type');
        $this->arr_order['order_amount'] = $this->input->post('order_amount');
        $this->arr_order['order_status'] = $this->input->post('order_status');
        $this->arr_order['order_driver_id'] = $this->input->post('order_driver_id');
        $this->arr_order['order_pick_lat'] = $this->input->post('order_pick_lat');
        $this->arr_order['order_pick_long'] = $this->input->post('order_pick_long');
        $this->arr_order['order_mid_lat'] = $this->input->post('order_mid_lat');
        $this->arr_order['order_mid_long'] = $this->input->post('order_mid_long');
        $this->arr_order['order_delivery_lat'] = $this->input->post('order_delivery_lat');
        $this->arr_order['order_delivery_long'] = $this->input->post('order_delivery_long');
        $this->arr_order['cart_name'] = $this->input->post('cart_name');
              $this->arr_order['order_pick_lugar'] = $this->input->post('order_pick_lugar');
        $this->arr_order['order_deli_lugar'] = $this->input->post('order_deli_lugar');
        $this->arr_order['order_mid_lugar'] = $this->input->post('order_mid_lugar');
        $this->arr_order['order_contact_name'] = $this->input->post('order_contact_name');
        $this->arr_order['order_contact_num'] = $this->input->post('order_contact_num');

        $this->order_model->order_update(array('order_id' => $this->input->post('order_id')), $this->arr_order);
        echo json_encode(array("status" => true));
    }

    public function order_delete($id)
    {
        $this->order_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function uploadImage($id)
    {
        if (isset($_FILES["order_photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('order_photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $this->arr_order['order_photo'] = base_url() . 'upload/' . $data["file_name"];
                $this->order_model->order_update(array('order_id' => $id), $this->arr_order);
            }
        }
    }

}
