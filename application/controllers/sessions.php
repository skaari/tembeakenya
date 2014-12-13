<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Sessions extends CI_Controller {  
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function new_session(){
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("login");
            $this->load->view("includes/footer");
        }
        
        function login(){
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            
            $db_password = $this->general_model->select_entries_where("users", "email = '$email'", "password", "user_id");
            if($db_password[0]->password == $password){
                # User exists
                # Create the session
                
                $newdata = array(
                    'email'  => $email,
                    'login_status'     => true
                );
                $this->session->set_userdata($newdata);
                
            }else{
                # User does not exist
                # Return an error message
            }
            die(var_dump($db_password));
        }
    }

?>