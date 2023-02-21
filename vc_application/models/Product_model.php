<?php 
class Product_model extends CI_Model {
 
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
    public function get_product_by_url($pid) 
    {
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('p_id',$pid);
                $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  
	 public function get_bliss_product_list()
    {
		
		$this->db->select('*');
		$this->db->from('admin_product');
                $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	 public function get_new_arrivals_product($keyword='')
    {
		
		$this->db->select('product.*,m.d_name');
		$this->db->from('product'); 
        $this->db->where('product.status', 'active');
         if($keyword!='') { $this->db->like('product.pname', $keyword); }
		 $this->db->join('merchants as m','product.mid = m.id','left');
		$this->db->order_by('product.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 

	public function get_new_webstore($keyword='')
    {
		
		$this->db->select('*');
		$this->db->from('webstores'); 
                $this->db->where('web_status', 'active');
                if($keyword!='') { $this->db->like('web_name', $keyword); }
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_new_merchant($keyword='',$city='',$place='')
    {
		
		$this->db->select('m.*,mta.brand_proof');
		$this->db->from('merchants as m'); 
		$this->db->join('merchant_meta as mta', 'mta.merchant_id = m.id', 'left'); 
                $this->db->where('m.status', 'active');
                if($keyword!='') { $this->db->like('m.d_name', $keyword); }
                if($city!='') { $this->db->like('mta.city', $city); }
                if($place!='') { $this->db->like('mta.sector', $place); }
				
		$this->db->order_by('m.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
	public function get_stores_product()
    {
		
		$this->db->select('*');
		$this->db->from('webstores');
                $this->db->where('web_status', 'active');
                $this->db->limit(24);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	  public function get_deal_by_url()
    {
		
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','1');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  
	 public function get_deals_list()
    {
		
		$this->db->select('merchants.*, merchant_meta.brand_proof');
		$this->db->from('merchants'); 
		$this->db->join('merchant_meta', 'merchant_meta.merchant_id = merchants.id', 'left'); 
		$this->db->where('merchants.status','active');
		$this->db->order_by('merchants.id','desc');
		$this->db->limit(24);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	   public function b_c_Offers(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','2');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
   } 
   
   public function best_deals_discount(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','3');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
    public function b_d_coupon(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','4');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function get_new_product_category($category)
    {
		
		$this->db->select('p.*,m.id,m.d_name,p.id as proid');
		$this->db->from('product as p'); 
		$this->db->join('merchants as m','m.id=p.mid','left');
		$this->db->where('p.status', 'active');
		$this->db->where('p.sub_category',$category); 
		$this->db->or_where('p.category',$category);
		$this->db->order_by('p.visibility','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
}
?>