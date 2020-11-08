<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_level extends CI_Model {

	public function view_user_level(){
		$query = $this->db
		->from('user_level')
		->get();
        return $query;
	}

	public function insert_user_level($data)
	{
		$this->db->insert('user_level',$data);
	}

	public function edit_data_user_level($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_user_level($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_user_level($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}