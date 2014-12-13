<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Beaches extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function index(){
            
            $data['beaches'] = $this->general_model->select('beaches');
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("beaches", $data);
            $this->load->view("includes/footer");
        }
        
        function beach($id){
            $table = "beaches";
            $where = "id = ".$id;
            $items = "*";
            $order = "id";
            $data['resource'] = $this->general_model->select_entries_where($table, $where, $items, $order);
            $data['resource_type'] = "beaches";
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("resource", $data);
            $this->load->view("includes/footer");
        }
        
        
    }

?>