<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelunasan extends CI_Model {

	public function insert_pelunasan($data)
	{
		$this->db->insert('pembayaran_detail',$data);
	}

	public function cari($keyword, $conditions)
    {
        $this->db->like('no_faktur', $keyword, $conditions);
        return $this->db->get('pemesanan')->result();
    }

    public function dd_faktur()
	{
		$query = $this->db
		->where('sisa >', 0)
		->where('status_kirim', 'belum')
		->get('pemesanan');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function is_id_available($no_faktur)  
      {  
           $this->db
           ->where('no_faktur', $no_faktur)
           ->where('sisa <=', 0);   
           $query = $this->db->get("pemesanan");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  

     public function get_data($id){  
      $query = $this->db
		->from('pemesanan')
		->where('no_faktur', $id)
		->get();
        return $query->row();
	}

	public function view_pengiriman(){
		$query = $this->db
		->from('pengiriman')
		->join('pemesanan', 'pengiriman.no_faktur_k=pemesanan.no_faktur')
		->get();
        return $query;
	}

	public function get_faktur($id){
		$query = $this->db
		->from('pengiriman')
		->where('pengiriman.no_faktur_k', $id)
		->get();
        return $query->row();
	}

	public function view_dtl_pemesanan($id){
		$query = $this->db
		->from('pemesanan')
		->join('pengiriman', 'pengiriman.no_faktur_k=pemesanan.no_faktur')
		->join('pemesanan_detail', 'pemesanan_detail.no_faktur_d=pemesanan.no_faktur')
		->where('pemesanan.no_faktur', $id)
		->limit(1)
		->get();
        return $query->result();
	}

	public function dtl_pemesanan($id){
		$query = $this->db
		->from('pemesanan_detail')
		->join('pemesanan', 'pemesanan_detail.no_faktur_d=pemesanan.no_faktur')
		->join('pengiriman', 'pengiriman.no_faktur_k=pemesanan.no_faktur')
		->join('hewan', 'pemesanan_detail.hewan_id_d=hewan.hewan_id')
		->where('pemesanan.no_faktur', $id)
		->get();
        return $query->result();
	}

	public function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,tgl_pengiriman,jenis_pemesanan,keterangan,total,jml_bayar,sisa,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$nofak'");
		return $hsl;
	}

	public function cetak_faktur_2($id){
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,no_reg_hewan,tgl_pengiriman,jenis_pemesanan,keterangan,total,jml_bayar,sisa,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$id'");
		return $hsl;
	}

	public function cetak_faktur_3($id){
		$hsl=$this->db->query("SELECT no_faktur,DATE_FORMAT(tgl_pemesanan,'%d/%m/%Y %H:%i:%s') AS tgl_pemesanan,nama_pemesan,telp_pemesan,alamat_pemesan,tgl_pelunasan,tgl_pengiriman,jenis_pemesanan,keterangan,total,jml_bayar,sisa,hewan_id,hewan_kelas,hewan_harga,hewan_jumlah,hewan_total,hewan_jenis FROM pemesanan JOIN pemesanan_detail ON no_faktur=no_faktur_d JOIN hewan ON hewan_id=hewan_id_d WHERE no_faktur='$id' LIMIT 1");
		return $hsl->result();
	}

	public function hapus_pemesanan($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getLokasi($id){
		$this->db->from('pengiriman');
        $this->db->where('no_faktur_k',$id);
        $this->db->limit(1);
        $res = $this->db->get();
        if($res->num_rows() > 0){
            return $res->result()[0];
        }else{
            return false;
        }
    }

}