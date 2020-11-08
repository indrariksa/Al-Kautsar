<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_type_pemesanan extends CI_Model {

	public function view_type_pemesanan(){
		$query = $this->db
		->from('type_pemesanan')
		->get();
        return $query;
	}

	public function insert_type_pemesanan($data)
	{
		$this->db->insert('type_pemesanan',$data);
	}

	public function edit_data_type_pemesanan($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function update_data_type_pemesanan($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_type_pemesanan($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
}