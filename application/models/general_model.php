<?php
class General_model extends CI_Model{
	#function __construct(){
	#	parent::__construct();
	#}
	
	function select($table)
	{
		$query = $this->db->get($table);
		return $query->result();
	}
	
	function select_order($table, $order, $orient)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->order_by($order, $orient);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function select_pagination($limit, $start, $table, $where, $items, $order)
	{
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "asc"); 
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function select_pagination2($limit, $start, $table, $where, $items, $order)
	{
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "DESC");
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function select_pagination_inverse($limit, $start, $table, $where, $items, $order)
	{
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "DESC"); 
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function selected_pagination_with_join($limit, $start, $table, $where, $items, $order){
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->join("retail_store", "transaction.retail_store_id = retail_store.retail_store_id", "right");
		$this->db->join("charity", "transaction.charity_id = charity.charity_id", "left");
		$this->db->order_by($order, "asc"); 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function select_pagination_with_one_join($limit, $start, $table, $where, $items, $order, $join_table, $join_reference_field, $join_field, $join_type){
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->join($join_table, $join_reference_field." = ".$join_field, $join_type);
		#$this->db->join("charity", "transaction.charity_id = charity.charity_id", "left");
		$this->db->order_by($order, "asc");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function selected_pagination_with_join_inverse($limit, $start, $table, $where, $items, $order){
		$this->db->limit($limit, $start);
		
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->join("retail_store", "transaction.retail_store_id = retail_store.retail_store_id", "right");
		$this->db->join("charity", "transaction.charity_id = charity.charity_id", "left");
		$this->db->order_by($order, "DESC"); 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function select_entries_where($table, $where, $items, $order = NULL)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		
		if($order != NULL)
		{
			$this->db->order_by($order, "asc");
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function select_from_db($table, $where, $items, $order = NULL)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		
		if($order != NULL)
		{
			$this->db->order_by($order, "asc");
		}
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function select_entries_where3($table, $where,$where2, $items, $order)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where2);
		$this->db->where($where);
		$this->db->order_by($order, "asc");
		$query = $this->db->get();
		
		return $query->result();
	}
	function select_entries_where4($table, $where, $items, $order)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
	// new home page
	//    function select_entries_where4($table, $where, $items, $order)
	// {
	//        $this->db->select($items);
	//        $this->db->from($table);
	//        $this->db->where($where);
	//        $this->db->order_by($order, "desc");
	//        $query = $this->db->get();
	
	//        return $query->result();
	//    }
	
	function select_distinct_entries_where($table, $where, $items, $order)
	{
		#$this->db->distinct();
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by("merchant_id");
		$this->db->order_by($order, "asc");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function select_entries_where_limit($table, $where, $items, $order, $limit)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "asc");
		$this->db->limit($limit);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function select_entries_where2($table, $where, $items, $order)
	{
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "DESC");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function select_active_charities_by_popularity()
	{
		$query = $this->db->query("
		SELECT `charity`.*, COUNT(shopper.charity_id) AS CharitySupporters
		FROM (`charity`, `shopper`)
		WHERE `charity`.`charity_account_status` = 1
		AND charity.charity_id = shopper.charity_id
		GROUP BY `charity`.`charity_name`
		ORDER BY `charity`.`charity_name` asc
		");
		return $query->result();
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Save data to the database
	-----------------------------------------------------------------------------------------
	*/
	function insert($table, $items)
	{
		$this->db->insert($table, $items);
		return $this->db->insert_id();
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Updates data in the database
	-----------------------------------------------------------------------------------------
	*/
	function update($table, $items, $field, $key)
	{
		$this->db->where($field, $key);
		$this->db->update($table, $items);
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Updates data in the database
	-----------------------------------------------------------------------------------------
	*/
	function update2($table, $items, $where)
	{
		$this->db->where($where);
		$this->db->update($table, $items);
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Deletes data in the database
	-----------------------------------------------------------------------------------------
	*/
	function delete($table, $field, $key)
	{
		$this->db->where($field, $key);
		$this->db->delete($table);
	}  
	
	public function items_count($table, $where) {
		$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	
	#public function distinct_items_count($distinct, $table, $where){
	#    #$this->db->distinct($distinct);
	#    $this->db->where($where);
	#    $this->db->from($table);
	#    $this->db->group_by($distinct);
	#    return $this->db->count_all_results();
	#}
	
	public function distinct_items_count($distinct, $table, $where){
		$sql = "SELECT DISTINCT ".$distinct." 
		FROM ".$table."
		WHERE ".$where;
		$result = $this->db->query($sql);
		return $result->num_rows;
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Send a mail via mandrill
	-----------------------------------------------------------------------------------------
	*/
	function send_mail($user_email, $user_name, $subject, $message, $sender_email = NULL, $shopping = NULL, $from = NULL, $button = NULL)
	{
		$adam = "adam@shopnate.com.au";
		if(!isset($sender_email)){
			$sender_email = "adam@shopnate.com.au";
		}
		if(!isset($shopping)){
			$shopping = "";
		}
		if(!isset($from)){
			$from = "Shopnate";
		}
		if(!isset($button)){
			$button = '<a href="'.site_url().'shops/most-popular" class="btn" mc:edit="button" style="margin: 0;padding: 10px 16px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;text-decoration: none;background-color: #ba3a3f;font-weight: bold;margin-right: 10px;text-align: center;cursor: pointer;display: inline-block;">Take Me Shopping</a>';
		}
		
		$template_name = 'basic';
		$template_content = array(
			array(
				'name' => 'header',
				'content' => $user_name
			),
			array(
				'name' => 'body',
				'content' => $message
			),
			array(
				'name' => 'shopping',
				'content' => $shopping
			),
			array(
				'name' => 'button',
				'content' => $button
			)
		);
		$message = array(
			//'html' => '<p>Example HTML content</p>',
			'text' => $message,
			'subject' => $subject,
			'from_email' => $sender_email,
			'from_name' => $from,
			'to' => array(
				array(
				'email' => $user_email,
				'name' => $user_name,
				'type' => 'to'
			)
		),
		'headers' => array('Reply-To' => $sender_email),
		'important' => false,
		'track_opens' => null,
		'track_clicks' => null,
		'auto_text' => null,
		'auto_html' => null,
		'inline_css' => null,
		'url_strip_qs' => null,
		'preserve_recipients' => null,
		'view_content_link' => null,
		'bcc_address' => null,
		'tracking_domain' => null,
		'signing_domain' => null,
		'return_path_domain' => null,
		'merge' => true,
		'global_merge_vars' => array(
			array(
				'name' => 'merge1',
				'content' => 'merge1 content'
			)
		),
		'merge_vars' => array(
			array(
				'rcpt' => $sender_email,
				'vars' => array(
					array(
						'name' => 'merge2',
						'content' => 'merge2 content'
					)
				)
			)
		),
		'tags' => array('password-resets'),
		'subaccount' => NULL, //'customer-123',
		'google_analytics_domains' => array('www.shopnate.com.au'),
		'google_analytics_campaign' => 'shopnate1@gmail.com',
		'metadata' => array('website' => 'www.shopnate.com.au'),
		'recipient_metadata' => array(
			array(
				'rcpt' => $sender_email,
				'values' => array('user_id' => 123456)
			)
		),
		/*'attachments' => array(
		array(
		'type' => 'text/plain',
		'name' => 'myfile.txt',
		'content' => 'ZXhhbXBsZSBmaWxl'
		)
		),*/
		'attachments' => NULL,
		'images' => NULL
		/*'images' => array(
		array(
		'type' => 'image/png',
		'name' => 'IMAGECID',
		'content' => 'ZXhhbXBsZSBmaWxl'
		)
		)*/
		);
		$async = false;
		$ip_pool = 'Main Pool';
		$send_at = date("H.i");
		$this->mandrill->messages->sendTemplate($template_name, $template_content, $message);
	} 
		
	public function encode_retail_store($retail_store_id) 
	{
		$retail_store_encoded = $this->encrypt->encode($retail_store_id);
		
		while (strpos($retail_store_encoded,'/') == TRUE) {
			$retail_store_encoded = $this->encrypt->encode($retail_store_id);
		}
		
		if ($retail_store_encoded[0] == "/") {
			$retail_store_encoded = $this->encrypt->encode($retail_store_id);
		}
		
		if(substr($retail_store_encoded, -1) == "/"){
			$retail_store_encoded = $this->encrypt->encode($retail_store_id);
		}
		
		return $retail_store_encoded;
	}
	
	/*
	-----------------------------------------------------------------------------------------
	Select a number of items from a particluar database table
	-----------------------------------------------------------------------------------------
	*/
	function select_limit($limit, $table, $where, $items, $order)
	{
		$this->db->limit($limit);
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "asc"); 
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	function select_limit2($limit, $table, $where, $items, $order)
	{
		$this->db->limit($limit);
		$this->db->select($items);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "DESC"); 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	return false;
	}
	
	function do_upload($gallery_path)
	{
		/*
			-----------------------------------------------------------------------------------------
			Upload an image
			-----------------------------------------------------------------------------------------
		*/
		$config = array(
			'allowed_types' => 'JPG|JPEG|jpg|jpeg|gif|png',
			// 'allowed_types' => 'JPG|JPEG|jpg|jpeg',
			'upload_path' => $gallery_path,
			'quality' => "100%",
			'file_name' => md5(date('Y-m-d H:i:s')),
			'max_size' => 3072
		);
		
		$this->load->library('upload', $config);
		if($this->upload->do_upload() == FALSE)
		{
			return "FALSE";
		}
		else{
			$image_data = $this->upload->data();
			return $image_data;
		}
	}
	
	function resize_image($path, $gallery_path, $file_name, $width, $height, $new_path)
	{
		$this->load->library('image_lib');
			$resize_conf = array(
			'source_image'  => $path,
			'new_image'     => $new_path,
			'new_image'     => $path.'images/'.$file_name,
			'create_thumb'  => FALSE,
			'width' => $width,
			'height' => $height,
			'maintain_ratio' => true,
		);
		
		$this->image_lib->initialize($resize_conf);
		
		if ( ! $this->image_lib->resize())
		{
			return $this->image_lib->display_errors();
		}
		
		else
		{
			return TRUE;
		}
	}
	
	function get_total_donations()
	{
		/**
		* Retrieve the charity returns from the db
		* ---------------------------------------------------------------------------------------------
		*/
		
		$table = "transaction";
		$where = "transaction.transaction_status IN (2, 4)";
		$items = "SUM(payable_amount) AS payable";
		$order = "payable";
		$transactions = $this->select_entries_where($table, $where, $items, $order);
		$return_data = "";
		
		$total_raised = $transactions[0]->payable;
		$total_raised = number_format($total_raised, 2, '.', ',');
		
		$return_data .= '
		<ul>
		<li><span class="number first">$</span></li>';
		
		$total_raised_split = explode(".", $total_raised);
		$whole_part_figures_string = $total_raised_split[0];
		$whole_part_figures_string = str_pad($whole_part_figures_string, 5, "0", STR_PAD_LEFT);
		$whole_part_figures_string = strrev($whole_part_figures_string);
		$whole_part_figures_array = array_chunk(str_split($whole_part_figures_string), 3, true);
		$whole_part_figure_array_reversed = array_reverse($whole_part_figures_array);
		
		foreach($whole_part_figure_array_reversed as $key => $group){
			end($whole_part_figure_array_reversed);
			$group = array_reverse($group);
			foreach($group as $value){
				$return_data .= "<li><span class='number'>".$value."</span></li>";
			}
			if($key !== key($whole_part_figure_array_reversed)){
				$return_data .= "<li><span>,</span></li>";
			}
		}
		$return_data .= "<li><span>.</span></li>";
		$decimal_part_figures_string_array = str_split($total_raised_split[1]);
		
		foreach($decimal_part_figures_string_array as $key => $figure){
			end($decimal_part_figures_string_array);
			if($key !== key($decimal_part_figures_string_array)){
				$return_data .= "<li><span class='number'>".$figure."</span></li>";
			} else{
				$return_data .= "<li><span class='number last'>".$figure."</span></li>";
			}
		}
		
		$return_data .= "</ul>";
		
		/*
		$return_data = '
		<ul>
		<li><span class="number first">$</span></li>
		<li><span class="number">0</span></li>
		<li><span class="number">0</span></li>
		<li><span>,</span></li>
		<li><span class="number">6</span></li>
		<li><span class="number">1</span></li>
		<li><span class="number">9</span></li>
		<li><span>.</span></li>
		<li><span class="number">3</span></li>
		<li><span class="number last">0</span></li>
		</ul>
		';*/
		return $return_data;
	}
	
	function getTinyUrl($url) {
		$tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
		return $tinyurl;
	}
	
	function create_web_name($merchant_name)
	{
		$new = strip_tags($merchant_name);
		$merchant_name_str = str_replace(array( '!', '*','#','?' ), '', $new);
		
		if (strpos($merchant_name_str, ' (' ) !== false) {
			$merchant_name_std = substr($merchant_name_str, 0, strpos($merchant_name_str, ' ('));
		} 
		else
		{
			$merchant_name_std = $merchant_name_str;
		}
		
		$merchant_name_stripped = rtrim($merchant_name_std, ". ");
		
		$total_names = explode(" ", strtolower($merchant_name_stripped));
		$web_name = "";
		
		if(count($total_names) > 1)
		{
			for($f = 0; $f < count($total_names); $f++)
			{
				if(($total_names[$f] != "(") && ($total_names[$f] != ")") && ($total_names[$f] != "&")){
					if($f == (count($total_names) - 1))
					{
						$web_name .= $total_names[$f];
					}
					else
					{
						$web_name .= $total_names[$f]."-";
					}
				}
			}
		}
		else
		{
			$web_name = strtolower($merchant_name_stripped);
		}
		/*
		*	Remove .
		*/
		$total_names = explode(".", strtolower($merchant_name_stripped));
		
		if(count($total_names) > 1)
		{
			$web_name = "";
			for($f = 0; $f < count($total_names); $f++)
			{
				if(($total_names[$f] != "(") && ($total_names[$f] != ")") && ($total_names[$f] != "&")){
					if($f == (count($total_names) - 1))
					{
						$web_name .= $total_names[$f];
					}
					else
					{
						$web_name .= $total_names[$f]."-";
					}
				}
			}
		}
		
		/*
		*	Remove /
		*/
		$total_names = explode("/", strtolower($merchant_name_stripped));
		
		if(count($total_names) > 1)
		{
			$web_name = "";
			for($f = 0; $f < count($total_names); $f++)
			{
				if(($total_names[$f] != "(") && ($total_names[$f] != ")") && ($total_names[$f] != "&")){
					if($f == (count($total_names) - 1))
					{
						$web_name .= $total_names[$f];
					}
					else
					{
						$web_name .= $total_names[$f]."-";
					}
				}
			}
		}
		
		return $web_name;
	}
	
	function export_shopper_list_csv()
	{
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM (`shopper`) WHERE `shopper_id` > 0 ORDER BY `shopper_fname` asc");
		return $this->dbutil->csv_from_result($query);
	}
	function export_charity_list_csv()
	{
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM (`charity`) WHERE `charity_id` > 0 ORDER BY `total_supporters` desc");
		return $this->dbutil->csv_from_result($query);
	}

}
