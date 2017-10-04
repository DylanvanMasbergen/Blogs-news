<?php
class Blogs_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_blogs($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('blogs');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('blogs', array('slug' => $slug));
        return $query->row_array();
    }
    
    public function get_blogs_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('blogs');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('blogs', array('id' => $id));
        return $query->row_array();
    }
    
    public function set_blogs($id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );
        
        if ($id == 0) {
            return $this->db->insert('blogs', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('blogs', $data);
        }
    }
    
    public function delete_blogs($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('blogs');
    }
}