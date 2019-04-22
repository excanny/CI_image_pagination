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
		//$this->load->library('zebra_image');
		
    }

	public function index() 
	{
        $this->load->view('files/upload_form');
    }

    public function store() 
    {
		
			//$file_name = time() . $_FILES["userfile"]["name"];
			//$file_temp = $_FILES["userfile"]["tmp_name"];
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
                //echo $upload_data['file_name'];

                $data['file_name'] = $upload_data['file_name'];
				$file_temp = $upload_data['full_path'];
			

            //var_dump($file_temp);
    
				$id = $this->Image_model->insert_image($data);

				redirect('image');        
             
       
		
				$this->load->library('zebra_image');
														//100 X 100 Thumbnail
				// load the image manipulation class
				//require 'Zebra_Image.php';

				// create a new instance of the class
				$image = new Zebra_Image();

				// if you handle image uploads from users and you have enabled exif-support with --enable-exif
				// (or, on a Windows machine you have enabled php_mbstring.dll and php_exif.dll in php.ini)
				// set this property to TRUE in order to fix rotation so you always see images in correct position
				$image->auto_handle_exif_orientation = false;

				// indicate a source image (a GIF, PNG or JPEG file)
				$image->source_path = $file_temp;

				// indicate a target image
				// note that there's no extra property to set in order to specify the target
				// image's type -simply by writing '.jpg' as extension will instruct the script
				// to create a 'jpg' file
				$image->target_path = 'uploads/100/' . $data['file_name'];

				// since in this example we're going to have a jpeg file, let's set the output
				// image's quality
				$image->jpeg_quality = 100;

				// some additional properties that can be set
				// read about them in the documentation
				$image->preserve_aspect_ratio = true;
				$image->enlarge_smaller_images = true;
				$image->preserve_time = true;
				$image->handle_exif_orientation_tag = true;

				// resize the image to exactly 100x100 pixels by using the "crop from center" method
				// (read more in the overview section or in the documentation)
				//  and if there is an error, check what the error is about
				if (!$image->resize(100, 100, ZEBRA_IMAGE_CROP_CENTER)) 
				{

					// if there was an error, let's see what the error is about
					switch ($image->error) 
					{

						case 1:
							echo 'Source file could not be found!';
							break;
						case 2:
							echo 'Source file is not readable!';
							break;
						case 3:
							echo 'Could not write target file!';
							break;
						case 4:
							echo 'Unsupported source file format!';
							break;
						case 5:
							echo 'Unsupported target file format!';
							break;
						case 6:
							echo 'GD library version does not support target file format!';
							break;
						case 7:
							echo 'GD library is not installed!';
							break;
						case 8:
							echo '"chmod" command is disabled via configuration!';
							break;
						case 9:
							echo '"exif_read_data" function is not available';
							break;

					}

				// if no errors
				} //else echo 'Success!';
				
										//300 X 300 Thumbnail
				
				// create a new instance of the class
				$image = new Zebra_Image();

				// if you handle image uploads from users and you have enabled exif-support with --enable-exif
				// (or, on a Windows machine you have enabled php_mbstring.dll and php_exif.dll in php.ini)
				// set this property to TRUE in order to fix rotation so you always see images in correct position
				$image->auto_handle_exif_orientation = false;

				// indicate a source image (a GIF, PNG or JPEG file)
				$image->source_path = $file_temp;

				// indicate a target image
				// note that there's no extra property to set in order to specify the target
				// image's type -simply by writing '.jpg' as extension will instruct the script
				// to create a 'jpg' file
				$image->target_path = 'uploads/300/' . $data['file_name'];

				// since in this example we're going to have a jpeg file, let's set the output
				// image's quality
				$image->jpeg_quality = 100;

				// some additional properties that can be set
				// read about them in the documentation
				$image->preserve_aspect_ratio = true;
				$image->enlarge_smaller_images = true;
				$image->preserve_time = true;
				$image->handle_exif_orientation_tag = true;

				// resize the image to exactly 100x100 pixels by using the "crop from center" method
				// (read more in the overview section or in the documentation)
				//  and if there is an error, check what the error is about
				if (!$image->resize(300, 300, ZEBRA_IMAGE_CROP_CENTER)) 
				{

					// if there was an error, let's see what the error is about
					switch ($image->error) 
					{

						case 1:
							echo 'Source file could not be found!';
							break;
						case 2:
							echo 'Source file is not readable!';
							break;
						case 3:
							echo 'Could not write target file!';
							break;
						case 4:
							echo 'Unsupported source file format!';
							break;
						case 5:
							echo 'Unsupported target file format!';
							break;
						case 6:
							echo 'GD library version does not support target file format!';
							break;
						case 7:
							echo 'GD library is not installed!';
							break;
						case 8:
							echo '"chmod" command is disabled via configuration!';
							break;
						case 9:
							echo '"exif_read_data" function is not available';
							break;

					}

				// if no errors
				} //else echo 'Success!';

				
											//600 X 600 Thumbnail
				
				// create a new instance of the class
				$image = new Zebra_Image();

				// if you handle image uploads from users and you have enabled exif-support with --enable-exif
				// (or, on a Windows machine you have enabled php_mbstring.dll and php_exif.dll in php.ini)
				// set this property to TRUE in order to fix rotation so you always see images in correct position
				$image->auto_handle_exif_orientation = false;

				// indicate a source image (a GIF, PNG or JPEG file)
				$image->source_path = $file_temp;

				// indicate a target image
				// note that there's no extra property to set in order to specify the target
				// image's type -simply by writing '.jpg' as extension will instruct the script
				// to create a 'jpg' file
				$image->target_path = 'uploads/600/' . $data['file_name'];

				// since in this example we're going to have a jpeg file, let's set the output
				// image's quality
				$image->jpeg_quality = 100;

				// some additional properties that can be set
				// read about them in the documentation
				$image->preserve_aspect_ratio = true;
				$image->enlarge_smaller_images = true;
				$image->preserve_time = true;
				$image->handle_exif_orientation_tag = true;

				// resize the image to exactly 100x100 pixels by using the "crop from center" method
				// (read more in the overview section or in the documentation)
				//  and if there is an error, check what the error is about
				if (!$image->resize(600, 600, ZEBRA_IMAGE_CROP_CENTER)) {

					// if there was an error, let's see what the error is about
					switch ($image->error) {

						case 1:
							echo 'Source file could not be found!';
							break;
						case 2:
							echo 'Source file is not readable!';
							break;
						case 3:
							echo 'Could not write target file!';
							break;
						case 4:
							echo 'Unsupported source file format!';
							break;
						case 5:
							echo 'Unsupported target file format!';
							break;
						case 6:
							echo 'GD library version does not support target file format!';
							break;
						case 7:
							echo 'GD library is not installed!';
							break;
						case 8:
							echo '"chmod" command is disabled via configuration!';
							break;
						case 9:
							echo '"exif_read_data" function is not available';
							break;

					}

				// if no errors
				} //else echo 'Success!';
		}

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