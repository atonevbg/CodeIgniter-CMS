<?php

class Users_model extends CI_Model{
    
    public function validate_login() 
    { 
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        
        if($query->num_rows() == 1){
            return true;
        }
        
    }
    // add new user
    // to do : change md5 with security hashing algorithm(bcrypt)
    public function add_user() 
    {
        $user_data = array(
          'email' => $this->input->post('email'),  
          'password' => md5($this->input->post('password')) 
        );
        
        $query = $this->db->insert('users', $user_data);
        if($this->db->affected_rows() == 1){
            return true;
        } else{
            return false;
        }
       
    }
    
}