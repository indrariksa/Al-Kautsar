<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
public function __construct(){
		parent::__construct();
        // if($_SESSION['level_id'] != 1)
		if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Error');
        }
        $this->load->model('M_pemesanan');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		//START GENERATE NO FAKTUR
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $faktur = '';
        for ($i = 0; $i < 5; $i++) {
            $random = rand(0, strlen($alphabet)-1);
            $faktur .= $alphabet{$random};
        }
        //END GENERATE NO FAKTUR
        $get_ak = 'AK';
        $get_tgl = date('dmy');
        $garis = '-';

        $dt['get_faktur'] 	= $get_ak.$garis.$faktur.$get_tgl;

        $nofak = $this->input->post('no_faktur');
        $admin = $this->session->userdata('id_user');

  //       $dt['dd_sapi'] 		= $this->M_pemesanan->dd_sapi();
		// $dt['dd_domba'] 	= $this->M_pemesanan->dd_domba();
		$dt['domba'] 		        = $this->M_pemesanan->cekDomba()->result();
		$dt['sapi'] 		        = $this->M_pemesanan->cekSapi()->result();
        $dt['type_pemesanan']       = $this->M_pemesanan->cekType()->result();
        $dt['dd_type_pemesanan']   = $this->M_pemesanan->get_type_pemesanan();

		$cari_domba         = $this->M_pemesanan->find_domba($this->input->post('dommba_id'));
		$cari_sapi         	= $this->M_pemesanan->find_sapi($this->input->post('sapi_id'));

        $this->form_validation->set_rules('nama_pemesan','Nama Pemesan', 'trim');
        $this->form_validation->set_rules('alamat_pemesan','Alamat Pemesan', 'trim');
        $this->form_validation->set_rules('no_faktur','Nomor Faktur', 'is_unique[pemesanan.no_faktur]');

        $this->form_validation->set_message('is_unique', '%s sudah ada');

        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/add_pemesanan', $dt);
        }else{
        $data = array(
            'no_faktur'      	=> $this->input->post('no_faktur'),
            // 'no_reg_hewan'      => $this->input->post('no_reg_hewan'),
            'nama_pemesan'  	=> $this->input->post('nama_pemesan'),
            'telp_pemesan'     	=> $this->input->post('telp_pemesan'),
            'alamat_pemesan'    => $this->input->post('alamat_pemesan'),
            'tgl_pemesanan'     => date("Y-m-d  H:i:s"),
            'tgl_pelunasan'     => $this->input->post('tgl_pelunasan'),
            'tgl_pengiriman'    => $this->input->post('tgl_pengiriman'),
            // 'jenis_pemesanan'   => $this->input->post('jenis_pemesanan'),
            'keterangan'	    => $this->input->post('keterangan'),
            'type_pemesanan'=> $this->input->post('id_type_pemesanan'),
            'total'             => $this->input->post('total'),
            'jml_bayar'         => $this->input->post('jml_bayar'),
            'sisa'              => $this->input->post('total')-$this->input->post('jml_bayar'),
            // 'status_kirim'      => $this->input->post('keterangan'),
            'id_user_pesan'     => $admin
        );
        $dt = array(
            'no_faktur'         => $this->input->post('no_faktur'),
            'dibayar'           => $this->input->post('jml_bayar'),
            'tgl_pembayaran'    => date("Y-m-d  H:i:s"),
            'id_user_bayar'     => $admin
        );
        // var_dump($data);
        $this->session->set_userdata('nofak',$nofak);
        $this->M_pemesanan->insert_pemesanan($data);
        $this->M_pemesanan->insert_pembayaran($dt);

        $this->M_pemesanan->simpan_cart($nofak);
        $this->cart->destroy();

        $this->session->set_flashdata('success','Data Berhasil ditambah');
        
        redirect('Pemesanan/done');
    }
	}

    public function view_table(){
        $data['Pemesanan'] = $this->M_pemesanan->view_pemesanan()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_pemesanan', $data);
    }

    public function view_table_p2hq(){
        $data['Pemesanan'] = $this->M_pemesanan->view_p2hq()->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_p2hq', $data);
    }

    public function detail_table($id){
        $getfaktur = $this->M_pemesanan->get_faktur($id);

        $data['Pemesanan']  = $this->M_pemesanan->dtl_pemesanan($id);
        $data['Dtl']        = $this->M_pemesanan->view_dtl_pemesanan($id);
        $data['dtl_bayar']  = $this->M_pemesanan->dtl_bayar($id);
        $data['no_faktur']  = $getfaktur->no_faktur;
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/detail_pemesanan', $data);
    }

    public function get_hewan(){
        $hewan_id=$this->input->post('hewan_id');
        $x['hewan']=$this->M_pemesanan->get_hewan($hewan_id);
        $this->load->view('pages/pemesanan/v_detail_hewan',$x);
    }

    public function add_to_cart(){
        $hewan_id=$this->input->post('hewan_id');
        $hewan=$this->M_pemesanan->get_hewan($hewan_id);
        $i=$hewan->row_array();
        $data = array(
           'id'       => $i['hewan_id'],
           'name'     => $i['hewan_kelas'],
           'deskripsi'   => $i['hewan_deskripsi'],
           'price'    => str_replace(",", "", $this->input->post('hewan_harga')),
           'no_reg'     => $this->input->post('hewan_no_reg'),
           'qty'      => $this->input->post('qty'),
           'amount'   => str_replace(",", "", $this->input->post('hewan_harga'))
        );
    // if(!empty($this->cart->total_items())){
    //     foreach ($this->cart->contents() as $items){
    //         $id=$items['id'];
    //         $qtylama=$items['qty'];
    //         $rowid=$items['rowid'];
    //         $harga=$this->input->post('hewan_harga');
    //         $kobar=$this->input->post('hewan_id');
    //         $qty=$this->input->post('qty');
    //         if($id==$kobar){
    //             $up=array(
    //                 'rowid'=> $rowid,
    //                 'qty'=>$qtylama+$qty
    //                 );
    //             $this->cart->update($up);
    //         }else{
    //             $this->cart->insert($data);
    //         }
    //     }
    // }else{
        $this->cart->insert($data);
    // }
        redirect('Pemesanan');
    }

    public function done(){
        $x['data']=$this->M_pemesanan->cetak_faktur();
        $x['data2']=$this->M_pemesanan->cetak_fakturr();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_success_input');
    }


    public function remove(){
        $row_id=$this->uri->segment(3);
        $this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
        redirect('Pemesanan');
    }

    public function cetak_faktur_pemesanan(){
        $x['data']=$this->M_pemesanan->cetak_faktur();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_faktur_pemesanan',$x);
        //$this->session->unset_userdata('nofak');
    }

    public function cetak_pemesanan($id){
        $x['data']=$this->M_pemesanan->cetak_faktur_2($id);
        $x['data2']=$this->M_pemesanan->cetak_faktur_3($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_faktur_pemesanan2',$x);
        //$this->session->unset_userdata('nofak');
    }

    public function cetak_pemesanan2(){
        $x['data']=$this->M_pemesanan->cetak_faktur();
        $x['data2']=$this->M_pemesanan->cetak_fakturr();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pemesanan/v_faktur_pemesanan2',$x);
        //$this->session->unset_userdata('nofak');
    }

    public function delete_pemesanan($pemesanan){
        $where = array('no_faktur' => $pemesanan);

        $this->M_pemesanan->hapus_pemesanan($where,'pemesanan');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Pemesanan/view_table');
    }

    public function delete_detail_pemesanan($pemesanan){
        $where = array('no_faktur_d' => $pemesanan);

        $this->M_pemesanan->hapus_pemesanan($where,'pemesanan_detail');
        $this->session->set_flashdata('success','Data Berhasil dihapus');
        redirect('Pemesanan/view_table');
    }

}