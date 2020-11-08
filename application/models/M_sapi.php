<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sapi extends CI_Model {

	public function view_sapi(){
		$query = $this->db
		->from('sapi')
		->get();
        return $query;
	}

	public function insert_sapi($data)
	{
		$this->db->insert('sapi',$data);
	}

	public function edit_data_sapi($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_sapi($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_sapi($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}