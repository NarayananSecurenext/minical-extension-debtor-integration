<?php
class Debtor_integration extends MY_Controller
{
    public $module_name;
	function __construct()
	{

        parent::__construct();
        $this->module_name = $this->router->fetch_module();
        $this->load->model('../extensions/'.$this->module_name.'/models/Debtor_model');
        $this->load->model('../extensions/'.$this->module_name.'/models/Booking_source_model');
        $this->load->model('../extensions/'.$this->module_name.'/models/Post_model');
        $this->load->model('../extensions/'.$this->module_name.'/models/Payment_model_debtor');
        $this->load->model('../extensions/'.$this->module_name.'/models/Charge_type_model_debtor');
        //$this->load->model('../models/post_model');
        $this->load->helper('../helpers/includes/meta_helper');
       
        
		$view_data['menu_on'] = true;

		$this->load->vars($view_data);
	}	

	function index() {
		
		$this->debtor_list();
	}
	
	function debtor_list() {
		$data['company_id'] = $this->company_id;
		$config['per_page'] = (sqli_clean($this->security->xss_clean($this->input->get('per_page'))) ? sqli_clean($this->security->xss_clean($this->input->get('per_page'))) : '30');
        $config['uri_segment'] = 3; // uri_segment is used to tell pagination which page we're on. it seems that default is 3.
        $config['base_url'] = base_url() . "debtor_list";
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor';
		$data['rows'] = $this->Post_model->get_post($filters);
        $config['total_rows'] = $this->Post_model->get_found_rows();
		$this->load->library('pagination');
        $this->pagination->initialize($config);
        $config['suffix'] = '?'.http_build_query($_GET, '', "&");
		$data['menu_on'] = true;
		$data['selected_menu'] = 'customers';
        $data['selected_submenu'] = 'debtor';
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/debtor_list';
		$this->template->load('bootstrapped_template', null , $data['main_content'], $data);
	}
	
	

