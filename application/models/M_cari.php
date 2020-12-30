<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_cari extends CI_Model{
	public function __construct(){
    	parent::__construct();
  	}

	public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('tb_artikel');
		$this->db->like('judul', $keyword);
		$this->db->or_like('abstrak', $keyword);
		return $this->db->get()->result();
	}

	// public function get_textprepro(){
	// 	$this->db->select('id');
	// 	$this->db->select('textpreprocessing');
	// 	$this->db->from('tb_artikel');
	// 	return $this->db->get()->result();
	// }

}