<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hewan extends CI_Model {

	public function view_hewan(){
		$query = $this->db
		->from('hewan')
		->get();
        return $query;
	}

	public function get_jenis_hewan()
	{
		$query = $this->db->get('hewan');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function insert_hewan($data)
	{
		$this->db->insert('hewan',$data);
	}

	public function edit_data_hewan($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_hewan($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_hewan($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}