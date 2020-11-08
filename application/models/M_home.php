<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function hitungHewan(){  
	$this->db
	->select('hewan.hewan_id, count(hewan.hewan_id) as totalhw');
	$query = $this->db->get('hewan');
	if($query->num_rows()>0)
	{
	return $query->result();
	}
	}

	public function hitungPesanan(){  
	$this->db
	->select('pemesanan.no_faktur, count(pemesanan.no_faktur) as totalps');
	$query = $this->db->get('pemesanan');
	if($query->num_rows()>0)
	{
	return $query->result();
	}
	}

	public function hitungKiriman(){  
	$this->db
	->select('pengiriman.no_faktur_k, count(pengiriman.no_faktur_k) as totalkr');
	$query = $this->db->get('pengiriman');
	if($query->num_rows()>0)
	{
	return $query->result();
	}
	}

	public function hitungTransaksi(){  
	$this->db
	->select('pembayaran_detail.no_faktur, sum(pembayaran_detail.dibayar) as totalbayar');
	$query = $this->db->get('pembayaran_detail');
	if($query->num_rows()>0)
	{
	return $query->result();
	}
	}

}