		function update_debtor($debtor_id='')
	{
		$data['company_id'] = $this->company_id;
		$data['post_id'] = $debtor_id;
		if($debtor_id!=''){
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/update';
		} else {
		
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/add';
		}
		$filter=array();
		$filter['company_id'] = $this->company_id;
		$filter['post_id'] = $debtor_id;
		if($debtor_id!=''){
        $data['debtor'] = $this->Post_model->get_post($filter);
  
 
		}
        if(!is_null($booking_sources = $this->Booking_source_model->get_booking_source($this->company_id, false, true)))
            {
                $data['booking_sources'] = $booking_sources;
            }
        
            $common_booking_sources = json_decode(COMMON_BOOKING_SOURCES, true);
            $common_sources_setting = $this->Booking_source_model->get_common_booking_sources_settings($this->company_id);
          //  print_r($common_sources_setting);
            $sort_orders = array();
            $common_sources = array();
            foreach($common_booking_sources as $id => $name)
            {
                if(isset($common_sources_setting[$id])){
                    $common_sources_setting[$id]['sort_order'] = is_numeric($common_sources_setting[$id]['sort_order']) ? $common_sources_setting[$id]['sort_order'] : (count($sort_orders) > 0 ? max($sort_orders) : 0);
                    if(in_array($common_sources_setting[$id]['sort_order'], $sort_orders)){
                        while(in_array($common_sources_setting[$id]['sort_order'], $sort_orders)){
                            $common_sources_setting[$id]['sort_order'] = $common_sources_setting[$id]['sort_order'] + 1;
                        }
                        $new_sort_order = $common_sources_setting[$id]['sort_order'];
                        $sort_orders[] = $new_sort_order;
                    }else{
                        $new_sort_order = $common_sources_setting[$id]['sort_order'];
                        $sort_orders[] = $new_sort_order;
                    }

                    $common_sources[$new_sort_order] = array(
                                                    'id' => $id,
                                                    'name' => $name,
                                                    'company_id' => $this->company_id,
                                                    'is_deleted' => 0,
                                                    'is_common_source' => true,
                                                    'is_hidden' => isset($common_sources_setting[$id]) ? $common_sources_setting[$id]['is_hidden'] : 0,
                                                    'sort_order' => $new_sort_order,
                                                    'commission_rate' => isset($common_sources_setting[$id]) ? $common_sources_setting[$id]['commission_rate'] : null
                                                );
                }else{
                    
                    $new_sort_order = (count($sort_orders) > 0 ? max($sort_orders) : 0) + 1;
                    $sort_orders[] = $new_sort_order;

                    $common_sources[$new_sort_order] = array(
                                                    'id' => $id,
                                                    'name' => $name,
                                                    'company_id' => $this->company_id,
                                                    'is_deleted' => 0,
                                                    'is_common_source' => true,
                                                    'is_hidden' => 0,
                                                    'sort_order' => $new_sort_order,
                                                    'commission_rate' => null
                                                );
                }
                    
            }
            
            $booking_sources = array();
            if(isset($data['booking_sources']) && count($data['booking_sources']) > 0){
                foreach($data['booking_sources'] as $key => $value){
                    $data['booking_sources'][$key]['sort_order'] = isset($data['booking_sources'][$key]['sort_order']) ? 
                            $data['booking_sources'][$key]['sort_order'] : (count($sort_orders) > 0 ? max($sort_orders) : 0);

                    if(in_array($data['booking_sources'][$key]['sort_order'], $sort_orders)){
                        while(in_array($data['booking_sources'][$key]['sort_order'], $sort_orders)){
                            $data['booking_sources'][$key]['sort_order'] = $data['booking_sources'][$key]['sort_order'] + 1;
                        }
                        $new_sort_order = $data['booking_sources'][$key]['sort_order'];
                        $sort_orders[] = $new_sort_order;
                    }else{
                        $new_sort_order = $data['booking_sources'][$key]['sort_order'];
                        $sort_orders[] = $new_sort_order;
                    }
                    $booking_sources[$new_sort_order] = $value;
                }
            }
            
            $data['booking_sources'] = $common_sources + $booking_sources;
            ksort($data['booking_sources']);
			//print_r($data['booking_sources']); die;
		$filter=array('company_id'=>$this->company_id, 'post_type'=>'marketing_segment', 'is_deleted'=>0);
        $data['marketing_segments'] = $this->Post_model->get_post($filter);
		// print_r($data['marketing_segments']); die;
        $data['rate_plans'] = $this->Debtor_model->get_rate_plans($this->company_id);
      // print_r($data['rate_plans']); die;
		//$data['menu_on'] = true;
        $data['selected_menu'] = 'customers';
        $data['selected_submenu'] = 'debtor';


		// $data['arr_attached_rate_plan'] = $this->Debtor_model->get_rate_plans($this->company_id);

        //print_r($data['debtor']);
        $this->template->load('bootstrapped_template', null , $data['main_content'], $data);
	}
	
