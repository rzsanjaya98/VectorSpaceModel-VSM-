<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_kelola extends CI_Model{
	public function __construct(){
    	parent::__construct();
  	}

  	public function tampil_df(){
		$this->db->select('df');
		$this->db->from('tb_df');
		return $this->db->get()->result();
	}

  	public function tampil_term(){
		$this->db->select('term');
		$this->db->from('tb_term');
		return $this->db->get()->result();
	}

	public function tampil_data(){
		return $this->db->get('tb_artikel');
	}

	public function input_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function hapus_data($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function edit_data($where, $table){
		return $this->db->get_where($table, $where);
	}

	public function update_data($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function detail_data($id = NULL){
		$query = $this->db->get_where('tb_artikel', array('id' => $id))->row();
		return $query;
	}

	public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('tb_artikel');
		$this->db->like('judul', $keyword);
		$this->db->or_like('abstrak', $keyword);
		return $this->db->get()->result();
	}

	public function clearterm(   )
    {
        return $query = $this->db->query( " TRUNCATE tb_term " );
    }

    public function cleardf(   )
    {
        return $query = $this->db->query( " TRUNCATE tb_df " );
    }

}