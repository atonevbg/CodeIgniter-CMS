<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model{
    
    public function get_pages()
    {
        $pages = $this->db->get('pages')->result_array();
        return $pages;
    }
    
    public function create_page() 
    {
        $this->db->trans_start();
        $pages_data = array(
          'page_title' => $this->input->post('page_title'),  
          'page_keywords' => $this->input->post('page_keywords'), 
          'page_description' => $this->input->post('page_description'),
          'page_slug' => $this->input->post('page_slug')
        );
        $query = $this->db->insert('pages', $pages_data);
        $id_page = $this->db->insert_id(); 
        $pages_contents = array(
            'page_id' => $id_page,
            'page_content' => $this->input->post('page_content')
        );
        $query = $this->db->insert('contents', $pages_contents);
        
        $this->db->trans_complete(); 
    }

    public function insert_content($id) 
    {
        $pages_contents = array(
            'page_id' => $id,
            'page_content' => $this->input->post('content')
        );
        $query = $this->db->insert('contents', $pages_contents); 
    }
    
    public function edit_page($id)
    {
        $this->db->trans_start();
        $pages_data = array(
          'page_title' => $this->input->post('page_title'),  
          'page_keywords' => $this->input->post('page_keywords'), 
          'page_description' => $this->input->post('page_description'),
          'page_slug' => $this->input->post('page_slug')
        );
        $this->db->where('page_id', $id);
        $query = $this->db->update('pages', $pages_data);
        foreach ($this->input->post('page_content') as $k => $value) {
        $pages_contents = array(
            'page_content' => $value
        );
        $this->db->where('pages_contents_id', $k);
        $this->db->where('page_id', $id);
        $query = $this->db->update('contents', $pages_contents);
        }
        $this->db->trans_complete(); 
    }
    
    public function delete_page($id)
    {
        $delete_page = array(
            'page_id' => $id
        );
        $this->db->delete('pages', $delete_page); 
    }
    
    public function delete_content($id)
    {
        $delete_content = array(
            'pages_contents_id' => $id
        );
        $this->db->delete('contents', $delete_content); 
    }
    public function delete_contents($id)
    {
        $delete_contents = array(
            'page_id' => $id
        );
        $this->db->delete('contents', $delete_contents); 
    }
    
    public function get_from_db($id) 
    {
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->join('contents', 'pages.page_id = contents.page_id', 'left');
        $this->db->where('pages.page_id', $id);
        $query = $this->db->get();
        return $query;;
    }

}