	function save_debtor(){
		$debtor_type = $this->input->post('debtor_type');
		$debtor_code = $this->input->post('debtor_code');
		$debtor_name = $this->input->post('debtor_name');
		$debtor_description = $this->input->post('debtor_description');
		$vat_number = $this->input->post('vat_number');
		$pan_number = $this->input->post('pan_number');
		$gst_number = $this->input->post('gst_number');
		$marketing_segment = $this->input->post('marketing_segment');
		$booking_source = $this->input->post('booking_source');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$credit_limit = $this->input->post('credit_limit');
		$person_name = $this->input->post('person_name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$booker_id = $this->input->post('booker_id');
		$attach_rate_code = $this->input->post('attach_rate_code');
		$debtor_id = $this->input->post('debtor_id');

		//$authentication = $this->maximojointegration->signin_maximojo($api_key, $secret_key, $hotel_code);
		
		//$response = json_decode($authentication, true);
		$response = true;

		$is_valid_creds = false;
		if(isset($response) && $response){

			$meta['debtor_type'] = $debtor_type;
			$meta['debtor_code'] = $debtor_code;
			//$meta['debtor_name'] = $debtor_name;
			//$meta['debtor_description'] = $debtor_description;
			$meta['vat_number'] = $vat_number;
			$meta['pan_number'] = $pan_number;
			$meta['gst_number'] = $gst_number;
			$meta['marketing_segment'] = $marketing_segment;
			$meta['booking_source'] = $booking_source;
			$meta['address'] = $address;
			$meta['city'] = $city;
			$meta['state'] = $state;
			$meta['country'] = $country;
			$meta['credit_limit'] = $credit_limit;
			$meta['person_name'] = $person_name;
			$meta['email'] = $email;
			$meta['phone'] = $phone;
			$meta['booker_id'] = $booker_id;
			$meta['attach_rate_code'] = $attach_rate_code;
			
			//$meta['company_id'] = $this->company_id;
			$add_post=array();
            $add_post['company_id'] = $this->company_id;
            $add_post['post_id'] = $debtor_id;
            $add_post['post_title'] = $debtor_name;
            $add_post['post_content'] = $debtor_description;
			$add_post['post_status'] = 'publish';
			$add_post['post_type'] = 'debtor';
            $filter=array();
            $filter['company_id'] = $this->company_id;
            $filter['post_id'] = $debtor_id;
			$debtor_data = $this->Post_model->get_post($filter);
//print_r($debtor_data);
			if($debtor_data){
				
				//unset($data['email']);
				//unset($data['password']);
				$this->Post_model->edit_post($add_post);
				$this->Post_model->update_post_meta($meta, $debtor_id);
				$debtor_id = $debtor_id;
			} else {
				$debtor_id = $this->Post_model->create_post($add_post);
				$this->Post_model->update_post_meta($meta, $debtor_id);
			}
			
			$is_valid_creds = true;
		}

		if($is_valid_creds){
			$msg = l('Debtor inserted/Updated successfully.', true);
			echo json_encode(array('success' => true, 'msg' => $msg, 'debtor_id' => $debtor_id));
		} else {
			$msg = l('Some Problem on insert/update.', true);
			echo json_encode(array('success' => false, 'msg' => $msg));
		}
	}
	
	function status_debtor(){
		$is_disable = $this->input->post('is_disable')=='disable'?1:0;
		$debtor_id = $this->input->post('debtor_id');

		$response = true;

		$is_valid_creds = false;
		if(isset($response) && $response){

			$meta['is_deleted'] = $is_disable;
			$meta['company_id'] = $this->company_id;
			$meta['post_id'] = $debtor_id;
			$filter=array();
            $filter['company_id'] = $this->company_id;
            $filter['post_id'] = $debtor_id;

			$debtor_data = $this->Post_model->get_post($filter);

			if($debtor_data){
				$this->Post_model->edit_post($meta);
				$debtor_id = $debtor_id;
			} 
			
			$is_valid_creds = true;
		}

		if($is_valid_creds){
			$msg = l('Debtor status updated successfully.', true);
			echo json_encode(array('success' => true, 'msg' => $msg, 'debtor_id' => $debtor_id));
		} else {
			$msg = l('Some Problem on insert/update.', true);
			echo json_encode(array('success' => false, 'msg' => $msg));
		}
	}

	function save_customer(){
		$person_name = $this->input->post('person_name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$booker_id = $this->input->post('booker_id');
		$customer_id = $this->input->post('customer_id');
		$debtor_id = $this->input->post('debtor_id');

		
		$response = true;

		$is_valid_creds = false;
		if(isset($response) && $response){

			$meta['person_name'] = $person_name;
			$meta['email'] = $email;
			$meta['phone'] = $phone;
			$meta['booker_id'] = $booker_id;


	
			
			$add_post=array();
            $add_post['company_id'] = $this->company_id;
            $add_post['post_id'] = $customer_id;
			$add_post['post_status'] = 'publish';
			$add_post['post_type'] = 'customer';
            $filter=array();
            $filter['company_id'] = $this->company_id;
            $filter['post_id'] = $customer_id;
			$debtor_data = $this->Post_model->get_post($filter);
//print_r($debtor_data);
			if($debtor_data){
				
				//unset($data['email']);
				//unset($data['password']);
				$this->Post_model->edit_post($add_post);
				$this->Post_model->update_post_meta($meta, $customer_id);
				$customer_id = $customer_id;
			} else {
				$customer_id = $this->Post_model->create_post($add_post);
				$this->Post_model->update_post_meta($meta, $customer_id);

				$cust_meta['customer_id'] = $customer_id;



				$this->Post_model->update_post_meta($cust_meta, $debtor_id);
			}
			
			$is_valid_creds = true;
		}

		if($is_valid_creds){
			$msg = l('Debtor inserted/Updated successfully.', true);
			echo json_encode(array('success' => true, 'msg' => $msg, 'customer_id' => $customer_id));
		} else {
			$msg = l('Some Problem on insert/update.', true);
			echo json_encode(array('success' => false, 'msg' => $msg));
		}
	}

	function marketing_segment()
    {
 
         
		$debtor_url = 'application/extensions/'.$this->module_name.'/'.'assets/';



			$filters['company_id'] = $this->company_id;
			$filters['post_type'] = 'marketing_segment';
			$data['rows'] = $this->Post_model->get_post($filters);

			$data['company_id'] = $this->company_id;
			$data['menu_on'] = true;

			
         
            $data['js_files'] = array(
				base_url() . $debtor_url . auto_version('js/marketing-segment.js')

           );
            $data['selected_sidebar_link'] = 'Booking Source';

        $data['main_content'] = '../extensions/'.$this->module_name.'/views/marketing_segment';

        $this->template->load('bootstrapped_template', null , $data['main_content'], $data);
    }

	function get_new_marketing_segment_div() {

		$meta['name'] = "New Marketing Segment";
		$meta['description'] = "";
		$meta['is_enable'] = 0;

		$add_post=array();
		$add_post['company_id'] = $this->company_id;
		$add_post['post_id'] = "";
		$add_post['post_status'] = 'publish';
		$add_post['post_type'] = 'marketing_segment';
		// $filter=array();
		// $filter['company_id'] = $this->company_id;
		// $filter['post_id'] = $customer_id;

		$new_marketing_segment_id = $this->Post_model->create_post($add_post);
		$this->Post_model->update_post_meta($meta, $new_marketing_segment_id);

        // $this->_create_reservation_log("Create New Booking Source ( [ID {$new_booking_source_id}])");
        $data = array (
            'id' => $new_marketing_segment_id,
            'name' => 'New Marketing Segment',
            'sort_order' => 0
        );

		$debtor_url = base_url() .'application/extensions/'.$this->module_name.'/'.'views/new_marketing_segment';
		$data['menu_on'] = false;
		$data['main_content'] = '../extensions/'.$this->module_name.'/views/new_marketing_segment';

		// $this->template->load('bootstrapped_template', null , $data['main_content'], $data);
		// $this->load->view($debtor_url, $data);
		// $this->load->view('new_marketing_segment', $data);

		// $this->load->view('hotel_settings/booking/new_booking_source', $data);

		$data = array ('isSuccess'=> TRUE, 'new_marketing_segment_id' => $new_marketing_segment_id);
		echo json_encode($data);

    }
    
    function update_marketing_segment()
    {
        $updated_marketing_segments = $this->input->post('updated_marketing_segment');
        $response = array(
            'error' => false,
            'success' => true
        );
        
        foreach($updated_marketing_segments as $updated_marketing_segment)
        {
				$meta['name'] = $this->security->xss_clean($updated_marketing_segment['name']);
				$meta['description'] = $this->security->xss_clean($updated_marketing_segment['description']);
				$meta['is_enable'] = $this->security->xss_clean($updated_marketing_segment['is_hidden']);
				$marketing_segment_id = $this->security->xss_clean($updated_marketing_segment['id']);

				$add_post=array();
				$add_post['company_id'] = $this->company_id;
				$add_post['post_id'] = $marketing_segment_id;
				$add_post['post_status'] = 'publish';
				$add_post['post_type'] = 'marketing_segment';
				$add_post['is_deleted'] = '0';
				if($meta['is_enable'] == 1){
					$add_post['is_deleted'] = '1';

				}
				$this->Post_model->edit_post($add_post);
				$this->Post_model->update_post_meta($meta, $marketing_segment_id);

		} 
		echo json_encode($response);
	}

// revenue head start

function revenue_head(){
    $data['menu_on'] = TRUE;
    // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
    $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
    
    $filters['company_id'] = $this->company_id;
    $filters['post_type'] = 'debtor_integration_revenue_head';
    $filters['is_deleted'] = 0;


    $post_data = get_post($filters);
    if(isset($post_data) && $post_data != null){
        $data['posts'] = $post_data;
    }
    $data['main_content'] = '../extensions/'.$this->module_name.'/views/revenue_head';
    $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
}


function add_revenue_head()
{
    if(!empty($_POST['meta']) && $_POST['meta']){
        $meta = $_POST['meta'];
    }
    if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
        $add_post = array(
            'company_id' => $this->company_id, // require
            'user_id' => $this->user_id, // require
            'post_title' => $_POST['post_title'], // require
            'post_type' => $_POST['post_type'] ?? '', // require
            'post_content' => $_POST['post_content'] ?? '',
            'post_mime_type' => $_POST['post_mime_type'] ?? '',
            'post_date' => date('Y-m-d H:i:s'),
            'sort_order' => $_POST['sort_order'] ?? '',
            'is_deleted' => $_POST['is_deleted'] ?? '',
            'meta' =>  $meta ?? ''
        );

        add_post($add_post);
            
        echo json_encode(array('success'=> true));
    }else{
        echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
    }    
    
}

function update_revenue_head()
{
    if(!empty($_POST['meta']) && $_POST['meta']){
        $meta = $_POST['meta'];
    }
    if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
        $edit_post = array(
            'post_id' => $_POST['post_id'],
            'company_id' => $this->company_id, // require
            'user_id' => $this->user_id, // require
            'post_title' => $_POST['post_title'], // require
            'post_type' => $_POST['post_type'] ?? '', // require
            'post_content' => $_POST['post_content'] ?? '',
            'post_mime_type' => $_POST['post_mime_type'] ?? '',
            'post_modified' => date('Y-m-d H:i:s'),
        );

        edit_post($edit_post);

        if($meta){
            update_post_meta($meta,$_POST['post_id']);
        }

        echo json_encode(array('success'=> true));
    }else{
        echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
    }    

    
}

function get_edit_revenue_head($post_id){

    $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_revenue_head' );
    $post_data = get_post($post);

    if(isset($post_data) && $post_data != null){


        $post_data[0]['description'] = isset(get_post_meta($post_id, 'description', true)['meta_value'])?get_post_meta($post_id, 'description', true)['meta_value']:''; 
        $post_data[0]['sequence_no'] = isset(get_post_meta($post_id, 'sequence_no', true)['meta_value'])?get_post_meta($post_id, 'sequence_no', true)['meta_value']:''; 
        $post_data[0]['not_in_use'] = isset(get_post_meta($post_id, 'not_in_use', true)['meta_value'])?get_post_meta($post_id, 'not_in_use', true)['meta_value']:''; 


     echo json_encode(array('success'=> true, "post"=> $post_data));

    }  else{
    echo json_encode(array('success'=> false, "error"=> "Try again!"));

    } 
}

function delete_revenue_head($post_id)
{
    if(isset($post_id) && $post_id != null){

        $force_delete = false;
        $result = delete_post($post_id, $force_delete);
        if(isset($result)){
         echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
        }
     }else{
         echo json_encode(array('success'=> true, "error"=> 'Try again!'));
     }
}


