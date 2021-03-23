<?php
    class Category_model extends CI_model{
        //Load Database
        public function __construct(){
            $this->load->database();
        }
        //Function to get categories
        public function get_categories(){
            $this->db->order_by('cat_name');
            $query = $this->db->get('categories');
            return $query->result_array();    
        }
        //Function to create categories
        public function create_category(){
            $data = array(
                'cat_name' => $this->input->post('name')
            );

            return $this->db->insert('categories', $data);
        }
        //Function to get categories where the ID is the same
        public function get_category($id){
            $query= $this->db->get_where('categories', array('id' => $id));
            return $query->row();
        }


    }