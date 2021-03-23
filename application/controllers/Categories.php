<?php
    class Categories extends CI_Controller{

        public function index(){
            //set page title
            $data['title'] ='Categories';
            //send request for category data from model, before creating new page with the data.
            $data['categories'] = $this->category_model->get_categories();

                $this->load->view('templates/header');
                $this->load->view('categories/index', $data);
                $this->load->view('templates/footer');
            
        }
        public function create(){
            //check if user is logged in before allowing creating catagorys
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }
            //set page title
            $data['title'] ='Create Category';
            //Name on form is required
            $this->form_validation->set_rules('name', 'Name', 'required');
            //Load page if form validation hasnt run, else send data to model
            if ($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('categories/create', $data);
                $this->load->view('templates/footer');
            } else {
                $this->category_model->create_category();
                redirect('categories');
            }
        }

        public function posts($id){
            //retrieve categories with the name, and then retrieve all posts with the category name, create page to show all posts under that category
            $data['title'] = $this->category_model->get_category($id)->cat_name;
            $data['posts'] = $this->post_model->get_posts_by_category($id);
            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }
    }