	// revenue head end

	// revenue start

	function revenue(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor_integration_revenue';
        $filters['is_deleted'] = 0;


        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/revenue';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


	function add_revenue()
    {
		if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
				'sort_order' => $_POST['sort_order'] ?? '',
				'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

	function update_revenue()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

	function get_edit_revenue($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_revenue' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){


            $post_data[0]['revenue_code'] = isset(get_post_meta($post_id, 'revenue_code', true)['meta_value'])?get_post_meta($post_id, 'revenue_code', true)['meta_value']:''; 
            $post_data[0]['type'] = isset(get_post_meta($post_id, 'type', true)['meta_value'])?get_post_meta($post_id, 'type', true)['meta_value']:''; 
            $post_data[0]['description'] = isset(get_post_meta($post_id, 'description', true)['meta_value'])?get_post_meta($post_id, 'description', true)['meta_value']:''; 
            $post_data[0]['gl_code'] = isset(get_post_meta($post_id, 'gl_code', true)['meta_value'])?get_post_meta($post_id, 'gl_code', true)['meta_value']:''; 
   


         echo json_encode(array('success'=> true, "post"=> $post_data));

        }  else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

	function delete_revenue($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
             echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
         }else{
             echo json_encode(array('success'=> true, "error"=> 'Try again!'));
         }
    }

	// revenue end




    
	// department start

	function department(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor_integration_department';
        $filters['is_deleted'] = 0;


        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }

        // revenue master
		$filters['post_type'] = 'debtor_integration_revenue';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['revenue_list'] = $post_data;
        }


