<?php
class blogs extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('blogs_model');
                $this->load->helper('url_helper');
                $this->load->library('session');

        }

        public function index()
        {
                $data['blogs'] = $this->blogs_model->get_blogs();
        $data['title'] = 'blogs archive';

        $this->load->view('templates/header', $data);
        $this->load->view('blogs/index', $data);
        $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
        $data['blogs_item'] = $this->blogs_model->get_blogs($slug);

        if (empty($data['blogs_item']))
        {
                show_404();
        }

        $data['title'] = $data['blogs_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('blogs/view', $data);
        $this->load->view('templates/footer');
        }
        public function create()
        {
         $this->load->helper('form');
         $this->load->library('form_validation');

        $data['title'] = 'Create a blogs item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE)
         {
         $this->load->view('templates/header', $data);
         $this->load->view('blogs/create');
         $this->load->view('templates/footer');

        }
        else
        {
        $this->blogs_model->set_blogs();
        $this->load->view('blogs/success');
        $this->session->set_flashdata('success','Blog is toegevoegd.');
        redirect("blogs"); }
    }

    public function edit($id){

            $id = $this->uri->segment(3);

            if (empty($id))
            {
                show_404();
            }

            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Edit a blog item';
            $data['blogs_item'] = $this->blogs_model->get_blogs_by_id($id);                                    

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('blogs/edit', $data);
                $this->load->view('templates/footer');

            }
            else
            {
                $this->blogs_model->set_blogs($id);
                //$this->load->view('news/success');
                redirect( base_url() . 'index.php/blogs');
            };
        }

        public function delete()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
                
        $blogs_item = $this->blogs_model->get_blogs_by_id($id);
        
        $this->blogs_model->delete_blogs($id);        
        redirect( base_url() . 'index.php/blogs');        
    }
}

