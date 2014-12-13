<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Hotels extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function index(){
            
            $data['hotels'] = $this->general_model->select('hotels');
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("hotels", $data);
            $this->load->view("includes/footer");
        }
        
        
        function hotel($id){
            $table = "hotels";
            $where = "id = ".$id;
            $items = "*";
            $order = "id";
            $data['resource'] = $this->general_model->select_entries_where($table, $where, $items, $order);
            $data['resource_type'] = "hotels";
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("resource", $data);
            $this->load->view("includes/footer");
        }
            
            
        function getIndex(){
            $collection = array(
                    1 => 'spa gym conference',
                    2 => 'spa gym swimming',
                    3 => 'golf tennis conference'
            );
        
            $dictionary = array();
            $docCount = array();
            
            foreach($collection as $docID => $doc) {
                    $terms = explode(' ', $doc);
                    $docCount[$docID] = count($terms);
        
                    foreach($terms as $term) {
                            if(!isset($dictionary[$term])) {
                                    $dictionary[$term] = array('df' => 0, 'postings' => array());
                            }
                            if(!isset($dictionary[$term]['postings'][$docID])) {
                                    $dictionary[$term]['df']++;
                                    $dictionary[$term]['postings'][$docID] = array('tf' => 0);
                            }
        
                            $dictionary[$term]['postings'][$docID]['tf']++;
                    }
            }
            return array('docCount' => $docCount, 'dictionary' => $dictionary);
        }
              
        function getTfidf($term) {
            $index = $this->getIndex();
            
            $docCount = count($index['docCount']);
            $entry = $index['dictionary'][$term];
            foreach($entry['postings'] as  $docID => $postings) {
                    echo "Document $docID and term $term give TFIDF: " .
                            ($postings['tf'] * log($docCount / $entry['df'], 2));
                    echo "\n";
            }
        }
        function shaz(){
            $index=array();
             $index = $this->getIndex();
             echo("please");
             die(var_dump($index));
             echo($index);
             
        }   
    }
?>