		$data['selected_sidebar_link'] = 'Revenue Head';

        $data['main_content'] = '../extensions/'.$this->module_name.'/views/department';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


	function add_department()
    {
		if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
				'sort_order' => $_POST['sort_order'] ?? '',
				'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

	function update_department()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

	function get_edit_department($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_department' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){


            $post_data[0]['department_code'] = isset(get_post_meta($post_id, 'department_code', true)['meta_value'])?get_post_meta($post_id, 'department_code', true)['meta_value']:''; 
            $post_data[0]['sequence'] = isset(get_post_meta($post_id, 'sequence', true)['meta_value'])?get_post_meta($post_id, 'sequence', true)['meta_value']:''; 
            $post_data[0]['description'] = isset(get_post_meta($post_id, 'description', true)['meta_value'])?get_post_meta($post_id, 'description', true)['meta_value']:''; 
            $post_data[0]['show_pos_outlets'] = isset(get_post_meta($post_id, 'show_pos_outlets', true)['meta_value'])?get_post_meta($post_id, 'show_pos_outlets', true)['meta_value']:'';
            $post_data[0]['multiple_currency'] = isset(get_post_meta($post_id, 'multiple_currency', true)['meta_value'])?get_post_meta($post_id, 'multiple_currency', true)['meta_value']:''; 
            $post_data[0]['not_in_use'] = isset(get_post_meta($post_id, 'not_in_use', true)['meta_value'])?get_post_meta($post_id, 'not_in_use', true)['meta_value']:''; 

         echo json_encode(array('success'=> true, "post"=> $post_data));

        }  else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

	function delete_department($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
             echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
         }else{
             echo json_encode(array('success'=> true, "error"=> 'Try again!'));
         }
    }

