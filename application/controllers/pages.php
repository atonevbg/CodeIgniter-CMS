<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        if(!$this->session->userdata('is_logged_in')){
           redirect('users/login' , 'location');
        } 
    }

    public function index() 
    {
        $this->home();        
    }
    
    public function home()
    {
        $this->load->model('pages_model');
        $data['title'] = 'Pages';
        //get all pages
        $data['pages'] = $this->pages_model->get_pages();
        $this->load->view('header_view', $data);
        $this->load->view('pages/pages_view', $data);
        $this->load->view('footer_view');
    }
        
    public function create_page() 
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('page_title', 'Page title', 'trim|required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('page_description', 'Page description ', 'trim|required|xss_clean|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('page_keywords', 'Page keywords', 'trim|required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('page_slug', 'Page slug', 'trim|required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('page_content', 'Page contents', 'trim|required|xss_clean|min_length[4]|max_length[1000]');
        
        // success validation
        if($this->form_validation->run()){
            $this->load->model('pages_model');
            $this->pages_model->create_page();
            redirect(base_url());
        } else {
            $data['title'] = 'Create page';
            $this->load->view('header_view', $data);
            $this->load->view('pages/create_view');
            $this->load->view('footer_view');
        }
    }
        
    public function edit_page($id) 
    {
        $this->load->model('pages_model');
        $this->load->library('form_validation');
        $data['title'] = 'Edit page';
        $this->form_validation->set_rules('page_title', 'Page title', 'trim|required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('page_description', 'Page description ', 'trim|required|xss_clean|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('page_keywords', 'Page keywords', 'trim|required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('page_slug', 'Page slug', 'trim|required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('page_content[]', 'Page contents', 'trim|required|xss_clean|min_length[4]|max_length[1000]');
        
        // get data from db
        $data['page_item'] = $this->get_data_from_db($id);
        if(empty($data['page_item'])){
            show_404();
            exit;
        }
        // get value from post and insert new contents
        $submit = $this->input->post('submit', TRUE);
        if ($submit=="Add box") {
            $this->pages_model->insert_content($id);
            redirect('pages/edit_page/'.$id, 'location');
        }
        // success validation
        if($this->form_validation->run()){
            $this->pages_model->edit_page($id);
            redirect(base_url());
        } else {
            $this->load->view('header_view', $data);
            $this->load->view('pages/edit_view', $data);
            $this->load->view('footer_view');
        } 
    }
    //delete page with contents
    public function delete_page($id) 
    {
        $this->load->model('pages_model');
        $data['page_item'] = $this->pages_model->get_from_db($id);
        if($data['page_item']){
            $this->pages_model->delete_page($id);
            $this->pages_model->delete_contents($id);
            redirect('pages', 'location');
        }

    }
    // view page
    public function page_view($id)
    {
        $this->load->model('pages_model');
        $start = strrpos($id, '-');
        $page_id = substr($id, $start + 1);
        if($data['post'] = $this->get_data_from_db($page_id)){
        $this->load->view('header_view', $data);
        $this->load->view('pages/page_view', $data);
        $this->load->view('footer_view');   
        } else {
            show_404();
        }
    }
    //get pages and contents tables from db
    public function get_data_from_db($id)
    {
        $query = $this->pages_model->get_from_db($id);
        foreach($query->result() as $row) {
        $data['page_title'] = $row->page_title;
        $data['page_keywords'] = $row->page_keywords;
        $data['page_description'] = $row->page_description;
        $data['page_slug'] = $row->page_slug;
        $data['page_content_id'] = $row->pages_contents_id;
        $data['page_content'][$row->pages_contents_id] = $row->page_content;       
        }

        return $data;
    }
    // delete content
    public function delete_content($id)
    {
        $this->load->model('pages_model');
         $data['page_item'] = $this->pages_model->get_from_db($id);
        if($data['page_item']){
            $this->pages_model->delete_content($id);
            redirect('pages', 'location');
        }
    }




}