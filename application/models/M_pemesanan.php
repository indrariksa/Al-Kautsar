<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemesanan extends CI_Model {

	public function insert_pemesanan($data)
	{
		$this->db->insert('pemesanan',$data);
	}

	public function insert_pembayaran($dt)
	{
		$this->db->insert('pembayaran_detail',$dt);
	}

	public function view_pemesanan(){
		$query = $this->db
		->from('pemesanan')
		// ->order_by('tgl_pemesanan', 'DESC')
		->order_by('tgl_pemesanan', 'DESC')
		->get();
        return $query;
	}

	public function view_p2hq(){
		$query = $this->db
		->from('pemesanan')
		// ->order_by('tgl_pemesanan', 'DESC')
		->order_by('tgl_pemesanan', 'DESC')
		->where('keterangan', 'p2hq')
		->get();
        return $query;
	}

	public function view_dtl_pemesanan($id){
		$query = $this->db
		// ->select('pemesanan.*, user.*')
		->from('pemesanan')
		->join('user','user.id_user=pemesanan.id_user_pesan','left')
		->join('type_pemesanan','type_pemesanan.id_type_pemesanan=pemesanan.type_pemesanan','left')
		->where('pemesanan.no_faktur', $id)
		->limit(1)
		->get();
        return $query->result();
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

	public function get_faktur($id){
		$query = $this->db
		->from('pemesanan')
		->where('pemesanan.no_faktur', $id)
		->get();
        return $query->row();
	}

	public function get_type_pemesanan()
	{
		$query = $this->db->get('type_pemesanan');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	// $sql = "SELECT A.*, B.*
 //                FROM delivery A 
 //                LEFT JOIN collecting B ON B.collecting_id = A.collecting_id
 //                WHERE delivery_id = '$id'";
 //        $row = $this->db->query($sql)->row();

	public function cekDomba(){
		$query = $this->db
		->from('hewan')
		->where('hewan_jenis', 'domba')
		->where('hewan_status', 1)
		->get();
        return $query;

	}

	public function cekSapi(){
		$query = $this->db
		->from('hewan')
		->where('hewan_jenis', 'sapi')
		->where('hewan_status', 1)
		->get();
        return $query;

	}

	public function cekType(){
		$query = $this->db
		->from('type_pemesanan')
		->get();
        return $query;

	}

	public function find_domba($id)
    {
        $query = $this->db->where('domba_id',$id)->limit(1)
        ->get('domba');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function find_sapi($id)
    {
        $query = $this->db->where('sapi_id',$id)->limit(1)
        ->get('sapi');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function get_hewan($hewan_id){
		$hsl=$this->db->query("SELECT * FROM hewan where hewan_id='$hewan_id'");
		return $hsl;
	}

	public function simpan_cart($nofak){
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'no_faktur_d' 	=>	$nofak,
				'hewan_id_d'	=>	$item['id'],
				// 'hewan_kelas_d'	=>	$item['name'],
				'hewan_harga_d'	=>	$item['amount'],
				'hewan_no_reg'	=>	$item['no_reg'],
				'hewan_jumlah'	=>	$item['qty'],
				'hewan_total'	=>	$item['subtotal']
			);
			$this->db->insert('pemesanan_detail',$data);
			// $this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	public function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,hewan_no_reg,tgl_pengiriman,keterangan,total,jml_bayar,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$nofak'");
		return $hsl;
	}

	public function cetak_fakturr(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,tgl_pengiriman,keterangan,total,jml_bayar,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$nofak' LIMIT 1");
		return $hsl->result();
	}

	public function cetak_faktur_2($id){
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,tgl_pengiriman,hewan_no_reg,keterangan,total,jml_bayar,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$id'");
		return $hsl;
	}

	public function cetak_faktur_3($id){
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,tgl_pengiriman,keterangan,total,jml_bayar,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$id' LIMIT 1");
		return $hsl->result();
	}

	public function hapus_pemesanan($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

}