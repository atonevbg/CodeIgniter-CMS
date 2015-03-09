<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('is_logged_in')){
            redirect('pages', 'location');
        } else {
            $this->login();
        }
    }
    
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('header_view', $data);
        $this->load->view('login/login_view');
        $this->load->view('footer_view');
    }

    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('users');
    }
    
    public function signup() 
    {
        $data['title'] = 'Register';
        $this->load->view('header_view', $data);
        $this->load->view('login/signup_view');
        $this->load->view('footer_view');
    }
    
    public function login_validation()
    {

    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if($this->form_validation->run()){

        $this->load->model('users_model');

        if($this->users_model->validate_login()){
        $data = array(
            'email' => $this->input->post('email'),
            'is_logged_in' => 1
        );

        $this->session->set_userdata($data);
        redirect('pages');
        } else {
            // validation unsuccessfully
            $this->session->set_flashdata('errmsg', 'Incorect password/username');
            redirect('users', 'refresh');
        }
        } else {
            $this->index();
        }
    }
    
    public function signup_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|trim|matches[password]');
        
        $this->form_validation->set_message('is_unique', 'This email address already exists');
        
        if($this->form_validation->run()){
            
            $this->load->model('users_model');
            
            if($this->users_model->add_user()){
                $this->session->set_flashdata('success_reg', 'Registration successfully. Please login.');
                redirect('users', 'location');
            } else {
                $this->session->set_flashdata('error_add_user', 'Problem with registration. Please try again.');
                redirect('signup', 'refresh');
            }
        } else {
                $this->signup();
            }
        
    }
}