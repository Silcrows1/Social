<?php 
class Users extends CI_controller{
    //register user function
    public function register(){
        //page title
        $data['title']='Sign Up';
        //validation rules from register form
        $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('bio', 'Bio');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exsists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exsists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
        //if form validation hasnt run, load page data
        if($this->form_validation->run()===FALSE){
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            //Md5 Encryption for password
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);
            redirect('posts');
            //flash data to alert user, issues around it never dissapearing so commented out
            //$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('posts');
        }
    }
    //login user function
    public function login(){
        $data['title']='Sign in';
        //Login form validation
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        //if form validation doesnt run, load page data
        if($this->form_validation->run()===FALSE){
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
          $username = $this->input->post('username');
          //get and encrypt the password
          $password =md5($this->input->post('password'));
        
          //sends variabled for username and password to user_model to see if they exsist
          $user_id = $this->user_model->login($username, $password);
          
          if($user_id){
            //create the session is user_id exsists
            $user_data = array(
                'user_id' => $user_id,
                'username' => ucfirst($username),
                'logged_in' => true
            );
            //Sets session data to contain user_data array and redirects to posts, else redirect to login page
            $this->session->set_userdata($user_data);
            //flash data to alert user, issues around it never dissapearing so commented out
            //$this->session->set_flashdata('user_loggedin', 'You are now logged in');
            redirect('posts');
          }else{
            //flash data to alert user, issues around it never dissapearing so commented out
            //$this->session->set_flashdata('login_failed', 'Login is invalid');
            redirect('users/login');
          }                          
                
        }
    }
	public function viewUser($user_id){                                        //THIS IS THE NEW VIEW PROFILE FUNCTION!!!!!!!!!!!!		 

		$data2['post'] =$this->user_model->GetProfile($user_id);
			
		$data['post'] =$this->post_model->search_userposts($user_id);	
		$this->load->view('templates/header');
        $this->load->view('users/profile', $data2);
		$this->load->view('posts/profileposts', $data);
        $this->load->view('templates/footer');			
    
	}
	public function editUser($user_id){                                         //THIS IS THE NEW EDIT PROFILE FUNCTION!!!!!!!!!!!!	

		$data['post'] =$this->user_model->GetProfile($user_id);
		$this->load->view('templates/header');
        $this->load->view('users/Editprofile', $data);
        $this->load->view('templates/footer');			
            
	}
		public function updateProfile(){
        //check if user is logged in before allowing updating posts
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        //update post and redirect
        $this->user_model->updateProfile();
		session_unset();
		redirect('users/login');
            
        }
		public function updatePassword($user_id){

		$data['post'] =$this->user_model->GetProfile($user_id);
		$this->load->view('templates/header');
        $this->load->view('users/Editpassword', $data);
        $this->load->view('templates/footer');

		}

	 public function changePassword(){
		  			
			//check if user is logged in before allowing updating posts
			if (!$this->session->userdata('logged_in')) {
				redirect('users/login');
			}
			//update post and redirect
			$password =md5($this->input->post('password'));
			$this->user_model->updatePassword($password);	
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			redirect('users/login');
	 }
    //log user out

    public function logout(){
        //unset user data from session
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        //flash data to alert user, issues around it never dissapearing so commented out
        //$this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('users/login');
    }

    //Check for duplicate usernames
    public function check_username_exsists($username){
        $this->form_validation->set_message('check_username_exsists', 'That username is taken. Please choose a different one');
        if ($this->user_model->check_username_exsists($username)) {
            return true;
        }else{
            return false;
        }
    }
    //Check for duplicate emails
    public function check_email_exsists($email){
        $this->form_validation->set_message('check_email_exsists', 'That email is taken. Please choose a different one');
        if ($this->user_model->check_email_exsists($email)) {
            return true;
        }else{
            return false;
        }
    }
}
