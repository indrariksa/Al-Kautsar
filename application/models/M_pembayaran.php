<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

	public function view_bayar($DariTgl,$SampaiTgl){
		$query = $this->db
		->select('pemesanan.*, pengiriman.*, pembayaran_detail.*, user.*')
		->from('pembayaran_detail')
		->join('pemesanan','pemesanan.no_faktur=pembayaran_detail.no_faktur','left')
		// ->join('pemesanan_detail','pemesanan_detail.no_faktur_d=pemesanan.no_faktur','inner')
		->join('pengiriman','pengiriman.no_faktur_k=pemesanan.no_faktur','left')
		->join('user','user.id_user=pemesanan.id_user_pesan','user.id_user=pengiriman.id_user_kirim','user','user.id_user=pembayaran_detail.id_user_bayar','left')
    	->where('pembayaran_detail.tgl_pembayaran >=', date('Y-m-d 00:00:00', strtotime($DariTgl)))
    	->where('pembayaran_detail.tgl_pembayaran <=', date('Y-m-d 23:59:59', strtotime($SampaiTgl)))
    	->order_by('pembayaran_detail.tgl_pembayaran', 'DESC')
    	// ->order_by('pemesanan.status_kirim', 'ASC')
    	// ->group_by('pembayaran_detail.no_faktur')
		->get();
        return $query;
	}

	public function excel_exp($DariTgl,$SampaiTgl){
		$query = $this->db
		->select('pemesanan.*, pemesanan_detail.*, pengiriman.*, pembayaran_detail.*')
		->from('pembayaran_detail')
		->join('pemesanan','pemesanan.no_faktur=pembayaran_detail.no_faktur','left')
		->join('pemesanan_detail','pemesanan_detail.no_faktur_d=pemesanan.no_faktur','left')
		->join('pengiriman','pengiriman.no_faktur_k=pemesanan.no_faktur','left')
    	->where('pembayaran_detail.tgl_pembayaran >=', date('Y-m-d 00:00:00', strtotime($DariTgl)))
    	->where('pembayaran_detail.tgl_pembayaran <=', date('Y-m-d 23:59:59', strtotime($SampaiTgl)))
    	->order_by('pembayaran_detail.tgl_pembayaran', 'DESC')
    	// ->order_by('pemesanan.status_kirim', 'ASC')
    	->group_by('pembayaran_detail.no_faktur')
		->get();
        return $query;
	}

	public function get_faktur($id){
		$query = $this->db
		->from('pemesanan')
		->where('pemesanan.no_faktur', $id)
		->get();
        return $query->row();
	}

	public function dtl_pemesanan($id){
		$query = $this->db
		->from('pemesanan_detail')
		->join('pemesanan', 'pemesanan_detail.no_faktur_d=pemesanan.no_faktur')
		->join('hewan', 'pemesanan_detail.hewan_id_d=hewan.hewan_id')
		->where('pemesanan.no_faktur', $id)
		->get();
        return $query->result();
	}

	public function dtl_pesan($id){
		$query = $this->db
		->from('pemesanan')
		->join('user','user.id_user=pemesanan.id_user_pesan','left')
		->join('type_pemesanan','type_pemesanan.id_type_pemesanan=pemesanan.type_pemesanan','left')
		->where('pemesanan.no_faktur', $id)
		->limit(1)
		->get();
        return $query->result();
	}

	public function dtl_bayar($id){
    $query = $this->db
		->select('pemesanan.*, pembayaran_detail.*, user.*')
		->from('pembayaran_detail')
		->join('pemesanan','pemesanan.no_faktur=pembayaran_detail.no_faktur','left')
		->join('user','user.id_user=pembayaran_detail.id_user_bayar','left')
		->where('pembayaran_detail.no_faktur', $id)
    	->order_by('pembayaran_detail.tgl_pembayaran', 'DESC')
		->get();
    return $query->result();
    }

    public function dtl_kirim($id){
    $query = $this->db
		->select('pengiriman.*, pemesanan.*, user.*')
		->from('pengiriman')
		->join('pemesanan','pemesanan.no_faktur=pengiriman.no_faktur_k','left')
		->join('user','user.id_user=pengiriman.id_user_kirim','left')
		->where('pengiriman.no_faktur_k', $id)
		->get();
    return $query->result();
    }

    public function dtl_kirim2($id){
    $query = $this->db
		->from('pemesanan')
		->where('no_faktur', $id)
		->get();
    return $query->result();
    }

}