	// department end


    // gl_account start

	function gl_account(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor_integration_gl_account';
        $filters['is_deleted'] = 0;


        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/gl_account';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


	function add_gl_account()
    {
		if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
				'sort_order' => $_POST['sort_order'] ?? '',
				'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

	function update_gl_account()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

	function get_edit_gl_account($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_gl_account' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){

            $post_data[0]['gl_account_code'] = isset(get_post_meta($post_id, 'gl_account_code', true)['meta_value'])?get_post_meta($post_id, 'gl_account_code', true)['meta_value']:''; 
            $post_data[0]['not_in_use'] = isset(get_post_meta($post_id, 'not_in_use', true)['meta_value'])?get_post_meta($post_id, 'not_in_use', true)['meta_value']:''; 
            $post_data[0]['description'] = isset(get_post_meta($post_id, 'description', true)['meta_value'])?get_post_meta($post_id, 'description', true)['meta_value']:''; 

         echo json_encode(array('success'=> true, "post"=> $post_data));

        }  else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

	function delete_gl_account($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
             echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
         }else{
             echo json_encode(array('success'=> true, "error"=> 'Try again!'));
         }
    }

	// gl_account end


    
    // sac start

	function sac(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor_integration_sac';
        $filters['is_deleted'] = 0;


        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }
        $data['main_content'] = '../extensions/'.$this->module_name.'/views/sac';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


	function add_sac()
    {
		if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
				'sort_order' => $_POST['sort_order'] ?? '',
				'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

	function update_sac()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

	function get_edit_sac($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_sac' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){

            $post_data[0]['sac_code'] = isset(get_post_meta($post_id, 'sac_code', true)['meta_value'])?get_post_meta($post_id, 'sac_code', true)['meta_value']:''; 
            $post_data[0]['not_in_use'] = isset(get_post_meta($post_id, 'not_in_use', true)['meta_value'])?get_post_meta($post_id, 'not_in_use', true)['meta_value']:''; 
            $post_data[0]['description'] = isset(get_post_meta($post_id, 'description', true)['meta_value'])?get_post_meta($post_id, 'description', true)['meta_value']:''; 

         echo json_encode(array('success'=> true, "post"=> $post_data));

        }  else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

	function delete_sac($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
             echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
         }else{
             echo json_encode(array('success'=> true, "error"=> 'Try again!'));
         }
    }

	// sac end

    	// revenue_charge start

	function revenue_charge(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
		$filters['company_id'] = $this->company_id;
		$filters['post_type'] = 'debtor_integration_revenue_charge';
        $filters['is_deleted'] = 0;


        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }

        // department_list
		$filters['post_type'] = 'debtor_integration_department';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['department_list'] = $post_data;
        }

