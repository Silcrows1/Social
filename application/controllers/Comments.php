<?php 
    class Comments extends CI_Controller{
        public function create($post_id){
            //sets slug variable from form
            $slug = $this->input->post('slug');
            //retireve post using slug
            $data['post']=$this->post_model->get_posts($slug);
            //Sets form validation for creating comment
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('body', 'Body', 'required');
            //if form validation didnt need to run, load page, else create comment and redirect to the post
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('posts/view', $data);
                $this->load->view('templates/footer');
            }else{
                $this->comment_model->create_comment($post_id);
                redirect('posts/'.$slug);

            }
        }
    }