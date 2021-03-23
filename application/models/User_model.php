<?php
    class User_model extends CI_Model{
        public function register($enc_password){
            //user data array
            $data = array(
                'name' => $this->input->post('name'),
				'bio' => $this->input->post('bio'),
                'postcode' => $this->input->post('postcode'),
				'email' => $this->input->post('email'),
                'username' => ucfirst($this->input->post('username')),
                'password' => $enc_password                
			);

            //insert user into database
            return $this->db->insert('users', $data);
        }

        //login function
        public function login($username, $password){
            //Checks database to see where username and password match
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $result=$this->db->get('users');

            //If results from database are true, then return the Id of the user, else return false.
            if ($result->num_rows()==1) {
                return $result->row(0) ->id;
            }else{
                return false;
            }
        }
        //Check user exsists for creating new users, Returns Boolean
        public function check_username_exsists($username){
            $query = $this->db->get_where('users', array('username' => $username));
            if (empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }
        //Check email exsists for creating new users, Returns Boolean
        public function check_email_exsists($email){
            $query = $this->db->get_where('users', array('email' => $email));
            if (empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }

		//retrieve profile information
		public function GetProfile($user_id){
			$this->db->from('users');
            $this->db->select('users.id, users.username, users.bio, users.name, users.postcode, users.email, users.password');
            $this->db->where('users.id', $user_id);
            $query = $this->db->get();
            return $query->result_array();
		}

		//update profile information
		public function updateProfile(){
			$data =array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'bio' => $this->input->post('bio'),
            'postcode'=> $this->input->post('postcode'),
			'username'=> $this->input->post('username')
			);
		//where id=db id, set(update) entry with new variables
        $this->db->where('id', $this->input->post('id'));
		$this->db->set($data);
        return $this->db->update('users', $data);
		}

		//update user with new password
		public function updatePassword($password){
			$data =array(
				'id' => $this->input->post('id'),
				'username'=> $this->session->userdata('username'),
				'password' => $password 
			);
		$this->db->where('id', $this->input->post('id'));
		$this->db->set($data);
		return $this->db->update('users', $data);			
		}


    }
