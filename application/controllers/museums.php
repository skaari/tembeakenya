<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Museums extends CI_Controller {
        function __construct(){
            parent::__construct();
            $this->load->model('general_model');
        }
        
        function index(){
            
            $data['museums'] = $this->general_model->select('museums');
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("museums", $data);
            $this->load->view("includes/footer");
        }
        
        function museum($id){
            $table = "museums";
            $where = "id = ".$id;
            $items = "*";
            $order = "id";
            $data['resource'] = $this->general_model->select_entries_where($table, $where, $items, $order);
            $data['resource_type'] = "museums";
            
            $this->load->view("includes/header");
            $this->load->view("includes/navigation");
            $this->load->view("resource", $data);
            $this->load->view("includes/footer");
        }
        
        function recommend($resource_type, $resource_id){
            if($resource_type == "museums"){
                $resource_where = "museum";
            }elseif($resource_type == "lakes"){
                $resource_where = "lake";
            }
            elseif($resource_type == "safaris"){
                $resource_where = "safari";
            }
            elseif($resource_type == "beaches"){
                $resource_where = "beach";
            }
            elseif($resource_type == "hotels"){
                $resource_where = "hotel";
            }
            
            $result = $this->general_model->select_entries_where($resource_type, "id = $resource_id", "description");
            
            
            #die(var_dump($result));
            
            //$query = explode(" ", $result[0]->description);
            //$query = array('is', 'short', 'string');
            $query = array('spa', 'gym', 'conference', "hiking", "waterfall", "spa");
            //die(var_dump($query));
            
            
            
            

            $index = $this->_getIndex($resource_type);
            $matchDocs = array();
            //$matchDocs = new SplFixedArray(3);
            //$matchDocs->toArray();
            $docCount = count($index['docCount']);
            
            foreach($query as $qterm) {
                    $entry = $index['dictionary'][$qterm];
                    foreach($entry['postings'] as $docID => $posting) {
                            
                            $matchDocs[$docID] +=
                                            $posting['tf'] *
                                            log($docCount + 1 / $entry['df'] + 1, 2);
                    }
            }
            
            // length normalise
            foreach($matchDocs as $docID => $score) {
                    $matchDocs[$docID] = $score/$index['docCount'][$docID];
            }
            
            arsort($matchDocs); // high to low
            
            var_dump($matchDocs);
                        
            
            
            //$result = $this->_getTfidf('Sharon');
            //$terms = $result['dictionary'];
            //die(var_dump($result));
            #die(var_dump($terms));
        }
        
        function _getTfidf($term) {
            $index = $this->_getIndex();
            
            $docCount = count($index['docCount']);
            $entry = $index['dictionary'][$term];
            foreach($entry['postings'] as  $docID => $postings) {
                echo "Document $docID and term $term give TFIDF: " .
                        ($postings['tf'] * log($docCount / $entry['df'], 2));
                echo "\n";
            }
        }
        
        function _getIndex($resource_type = NULL) {
            
            $result = $this->general_model->select_entries_where($resource_type, "id IS NOT NULL", "description");
            $collection = array();
            
            #foreach($result as $resource){
             #   array_push($collection, $resource->description);
           # }
            
            #die(var_dump($collection));
            
            $collection = array(
                    1 => 'spa gym conference',
                   2 => 'spa gym swimming',
                    3 => 'golf tennis conference'
            );
            #die(var_dump($collection));
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
        
        function _normalise($doc) {
            foreach($doc as $entry) {
                $total += $entry*$entry;
            }
            $total = sqrt($total);
            foreach($doc as &$entry) {
                $entry = $entry/$total;
            }
            return $doc;
        }
        
        function cosineSim($docA, $docB) {
            $result = 0;
            foreach($docA as $key => $weight) {
                $result += $weight * $docB[$key];
            }
            return $result;
        }
    }
    
?>