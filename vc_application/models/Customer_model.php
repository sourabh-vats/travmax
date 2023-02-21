<?php 
class Customer_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
     public function get_operator() {
               $this->db->select('*');
				$this->db->from('mobile_operator'); 
                $this->db->where('oper_status','active');
		        $query = $this->db->get();
		return $query->result_array(); 
	}
	  public function get_list_circle() {
               $this->db->select('*');
		$this->db->from('operator_circle'); 
                $this->db->where('cir_status','active');
		$query = $this->db->get();
		return $query->result_array(); 
}
   public function get_operator_plan() {
               $this->db->select('*');
		$this->db->from('operator_plan'); 
                $this->db->where('pl_status','active');
                $this->db->order_by('plan','asc');
		$query = $this->db->get();
		return $query->result_array(); 
}
function update_customer_bliss($id,$amount)
    {
    $this->db->query("UPDATE customer SET income_wallet=income_wallet-$amount WHERE id='$id'");
	}
	function update_redeem_bliss($id,$data)
    {
		$this->db->where('id',$id);
    $this->db->update('credit_hstry', $data); 
	}
 function add_redeem_bliss($data)
    {
		$this->db->insert('credit_hstry', $data);
              $insert_id = $this->db->insert_id();
		return $insert_id;
	}
		function add_recharge_in_order($data)
    {
		$this->db->insert('recharge_orders', $data);
        $insert_id = $this->db->insert_id();
		return $insert_id;
	}
