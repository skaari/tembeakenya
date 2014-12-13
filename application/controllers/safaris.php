<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Safaris extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function index(){
            
            $data['safaris'] = $this->general_model->select('safaris');
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("safaris", $data);
            $this->load->view("includes/footer");
        }
        
        
        function safari($id){
            $table = "safaris";
            $where = "id = ".$id;
            $items = "*";
            $order = "id";
            $data['resource'] = $this->general_model->select_entries_where($table, $where, $items, $order);
            $data['resource_type'] = "safaris";
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("resource", $data);
            $this->load->view("includes/footer");
        }
        
    }

?>