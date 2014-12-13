<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('general_model');
    }
    
    function index(){
        $this->load->view("includes/header");
        $this->load->view("includes/navigation");
        $this->load->view("index");
        $this->load->view("includes/footer");
    }
    
    function contact(){
        $this->load->view("includes/header");
        $this->load->view("includes/navigation");
        $this->load->view("contact");
        $this->load->view("includes/footer");
    }
    
    function test(){
        echo(base_url());
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */