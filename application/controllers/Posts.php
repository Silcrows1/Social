<?php
	class Posts extends CI_Controller{

        //function to load all posts
		public function index(){
            //sets title
            $data['title'] = "Latest Posts";
            //get all posts and load in array
            $data['post'] = $this->post_model->get_posts();
            //load page with data
			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
        }
        //view post function
        public function view($slug = NULL){
            //retrieve post for $slug
            $data['post'] = $this->post_model->get_posts($slug);
            $post_id = $data['post']['id'];
            //get commends for for the post
            $data['comments'] = $this->comment_model->get_comments($post_id);
            //if the data post is empty, show 404 error.
            if(empty($data['post'])){
                show_404();
            }
            $data['title']=$data['post']['title'];
            //load page with data
            $this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');

        }
        //search function from routes. Performs search_post in model and sends results array to searches/search.php
        public function search(){
            //retrieve keywork from form
            $form_data = $this->input->post('keyword');
            //retrieve post array from search using keyword
            $data['post'] = $this->post_model->search_posts($form_data);
            //if the data post is empty, redirect to posts.
            if(empty($data['post'])){
                redirect('posts');
            }   
            //load page with data
            $this->load->view('templates/header');
			$this->load->view('searches/search', $data);
			$this->load->view('templates/footer');

        }

        public function create(){
            //check if user is logged in before allowing posts
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }
            //set page title
            $data['title']='Create Post';
            //retrieve all categories
            $data['categories'] = $this->post_model->get_categories();
            //form validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            //if form validation doesnt run, load page with data
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('posts/create', $data);
                $this->load->view('templates/footer');
            } else {
                //Ensure picture meets specifications
                $config['upload_path']='./assets/images/posts';
                $config['allowed_types']='gif|jpg|png';
                $config['max_size']='2048';
                $config['max_width']='2000';
                $config['max-height']='2000';
                $this->load->library('upload', $config);

                //sets unage to noimage.jpg if any errors occurs with specifications, otherwise sets filename in database.
                if (!$this->upload->do_upload()) {
                    $errors = array('error' => $this->upload->display_errors());
                    $post_image = 'noimage.jpg';
                } else {
                    $data = array('upload_data' => $this ->upload->data());
                    $post_image = $_FILES['userfile']['name'];
                }
                //create post and redirect to posts
                $this->post_model->create_post($post_image);
                redirect('posts');
            }
        }
        //delete post function
        public function delete($id){
            //check if user is logged in before allowing delete
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');               
            }
            //delete post where id's match and redirect
            $this->post_model->delete_post($id);
            redirect('posts');

        }
        //edit post function
        public function edit($slug){
            //check if user is logged in before allowing editing posts
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }
            //get post where slugs match
            $data['post'] = $this->post_model->get_posts($slug);

            //checks if user ID from session matches user_id from post, if they do not match, redirect to posts.
            if($this->session->userdata('user_id')!= $this->post_model->get_posts($slug)['user_id']){
                redirect('posts');
            }
            //retrieve all categories
            $data['categories'] = $this->post_model->get_categories();
            //if data for post is empty, show 404
            if(empty($data['post'])){
                show_404();
            }
            //sets page title
            $data['title']='Edit Post';
            //load page with data
            $this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');

        }
        //update post function        
        public function update(){
            //check if user is logged in before allowing updating posts
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }
            //update post and redirect
            $this->post_model->update_post();
            redirect('posts');
        }

        

    
}
