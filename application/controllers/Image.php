<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('Image_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
    }

    public function index() {
        $this->load->view('files/upload_form');
    }

    public function store() 
    {
        $this->form_validation->set_rules('name', 'Image Name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('files/upload_form');
        }
        else 
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 1024;
            // $config['max_width'] = 1500;
            // $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) 
            {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('files/upload_form', $error);
            } 
            else 
            {
                $upload_data = $this->upload->data();
                return $this->resizeImage($upload_data['file_name']);
                //echo $upload_data['file_name'];

                
                // $data['name'] = $this->input->post('name');
                
                // $data['file_name'] = $upload_data['file_name'];
                
            }


            //var_dump($data);
    
            //  $id = $this->Image_model->insert_image($data);

            //  redirect('image');        
             
        }
    }

    public function resizeImage()
    {
       
    echo $source_path = $upload_data['file_name'];
        //  $target_path =  $_SERVER['DOCUMENT_ROOT'] . '/WEBAPPS/CI_image_paginatin/uploads/thumbnai';

        // $config_manip = array(
        //     'image_library' => 'gd2',
        //     'source_image' => $source_path,
        //     'new_image' => $target_path,
        //     'maintain_ratio' => TRUE,
        //     'create_thumb' => TRUE,
        //     'thumb_maker' => '_thumb',
        //     'width' => 150,
        //     'height' => 150,
        //);

        $this->load->library('image_lib', $config_manip);

        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }

       //$this->image_lib->clear();
        
    }

    public function view_images()
    {
        $config = array();
        $config["base_url"] = base_url() . "index.php/image/view_images";
        $config["total_rows"] = $this->Image_model->get_count();
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['num_links'] = $config["total_rows"];
        $config['use_page_numbers'] = false;
		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //echo $page;

        $data["links"] = $this->pagination->create_links();

        $data['images'] = $this->Image_model->get_paginated_images($config["per_page"], $page);

         //$data['images'] = $this->Image_model->get_all_images();
        // var_dump($data);
        $this->load->view('files/upload_result', $data);
    }

}