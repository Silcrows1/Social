<?php
class Post_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    //retrieve all posts if slug=false.
    public function get_posts($slug=FALSE){
        if($slug===FALSE){
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories', 'categories.id = posts.category_id');
			$this->db->join('users', 'posts.user_id = users.id');
            $query = $this->db->get('posts');
            return $query->result_array();
        }
        $query = $this->db->get_where('posts', array('slug'=> $slug));
        return $query->row_array();
    }

    //create array using form post data and session data, and insert into database.
    public function create_post($post_image){
        $slug = url_title($this->input->post('title'));
        $data =array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id'=> $this->input->post('category_id'),
            'user_id' => $this->session->userdata('user_id'),
            'post_image' => $post_image
        );

        return $this->db->insert('posts', $data);
    }

    //locate entry in database using id and delete.
    public function delete_post($id){
        $this->db->where('id', $id);
        $this->db->delete('posts');
        return true;
    }

    //retrieve data from post, place in array, and update entry in database.
    public function update_post(){

        $slug = url_title($this->input->post('title'));
        $data =array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id'=> $this->input->post('category_id')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    //retrieve array of categories
    public function get_categories(){

        $this->db->order_by('cat_name');
        $query = $this->db->get('categories');
        return $query->result_array();

    }

    //search for posts by category
    public function get_posts_by_category($category_id){
        $this->db->order_by('posts.id', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get_where('posts', array('category_id' => $category_id));
        return $query->result_array();
    }

    //post search
    public function search_posts($keyword){
			
            //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
            //in posts body and title and comments name and body.
            $this->db->from('posts');
            $this->db->join('categories', 'categories.id = posts.category_id','left');
            $this->db->join('comments', 'posts.id = comments.post_id','left');
            $this->db->join('users', 'posts.user_id = users.id','left');
            $this->db->group_by('posts.id');
            $this->db->select('*, categories.cat_name, comments.created_at, posts.created_at, comments.body, posts.body,posts.title, comments.name, users.id');
            $this->db->like('posts.body', $keyword);
            $this->db->or_like('posts.title',$keyword);
            $this->db->or_like('comments.name',$keyword);
            $this->db->or_like('comments.body',$keyword);
            $query = $this->db->get();
			
            $str = $this->db->last_query();
			
            return $query->result_array();
			
        }
		public function search_userposts($keyword){
			
            //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
            //in posts body and title and comments name and body.
            $this->db->from('posts');
            $this->db->join('categories', 'categories.id = posts.category_id','left');
            $this->db->join('comments', 'posts.id = comments.post_id','left');
            $this->db->join('users', 'posts.user_id = users.id','left');
            $this->db->group_by('posts.id');
            $this->db->select('*, categories.cat_name, comments.created_at, posts.created_at, comments.body, posts.body,posts.title, comments.name, users.id');
			$this->db->or_WHERE('users.id',$keyword);            
            $query = $this->db->get();			
            $str = $this->db->last_query();
            return $query->result_array();
			
        }
}