        // revenue_head_list
		$filters['post_type'] = 'debtor_integration_revenue_head';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['revenue_head_list'] = $post_data;
        }

        // gl_account_list
		$filters['post_type'] = 'debtor_integration_gl_account';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['gl_account_list'] = $post_data;
        }

        // sac_code_list
		$filters['post_type'] = 'debtor_integration_sac';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['sac_code_list'] = $post_data;
        }


		$data['selected_sidebar_link'] = 'Revenue Head';

        $data['main_content'] = '../extensions/'.$this->module_name.'/views/revenue_charge';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


	function add_revenue_charge()
    {
		if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
				'sort_order' => $_POST['sort_order'] ?? '',
				'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

	function update_revenue_charge()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

	function get_edit_revenue_charge($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_revenue_charge' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){


            $post_meta_data = get_post_meta($post_id);

            foreach ($post_meta_data as $post_meta_value) {

            $meta_key = $post_meta_value['meta_key'];

                $post_data[0][$meta_key] = isset(get_post_meta($post_id, $meta_key, true)['meta_value'])?get_post_meta($post_id, $meta_key, true)['meta_value']:''; 
            }

            echo json_encode(array('success'=> true, "post"=> $post_data));

        }else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

	function delete_revenue_charge($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
             echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
         }else{
             echo json_encode(array('success'=> true, "error"=> 'Try again!'));
         }
    }

	// revenue_charge end

    // payment1 start

    function payment1(){
        $data['menu_on'] = TRUE;
        // $post = array('user_id' => $this->user_id, "company_id" => $this->company_id);
        $files = get_asstes_files($this->module_assets_files, $this->module_name, $this->controller_name, $this->function_name);
        
        $filters['company_id'] = $this->company_id;
        $filters['post_type'] = 'debtor_integration_payment1';
        $filters['is_deleted'] = 0;

        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['posts'] = $post_data;
        }


        // payment list
        $payment_type_list = $this->Payment_model_debtor->get_payment_types($this->company_id);

        if(isset($payment_type_list) && $payment_type_list != null){
            $payment_type_list = json_decode(json_encode($payment_type_list), true);
            //$data['payment_type_list'] = $payment_type_list;
        }

        // charges list
        $charge_list = $this->Charge_type_model_debtor->get_charge_types($this->company_id);

        // if(isset($charge_list) && $charge_list != null){
        //     $data['charge_list'] = $charge_list;
        // }

        // debtor account list
        $filters['post_type'] = 'debtor';
        $filters['is_deleted'] = 0;
        $post_data = get_post($filters);
        if(isset($post_data) && $post_data != null){
            $data['debtor_account_list'] = $post_data;
        }


        // $post_data = get_post($filters);
        // if(isset($post_data) && $post_data != null){
        //     $data['posts'] = $post_data;
        // }

        if(isset($payment_type_list) && $payment_type_list){
            foreach ($payment_type_list as  $payment_type) {

                $payment_type_id = $payment_type['payment_type_id'];
                $payment_type = $payment_type['payment_type'];
                $payment_type_list_short[$payment_type_id] = $payment_type;

            }
            $data['payment_type_list'] = $payment_type_list_short;  
        }

        
        if(isset($charge_list) && $charge_list){
            foreach ($charge_list as  $charge) {

                $charge_id = $charge['id'];
                $charge_name = $charge['name'];
                $charge_list_short[$charge_id] = $charge_name;

            }
            $data['charge_list'] = $charge_list_short;  
        }

        $data['selected_sidebar_link'] = 'Revenue Head';

        $data['main_content'] = '../extensions/'.$this->module_name.'/views/payment1';
        $this->template->load('bootstrapped_template', null, $data['main_content'], $data); 
    }


    function add_payment1()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_title']) && $_POST['post_title'] !== '' && $_POST['post_type'] !== '' ){
            $add_post = array(
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_date' => date('Y-m-d H:i:s'),
                'sort_order' => $_POST['sort_order'] ?? '',
                'is_deleted' => $_POST['is_deleted'] ?? '',
                'meta' =>  $meta ?? ''
            );

            add_post($add_post);
                
            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Please enter require data.' ));
        }    
        
    }

    function update_payment1()
    {
        if(!empty($_POST['meta']) && $_POST['meta']){
            $meta = $_POST['meta'];
        }
        if(isset($_POST['post_id']) && $_POST['post_id'] !== ''){
            $edit_post = array(
                'post_id' => $_POST['post_id'],
                'company_id' => $this->company_id, // require
                'user_id' => $this->user_id, // require
                'post_title' => $_POST['post_title'], // require
                'post_type' => $_POST['post_type'] ?? '', // require
                'post_content' => $_POST['post_content'] ?? '',
                'post_mime_type' => $_POST['post_mime_type'] ?? '',
                'post_modified' => date('Y-m-d H:i:s'),
            );

            edit_post($edit_post);

            if($meta){
                update_post_meta($meta,$_POST['post_id']);
            }

            echo json_encode(array('success'=> true));
        }else{
            echo json_encode(array('success'=> false,'error'=> 'Try Again.' ));
        }    

        
    }

    function get_edit_payment1($post_id){

        $post = array("post_id" => $post_id,'post_type' => 'debtor_integration_payment1' );
        $post_data = get_post($post);

        if(isset($post_data) && $post_data != null){


            $post_meta_data = get_post_meta($post_id);

            foreach ($post_meta_data as $post_meta_value) {

            $meta_key = $post_meta_value['meta_key'];

                $post_data[0][$meta_key] = isset(get_post_meta($post_id, $meta_key, true)['meta_value'])?get_post_meta($post_id, $meta_key, true)['meta_value']:''; 
            }

            echo json_encode(array('success'=> true, "post"=> $post_data));

        }else{
        echo json_encode(array('success'=> false, "error"=> "Try again!"));

        } 
    }

    function delete_payment1($post_id)
    {
        if(isset($post_id) && $post_id != null){

            $force_delete = false;
            $result = delete_post($post_id, $force_delete);
            if(isset($result)){
                echo json_encode(array('success'=> true, "msg"=> 'Data is delete!'));
            }
            }else{
                echo json_encode(array('success'=> true, "error"=> 'Try again!'));
            }
    }

    // payment1 end
}