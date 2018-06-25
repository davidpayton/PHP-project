<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apis extends CI_Controller {

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
        $this->load->model('driver_model');
        $this->load->model('product_model');
        $this->load->model('company_model');
        $this->load->model('admin_model');
        $this->load->model('productgroup_model');
        $this->load->model('cart_model');
        $this->load->model('bank_model');
        $this->load->model('service_model');
        $this->load->model('messenger_model');
        $this->load->model('card_model');
        $this->load->model('favaddr_model');
        $this->load->model('order_model');
        $this->load->model('support_model');
        $this->load->library('twilio');
        $this->load->library('email');
    }

    public function login_user(){
        $email = $this->input->post('user_email');
        $password = $this->input->post('user_password');

        $data = $this->user_model->login_user($email, $password);
        if($data)
        {
            echo json_encode(array("status" => TRUE, "user_data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function signup_user(){


        $this->arr_user['user_name'] = $this->input->post('user_name');
        $this->arr_user['user_password'] = $this->input->post('user_password');
        $this->arr_user['user_photo'] = $this->input->post('user_photo');
        $this->arr_user['user_phone_num'] = $this->input->post('user_phone_num');
        $this->arr_user['user_email'] = $this->input->post('user_email');
        $insert = $this->user_model->user_add($this->arr_user);
        
        if($insert != FALSE){
            $user_data = $this->user_model->get_by_id($insert);
             echo json_encode(array("status" => TRUE, "user_data" => $user_data) );
        }
    
        else{
            echo json_encode(array("status" => FALSE));
        }

    }

    public function signup_company(){
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'user_password' => $this->input->post('user_password'),
            'user_phone_num' => $this->input->post('user_phone_num'),
            'user_email' => $this->input->post('user_email'),
            'user_office_num' => $this->input->post('user_office_num'),
            'user_business' => $this->input->post('user_business'),
            'user_month_ship' => $this->input->post('user_month_ship'),
            'user_type'=> 'company',
        );
 
    $insert = $this->company_model->user_add($data);
    $user_data = $this->company_model->get_by_id($insert);
    
    if($user_data){
        echo json_encode(array("status" => TRUE, "user_data" => $user_data) );
    }
    else{
        echo json_encode(array("status" => FALSE));
    }
    }



    public function update_user(){

       
        $this->arr_user['user_name'] = $this->input->post('user_name');
        $this->arr_user['user_password'] = $this->input->post('user_password');
        $this->arr_user['user_photo'] = $this->input->post('user_photo');
        $this->arr_user['user_phone_num'] = $this->input->post('user_phone_num');
        $this->arr_user['user_email'] = $this->input->post('user_email');
        
       
    
        if($this->user_model->user_update(array('user_id' => $this->input->post('user_id')), $this->arr_user)){
            $user_data = $this->user_model->get_by_id($this->input->post('user_id'));
            echo json_encode(array("status" => TRUE, "user_data" => $user_data) );
        }
        else{
            echo json_encode(array("status" => FALSE));
        }

    }

    public function getalcohollist(){
        $data = $this->productgroup_model->get_all_productgroups();
        echo json_encode(array("status" => TRUE, "data"=>$data));
    }

    public function getalcoholdetaillist(){
        $product_group = $this->input->post('product_group_name');
        $data = $this->product_model->get_products($product_group);
        echo json_encode(array("status" => TRUE, "data" => $data));
    }

    public function addproducttocart(){
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'product_id' => $this->input->post('product_id'),
            'cart_name' => $this->input->post('cart_name'),
            'quantity' => '1'
        );
        $insert = $this->cart_model->cart_add($data);
        if($insert){
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function displaycart(){

        $cart_name = $this->input->post('cart_name');
        $data =  $this->cart_model->displayCart($cart_name);
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }


    public function getbanklist(){
        $data = $this->bank_model->get_all_banks();

        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function getservicelist(){

        $data = $this->service_model->get_all_services();
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function getdistanceprice(){
        $data = $this->messenger_model->get_value();
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function add_order_ida(){

        $data = array(
            'order_user_id' => $this->input->post('order_user_id'),
            'order_start_time' => $this->input->post('order_start_time'),
            'order_pick_address' => $this->input->post('order_pick_address'),
            'order_delivery_address' => $this->input->post('order_delivery_address'),
            'order_type' => $this->input->post('order_type'),
            'order_amount' => $this->input->post('order_amount'),
            'order_status' => 'Start',
            'order_pick_lat' => $this->input->post('order_pick_lat'),
            'order_pick_long' => $this->input->post('order_pick_long'),
            'order_delivery_lat' => $this->input->post('order_delivery_lat'),
            'order_delivery_long' => $this->input->post('order_delivery_long'),
            'order_pick_lugar'    => $this->input->post('order_pick_lugar'),
            'order_deli_lugar'    => $this->input->post('order_deli_lugar'),
            'order_contact_name'    => $this->input->post('order_contact_name'),
            'order_contact_num'    => $this->input->post('order_contact_num'),
            
        );

        $insert = $this->order_model->order_add($data);

        if($insert){

            echo json_encode(array('status' => 'TRUE'));
        }
        else{
            echo json_encode(array('status' => 'FALSE'));
        }
    }

    public function add_order_reg(){

        $data = array(
            'order_user_id' => $this->input->post('order_user_id'),
            'order_start_time' => $this->input->post('order_start_time'),
            'order_pick_address' => $this->input->post('order_pick_address'),
            'order_delivery_address' => $this->input->post('order_delivery_address'),
            'order_mid_address' => $this->input->post('order_mid_address'),
            'order_type' => $this->input->post('order_type'),
            'order_amount' => $this->input->post('order_amount'),
            'order_status' => 'Start',
            'order_pick_lat' => $this->input->post('order_pick_lat'),
            'order_pick_long' => $this->input->post('order_pick_long'),
            'order_delivery_lat' => $this->input->post('order_delivery_lat'),
            'order_delivery_long' => $this->input->post('order_delivery_long'),
            'order_mid_lat' => $this->input->post('order_mid_lat'),
            'order_mid_long' => $this->input->post('order_mid_long'),
             'order_pick_lugar'    => $this->input->post('order_pick_lugar'),
            'order_deli_lugar'    => $this->input->post('order_deli_lugar'),
            'order_mid_lugar'    => $this->input->post('order_final_lugar'),
            'order_contact_name'    => $this->input->post('order_contact_name'),
            'order_contact_num'    => $this->input->post('order_contact_num'),
        );



        $insert = $this->order_model->order_add($data);
        if($insert){
         

            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => TRUE));
        }
    }

    public function add_order_product(){
        $data = array(
            'order_user_id' => $this->input->post('order_user_id'),
            'order_start_time' => $this->input->post('order_start_time'),
            'order_delivery_address' => $this->input->post('order_delivery_address'),
            'order_type' => $this->input->post('order_type'),
            'order_amount' => $this->input->post('order_amount'),
            'order_status' => 'Start',
            'order_delivery_lat' => $this->input->post('order_delivery_lat'),
            'order_delivery_long' => $this->input->post('order_delivery_long'),
            'cart_name' => $this->input->post('cart_name')
        );
        $insert = $this->order_model->order_add($data);

        if($insert){

            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }

    public function add_order_service(){

        $data = array(
            'order_user_id' => $this->input->post('order_user_id'),
            'order_start_time' => $this->input->post('order_start_time'),
            'order_pick_address' => $this->input->post('order_pick_address'),
            'order_type' => $this->input->post('order_type'),
            'order_amount' => $this->input->post('order_amount'),
            'order_status' => 'Start',
            'order_pick_lat' => $this->input->post('order_pick_lat'),
            'order_pick_long' => $this->input->post('order_pick_long'),
        );

        $insert = $this->order_model->order_add($data);
        if($insert){
            
            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }
    
    public function getliveorders(){
        $user_id = $this->input->post('user_id');
        $data = $this->order_model->getorders($user_id);
        if($data){
            echo json_encode(array('status' => TRUE, 'data' => $data));
        }
        else{
            echo json_encode(array('status'=> FALSE));
        }
    }


    public function add_credit_card(){

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'card_num' => $this->input->post('card_num'),
            'name' => $this->input->post('name'),
            'date' => $this->input->post('date'),
            'cvc' => $this->input->post('cvc'),
        );

        $insert = $this->card_model->card_add($data);
        if($insert){

            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }

    public function add_fav_addr(){
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'favorite_addr' => $this->input->post('favorite_addr'),
            'longtitude' => $this->input->post('longtitude'),
            'latitude' => $this->input->post('latitude'),
            'name' => $this->input->post('name'),
        );

        $insert = $this->favaddr_model->addr_add($data);
        if($insert){

            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }

    public function getFavAddrs(){

        $user_id = $this->input->post('user_id');
        $data = $this->favaddr_model->get_addrs($user_id);
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }

    }

    public function getCreditCards(){

        $user_id = $this->input->post('user_id');
        $data = $this->card_model->get_cards($user_id);
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
        
        
    }



    public function getCardNames(){
        $user_id = $this->input->post('user_id');
        $data = $this->card_model->get_card_names($user_id);
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }

    }

    public function getCardInfo(){
        $user_id = $this->input->post('user_id');
        $card_name = $this->input->post('card_name');

        $data = $this->card_model->get_card_info($user_id, $card_name);
        if($data){
            echo json_encode(array("status" => TRUE, "data" => $data));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }


    public function deleteFavAddr(){

    }

    public function deleteCreditCard(){

    }

    public function deletecart(){

        $cart_id = $this->input->post('cart_id');
        $this->cart_model->delete_by_id($cart_id);
        
        echo json_encode(array("status" => TRUE));
        
    }

    public function get_support(){
        
        $data = $this->support_model->get_all_datas();
        if($data){
            echo json_encode(array('status' => 'TRUE', 'data' => $data));
        }
        else{
             echo json_encode(array('status' => 'FALSE'));
        }
        
    }

    public function uploadImage()
    {
        if (isset($_FILES["photo"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                echo json_encode(array("status" => TRUE, "user_photo" => base_url() . 'upload/' . $data["file_name"]));
                
            }
        }
    }

    public function charge(){
        // See your keys here https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_unOJJN0YuPbYPUxKbt5wpiT6");
        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $description = $_POST['description'];
        //THIS IS THE SIMPLE LOGIC FOR CHARGING ONCE
        try {
            $charge = \Stripe\Charge::create(array(
            "amount" => $amount*100, // Convert amount in cents to dollar
            "currency" => $currency,
            "source" => $token,
            "description" => $description)
        );
        // Check that it was paid:
        if ($charge->paid == true) {
        $response = array( 'status'=> 'Success', 'message'=>'Payment has been charged!!' );
        } else { // Charge was not paid!
        $response = array( 'status'=> 'Failure', 'message'=>'Your payment could NOT be processed because the payment system rejected the transaction. You can try again or use another card.' );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        } catch(\Stripe\Error\Card $e) {
        // The card has been declined
        header('Content-Type: application/json');
        echo json_encode($response);
        }
    }

    public function forgotpassword(){
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ryancasteel511@gmail.com',
            'smtp_pass' => 'Responsible123',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");


         $from_email = "ryancasteel511@gmail.com";
         
         $to_email = $this->input->post('email');

         $password = rand(1000, 10000);

         if($this->user_model->forgotpassword($to_email, $password))
         {
            $this->email->from($from_email, 'Dito App');
            $this->email->to($to_email);
            $this->email->subject('Forgot Password?');

            $msg = 'New Password:'.$password;
            $this->email->message($msg);

            if($this->email->send())
                {
                    echo json_encode(array('status' => TRUE, 'data' => 'success'));
                }
            else{

                echo json_encode(array('status' => TRUE, 'data' => "email_sent"."You have encountered an error"));
            
            }
         }
         else{
                echo json_encode(array('status'=> TRUE));
         }

   
    }

    public function verifyPhone(){
		$from = '+17209618983' ;
        $number = $this->input->post('phone');
        $to = $number;
        $sms_msg = rand(1000, 10000);
         $sms_message = 'Dito App Verification Code:'. $sms_msg;
        $response = $this->twilio->sms($from, $to, $sms_message);
        if($response){
            $temp = (string)$sms_msg;
            echo json_encode(array("status" => TRUE, 'data' => $temp));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
        
        
    }

  

    public function increaseProductQuantity(){

        $cart_id = $this->input->post('cart_id');
        $quantity = $this->input->post('cart_quantity');
        $cart_quantity = array('quantity' => $quantity);
        $this->cart_model->increaseProductQuantity($cart_id, $cart_quantity);

        echo json_encode(array("status" => TRUE));
    }


    public function getcartkey(){
        $user_id = $this->input->post('user_id');

        $cartkey = $this->order_model->get_cartkey($user_id);

        if($cartkey == true){
            echo json_encode(array("status" => TRUE, "data"=> "true"));
        }
        else{
            echo json_encode(array("status" => TRUE, "data"=> "$cartkey"));
        }
        
    }

    function sendMessage() {
        $content      = array(
            "en" => 'English Message'
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        array_push($hashes_array, array(
            "id" => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        $fields = array(
            'app_id' => "11b61d78-d544-403c-bbe9-3eedcdca28a0",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic YjcyNGRlMmItMzFlNC00NDVlLWIzZDQtNTQxOWEwYTM2MzJj'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }


    
}
