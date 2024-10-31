<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://renoon.com/partners/woocommerce-plugin
 * @since      1.0.0
 *
 * @package    renoon_tracking
 * @subpackage renoon_tracking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    renoon_tracking
 * @subpackage renoon_tracking/public
 * @author     WpConcierges <support@wpconcierges.com>
 */
class renoon_tracking_pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $renoon_tracking    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
   
	/**
	 * The postback url
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current postback url.
	 */
	private $postback_url;


	
	/**
	 * The postback params
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current postback params.
	 */
	private $postback_params;

  /**
	 * The postback fireonclick
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The fire only when click id is set.
	 */
	private $order_values;
	private $can_fire;
	private $incoming_click_id;
	protected $options;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $renoon_tracking       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
    
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->set_options();
		$this->postback_url = "https://roundly.scaletrk.com/track/goal-by-click-id";
		$this->incoming_click_id="renid";
	
	}
 
  private function get_incoming_click_id(){
  	return $this->incoming_click_id;
  } 
  
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in renoon_tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The renoon_tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->renoon_tracking, plugin_dir_url( __FILE__ ) . 'css/renoon_tracking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in renoon_tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The renoon_tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->renoon_tracking, plugin_dir_url( __FILE__ ) . 'js/renoon_tracking-public.js', array( 'jquery' ), $this->version, false );

	}

	public function send_woo_thankyou_order($order_id){
		
		$order = wc_get_order( $order_id );
		$this->order_values = $this->get_order_values($order,$order_id);
		$this->do_postback_woo();
	}  

	public function get_order_values($order,$order_id){
	    $values =array();
        
	  $order_items = array();
	  $order_type =$order->get_type();
		$order_meta = get_post_meta($order_id);
	  $values['billing_email']=$order_meta['_billing_email'][0];
    $values['billing_phone']=$order_meta['_billing_phone'][0];
    $values['billing_first_name']=$order_meta['_billing_first_name'][0];
    $values['billing_last_name']=$order_meta['_billing_last_name'][0];
    $values['billing_company']=$order_meta['_billing_company'][0];
    $values['billing_address_1']=$order_meta['_billing_address_1'][0];
    $values['billing_address_2']=$order_meta['_billing_address_2'][0];
    $values['billing_city']=$order_meta['_billing_city'][0];
    $values['billing_state']=$order_meta['_billing_state'][0];
    $values['billing_postcode']=$order_meta['_billing_postcode'][0];
    $values['billing_country']=$order_meta['_billing_country'][0];
    
    $values['shipping_first_name']=$order_meta['_shipping_first_name'][0];
    $values['shipping_last_name']=$order_meta['_shipping_last_name'][0];
    $values['shipping_company']=$order_meta['_shipping_company'][0];
    $values['shipping_address_1']=$order_meta['_shipping_address_1'][0];
    $values['shipping_address_2']=$order_meta['_shipping_address_2'][0];
    $values['shipping_city']=$order_meta['_shipping_city'][0];
    $values['shipping_state']=$order_meta['_shipping_state'][0];
    $values['shipping_postcode']=$order_meta['_shipping_postcode'][0];
    $values['shipping_country']=$order_meta['_shipping_country'][0];
    
    $values['order_tax']= $order_meta['_order_tax'][0];
    $values['order_total']= $order_meta['_order_total'][0];
    
    $values['cart_discount']= $order_meta['_cart_discount'][0];
    $values['cart_discount_tax']= $order_meta['_cart_discount_tax'][0];
    
    $values['order_shipping']= $order_meta['_order_shipping'][0];
    $values['order_shipping_tax']= $order_meta['_order_shipping_tax'][0];
    
    $values['order_currency']= $order_meta['_order_currency'][0];
    $values['payment_method']= $order_meta['_payment_method'][0];
    
    $values['customer_ip_address'] = $order_meta['_customer_ip_address'][0];
    
    if(isset($order_meta['_transaction_id'][0]))
    $values['transaction_id'] = $order_meta['_transaction_id'][0];
    else
    $values['transaction_id'] = "";
    
    if(isset($order_meta['_paid_date'][0]))
    $values['paid_date'] = $order_meta['_paid_date'][0];
    else
    $values['paid_date'] = "";
    
    if(isset($order_meta['_customer_user'][0]))
    	$values['customer_user'] = $order_meta['_customer_user'][0];
    else
    	$values['customer_user'] = 0;
    
   	if(isset($order_meta['_order_number'][0])) 
    	$values['order_number']=$order_meta['_order_number'][0];
   	else
    	$values['order_number']=$order_id;
    	
    	  $is_subscription = false;
        if(function_exists("wcs_order_contains_subscription") && wcs_order_contains_subscription($order,$order_type)){
        	$subscription = new WC_Subscription($order_id);
        	$items= $subscription->order->get_items();
        	$is_subscription = true;
        	
        }else{
        	$items = $order->get_items();
        }
      
        
        $total_items=0;
		    $total_discount_amount=0;
		 
		 
        foreach($items as  $item_id => $item){
        
					$variation_id=$item->get_variation_id();
		 			if($variation_id>0){
		 			  $product = new WC_Product_Variation($variation_id);
		 			}elseif($is_subscription){
		 				$product = $item->get_product();
		 			}else{
		 				$product = new WC_Product($item['product_id']);
		 			}
		     
		      if(isset($product)){
		      	$tmp = array();
		      	$tmp['product_id'] = $item['product_id'];
			    $tmp['name']=$product->get_name();
         
      			$tmp['cost'] =$item_cost =strip_tags($product->get_price());
      		
      			$tmp['quantity'] = $quantity = $order->get_item_meta($item_id, '_qty', true);
           	    $tmp['sku'] = $product->get_sku();
           	
				array_push($order_items,$tmp);
				   
      			$total_items+=($item_cost*$quantity);
      	  }
        }
		   $values['product_total']=$total_items;
		   $values['products']=$order_items;
      
       
      return $values;
	}
	
	private function set_parameters($metas){
		$params = array();
		$cookie_keys = array('renid','click_id');
		$keys = array('product_total','products','billing_email','billing_phone',
		'billing_first_name','billing_last_name','billing_company','billing_address_1','billing_address_2','billing_city',
		'billing_state','billing_postcode','billing_country','shipping_first_name','shipping_last_name','shipping_company',
		'shipping_address_1','shipping_address_2','shipping_city','shipping_state','shipping_postcode','shipping_country',
		'order_tax','order_total','cart_discount','cart_discount_tax','order_shipping','order_shipping_tax','order_currency',
		'payment_method','customer_ip_address','transaction_id','paid_date','customer_user','order_number');
		
     foreach($metas as $meta_key => $meta_value){			
			   if(in_array($meta_value,$keys)){
			     $params[$meta_key]=sanitize_text_field($this->order_values[$meta_value]);
			   }elseif(!in_array($meta_key,$cookie_keys) && isset($_COOKIE[$meta_key])){
			   	if(stripos($_COOKIE[$meta_key],'_order_')>0){
			   		$params[$meta_key]=sanitize_text_field($meta_value);
			   	}else{
			   		$params[$meta_value]=sanitize_text_field($_COOKIE[$meta_key]); 
			   	}
			   }else{
           $params[$meta_key]=$meta_value; 
			   }
		 }
		 
		$incoming_click_id = $this->get_incoming_click_id();
		
		if(isset($_COOKIE[$incoming_click_id])){
       $params['click_id'] = $_COOKIE[$incoming_click_id]; 
		}  

		return $params;
	}
	
	
	public function set_click_id(){
		
		   $cookie_keys = array();   
      $click_id = $this->get_incoming_click_id();
       	$host = parse_url(get_option('siteurl'), PHP_URL_HOST);
       	
   			if(isset($_GET[$click_id])){
   				array_push($cookie_keys,$click_id);
   				$get_click_id =sanitize_text_field($_GET[$click_id]);
   					if(strlen($click_id) && strlen($get_click_id)){
							$expiry = strtotime('+1 month');
							setcookie($click_id,$get_click_id, $expiry,"/",$host);
						}
   			}
  		
  		
  		foreach($_GET as $meta_key => $meta_value){
  			if(!in_array($meta_key,$cookie_keys)){
  				if(!is_array($meta_value) && !is_array($meta_key) && strlen($meta_key) && strlen($meta_value)){
						$expiry = strtotime('+1 month');
						$meta_value = sanitize_text_field($meta_value);
						setcookie($meta_key,$meta_value, $expiry,"/",$host);
					}
  			}
  		}
	}

 
  private function get_postback_link(){
  	$fields = array();
  	
    $fields =$this->get_postback_link_fields();
  	
  	return $fields;
  }
  
  
  private function get_postback_link_fields(){
    $fields = array("amount"=>"order_total","adv_order_id"=>"order_number");
  	$fields = $this->set_parameters($fields);
  	$fields['adv_user_id'] = $this->options['renoon-merchant-id']; 
  	
  	return $fields;
  }
  
  
  
  private function can_fire_check(){
  	
		$incoming_click_id = $this->get_incoming_click_id();
		$out_click_id = "click_id";
		
		if(isset($_COOKIE['rencf'])){
       	  $this->can_fire = false;
       	  return;
    }
		
		if(isset($_COOKIE[$incoming_click_id])){
       $this->postback_params[$out_click_id] = $_COOKIE[$incoming_click_id]; 
             
       if(strlen($this->postback_params[$out_click_id])){
          $this->can_fire = true;
          return;
       }
		}
	}	
  
  private function build_query_string($params){
		$query="";
		$count=0;
		$specail_chars = array("currency");
		
		foreach($params as $key => $value){
			if($count==0){
				$query=$key."=".$value;
			}else{
				$and ="&";
				if(in_array($key,$specail_chars)){
					$and="&amp;";
				}
				$query.=$and.$key."=".$value;
			}
			$count++;
		}
		return $query;
	}
	
	private function do_postback_woo() {        
        
      
      $response = array();
      
       
       	$this->postback_params = array();
       	
       	 $this->postback_params = $this->get_postback_link();
 
       	 $this->can_fire_check();    
       
         $log_data = "can fire opw-".$this->can_fire;
         $this->logger($log_data);
         $this->logger(print_r($this->postback_params,true));
         
         
       	 if($this->can_fire){ 
       	 	
       	  $log_data = "url: ".$this->postback_url." params: ".$this->build_query_string($this->postback_params)." Method: GET"; 
       	  $this->logger($log_data);
       	  $args = array();
       	  $host = parse_url(get_option('siteurl'), PHP_URL_HOST);
     
					setcookie("rencf",1,0,"/",$host);
							
          $this->postback_url = $this->postback_url."?".$this->build_query_string($this->postback_params);
          		
          	$response = wp_remote_get($this->postback_url,$args);
          	$this->send_email_notification();
          	 if(isset($response['body'])){
        	 			$log_data = print_r( $response, true );
         		 }else{
                $log_data = "response failed"; 
             }
       	     
       	     $this->logger($log_data);
      
         }
       
        return $response;    
    } 
    
     protected function logger($data){
         $logger = new WC_Logger();
         $logger->add('renoon-tracking-pro', $data);
 		}  
  
    private function set_options() {

		 $this->options = get_option( $this->plugin_name . '-options' );

	  } // set_options()
	  
	  private function send_email_notification(){
	  //user posted variables
	   if(strlen($this->options['renoon-email-notify'])>5){
  		
  		$message = $this->get_html_email_message();

		//php mailer variables
  		$to = $this->options['renoon-email-notify'];
  		$subject = "New Renoon Email ";
  		$headers = array('From: Renoon <partnerships@renoon.com>','Reply-To: partnerships@renoon.com','Content-Type: text/html; charset=UTF-8');
 
		//Here put your Validation and send mail
			$sent = wp_mail($to, $subject,$message,$headers);
	      if($sent) {
	      	$this->logger("Notification Email sent Successfully");
		    }//message sent!
    	  else  {
					$this->logger("Notification Email sent failed");	
      	}//message wasn't sent
      }else{
      	$this->logger("Notification Email not Configured");	
      }
    }
    
    private function get_html_email_message(){
       $html ="<html><body><p><b>Dear Store Owner</b></p>,
       <p>Good News! A sale has been made on your website via Renoon. Below you’ll find the details about the sale. This email is purely for your information, no action in required yet as the invoice will be sent later.</p>
				<p><b>Order Id: ".$this->order_values['order_number']."</b><br>
					<b>Order Total: ".$this->order_values['order_total']."</b></p>
			<p>You can check the conversion on your account on: https://dashboard.roundly.io/login</p>
			<p>For any comments or doubts please reach out to partnerships@renoon.com</p>
			<p>Best,<br><br>
			Renoon Team</p></body></html>";
			return $html;
    }
    
   
}
