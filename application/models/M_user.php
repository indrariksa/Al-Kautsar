<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function view_user(){
		$query = $this->db
		->from('user')
		->join('user_level', 'user_level.level_id=user.level_id')
		->get();
        return $query;
	}

	public function get_user_lvl()
	{
		$query = $this->db->get('user_level');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function insert_user($data)
	{
		$this->db->insert('user',$data);
	}

	public function edit_data_user($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_user($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_user($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}