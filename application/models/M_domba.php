<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_domba extends CI_Model {

	public function view_domba(){
		$query = $this->db
		->from('domba')
		->get();
        return $query;
	}

	public function get_domba()
	{
		$query = $this->db->get('domba');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function insert_domba($data)
	{
		$this->db->insert('domba',$data);
	}

	public function edit_data_domba($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_domba($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_domba($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}