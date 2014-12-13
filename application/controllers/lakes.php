<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Lakes extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function index(){
            
            $data['lakes'] = $this->general_model->select('lakes');
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("lakes", $data);
            $this->load->view("includes/footer");
        }

        function lake($id){
            $table = "lakes";
            $where = "id = ".$id;
            $items = "*";
            $order = "id";
            $data['resource'] = $this->general_model->select_entries_where($table, $where, $items, $order);
            $data['resource_type'] = "lakes";
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("resource", $data);
            $this->load->view("includes/footer");
        }



    }

    
?>