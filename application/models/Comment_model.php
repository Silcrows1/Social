<?php
    class Comment_model extends CI_Model{
        //Load Database//
        public function __constuct (){
            $this->load->database();
        }
        //Function to create comment with set parameters
        public function create_comment($post_id){
            $data = array(
                'post_id' => $post_id,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'body' => $this->input->post('body')
            );
            return $this->db->insert('comments', $data);
        }
        //Function to retrieve comments where IDs match
        public function get_comments($post_id){
            $query = $this->db->get_where('comments', array('post_id' => $post_id));
            return $query->result_array();
        } 
    }