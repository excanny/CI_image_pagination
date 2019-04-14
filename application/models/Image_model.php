<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model 
{

public function get_count()
{
    return $this->db->count_all('image_data');
}

public function get_paginated_images($limit, $start) 
{
    $this->db->limit($limit, $start);
    $query = $this->db->get('image_data');
    return $query->result();
}

 public function insert_image($data)
 {
    $this->db->insert('image_data', $data);
    return $this->db->insert_id();
 }

 //get images from database
 public function get_all_images()
 {
    $this->db->select('*');
    $this->db->order_by('id');
    $query = $this->db->get('image_data');
    return $query->result();
 }
}