public function get_customer_credit($cid)
    {
       
		$this->db->select('id,bliss_amount,tr_pin,f_name,l_name,phone,income_wallet');
		$this->db->from('customer');
		$this->db->where('id',$cid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_product($uid)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('mid',$uid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	  public function state()
    {
		$this->db->select('*');
		$this->db->from('states');
		$query=$this->db->get();
		return $query->result_array(); 
    }
	
		public function get_all_constituency_list_pid($category)
    {
		$this->db->select('*');
		$this->db->from('cities'); 
		//$this->db->where('status','active');
		$this->db->where('state_id',$category);
		$query = $this->db->get();
		return $query->result_array(); 
    }	
	
	public function get_all_constituency_code_pid($category)
    {
		$this->db->select('code_no');
		$this->db->from('referall_ids'); 
		$this->db->where('status','active');
		$this->db->where('id',$category);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
/*	function fetch_constituency()
{
	$this->db->select('*');
	$this->db->from('referall_ids');
	$this->db->where('p_id=',0);
	$this->db->order_by('c_name','ASC');
	$query = $this->db->get();
	return $query->result_array();
}*/

function fetch_constituency()
{
	$this->db->select('*');
	$this->db->from('states');
	//$this->db->where('p_id=',0);
	$this->db->order_by('name','ASC');
	$query = $this->db->get();
	return $query->result_array();
}


	public function get_merchants_by_cat($id,$start=0)
    {
       
		$this->db->select('merchant_meta.merchant_id,merchant_meta.brand_proof,merchant_meta.business_type,merchant_meta.b_details,merchants.d_name');
		$this->db->from('merchant_meta'); 
$this->db->join('merchants', 'merchants.id = merchant_meta.merchant_id');
		$this->db->like('merchant_meta.business_type',$id);
		$this->db->where('status','active');
		//$this->db->where_in("attribute", date("D"));
		$this->db->limit(16,$start);
		$this->db->order_by("merchant_type", "desc");	
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_all_merchants_by_cat($id)
    {
       
		$this->db->select('merchant_meta.merchant_id,merchant_meta.brand_proof,merchant_meta.business_type,merchant_meta.b_details,merchants.d_name');
		$this->db->from('merchant_meta'); 
$this->db->join('merchants', 'merchants.id = merchant_meta.merchant_id');
		$this->db->like('merchant_meta.business_type',$id);
		$this->db->where('status','active');
		//$this->db->where_in("attribute", date("D"));
		$this->db->order_by("merchant_type", "desc");	
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_category_list()
    {
       
		$this->db->select('id,c_name');
		$this->db->from('categorys'); 
		$query = $this->db->get();
		return $query->result_array(); 
    } 		
	public function get_category($name)
    {
       
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function get_coupon($coupon) {
	 	
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('code',$coupon);
		$query = $this->db->get();
		return $query->result_array(); 
	}
public function get_order_coupon_by_customer($uid,$coupon_code) {
	 	
		$this->db->select('count(id) as total');
		$this->db->from('orders');
		$this->db->where('user_id',$uid);
		$this->db->where('coupon',$coupon_code);
		$query = $this->db->get();
		return $query->result_array(); 
	}

  public function get_product_by_url($pid)
    {
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('p_id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }  	
	
	public function store($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
	
	public function get_store_product($pid)
    {
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('web_id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_store_product_by_id($pid)
    {
		$this->db->select('id,url,s_name,web_id');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	


public function bliss_product(){
         
		$this->db->select('*');
		$this->db->from('product');
	//	$this->db->where('category','48');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function get_featured_product(){
         
		$this->db->select('product.*,m.d_name');
		$this->db->from('product');
		$this->db->join('merchants as m','product.mid = m.id','left');
		$this->db->where('product.visibility','1');
		$this->db->where('product.status','active');
		$this->db->order_by('product.id','desc');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	public function get_featured_admin_product(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','4');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result_array(); 
   }	
   
   public function get_featured_deal_product(){
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','4');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		//$this->db->limit(30);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
     public function get_category_product($categoryid)    {		
               	
     	       $this->db->select('*');	
	       $this->db->from('admin_product');	
		$this->db->where('status','active');
	       $this->db->where('category',$categoryid);
           $this->db->order_by("product_type", "asc");		   
	       $query = $this->db->get();	
	       return $query->result_array();  
   }		

	
	public function hot_deal(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','1');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function b_c_Offers($category)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		if(!empty($category)) {
			$this->db->where('category',$category);
		}
		$this->db->where('web_status','active');
		//$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 

	public function b_c_Offerss()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
   
   
   
   public function b_d_discount(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','3');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(6); 
		$query = $this->db->get();
		return $query->result_array(); 
   }

   public function b_d_coupon(){
         
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		//$this->db->order_by('id','desc');
		$this->db->limit(12); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  
   public function slider(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','5');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(6); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  

   public function dealslider(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','6');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(4); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  

   public function dealslider1(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','6');
		$this->db->where('status','active');
		$this->db->order_by('id','asc');
		$this->db->limit(4); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  


   
 function upload_user_product_design($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}
   
   
   public function bliss_web_stores(){
         
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		//$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
   }        
   public function get_category_id($name)    {  
   
   $this->db->select('id');	
   $this->db->from('categorys');
   $this->db->where('c_name',$name);
   $query = $this->db->get();	
   return $query->result_array();     }         

   function get_customer_address($cust_id){
	   $this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}  
	
		 public function get_category_food_list()
    {
       
		$this->db->select('id,c_name,image');
		$this->db->from('categorys'); 
		$this->db->where('status','active');
		//$this->db->where('position','');
		//$this->db->where('p_id','99');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	public function merchant_data() {
               $this->db->select('merchant_meta.merchant_id,merchant_meta.brand_proof, merchants.d_name,merchants.phone');
		$this->db->from('merchants');
		$this->db->join('merchant_meta', 'merchants.id = merchant_meta.merchant_id','left');
        $this->db->limit(8);
		$query = $this->db->get();
		return $query->result_array(); 
}

	public function merchant_all_data() {
        $this->db->select('merchant_meta.merchant_id,merchant_meta.brand_proof, merchants.d_name,merchants.phone');
		$this->db->from('merchants');
		$this->db->join('merchant_meta', 'merchants.id = merchant_meta.merchant_id','left');
		$query = $this->db->get();
		return $query->result_array(); 
}	

public function merchant_all_cat_data($category) {
        $this->db->select('merchant_meta.merchant_id,merchant_meta.brand_proof, merchants.d_name,merchants.phone');
		$this->db->from('merchants');
		$this->db->join('merchant_meta', 'merchants.id = merchant_meta.merchant_id','left');
		$this->db->where_in('merchant_meta.business_type',$category);
		$query = $this->db->get();
		return $query->result_array(); 
}


 public function get_city()
    {
		$this->db->select('city');
		$this->db->from('merchant_meta');
		$this->db->group_by('city'); 
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_place($city)
    {
		$this->db->select('sector');
		$this->db->from('merchant_meta');
		$this->db->like('city',$city);
		$this->db->group_by('sector'); 
		$query = $this->db->get();
		return $query->result_array(); 
    }

	 public function get_WorkWith_last_id()
    {
		$this->db->select('id_no');
		$this->db->from('WorkWith');
		$this->db->order_by('id_no','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
   
    function insert_WorkWith($data)
    {
		$insert = $this->db->insert('WorkWith', $data);
		return $insert;
	}
	
	   public function recharge_setting() {
                $this->db->select('*');
		        $this->db->from('site_setting'); 
               // $this->db->where('oper_status','active');
		        $query = $this->db->get();
		return $query->result_array(); 
}

   }
?>