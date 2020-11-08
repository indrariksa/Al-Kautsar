<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Pembayaran extends CI_Controller {
public function __construct(){
        parent::__construct();
        // if($_SESSION['level_id'] != 1)
        if(!$_SESSION['level_id'])
        {
            $this->session->set_flashdata('error',"Halaman tidak dapat diakses.");
            redirect('Login');
        }
        $this->load->model('M_pembayaran');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database();
    }
    public function index()
    {
        $DariTgl = $this->input->post('DariTgl');
        $SampaiTgl = $this->input->post('SampaiTgl');

        // $data['awal'] = $this->input->post('DariTgl');
        // $data['akhir'] = $this->input->post('SampaiTgl');
        $data['periode'] = $this->M_pembayaran->view_bayar($DariTgl,$SampaiTgl)->result();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pembayaran/v_pembayaran', $data);
    }

    public function detail_table($id){
        $getfaktur = $this->M_pembayaran->get_faktur($id);

        $data['Pemesanan']  = $this->M_pembayaran->dtl_pemesanan($id);
        $data['dtl_pesan']  = $this->M_pembayaran->dtl_pesan($id);
        $data['dtl_bayar']  = $this->M_pembayaran->dtl_bayar($id);
        $data['dtl_kirim']  = $this->M_pembayaran->dtl_kirim($id);
        $data['dtl_kirim2'] = $this->M_pembayaran->dtl_kirim2($id);
        $data['no_faktur']  = $getfaktur->no_faktur;
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pages/pembayaran/detail_pembayaran', $data);
    }

    // Export ke excel
    public function export()
    {
    $this->form_validation->set_rules('DariTgl','Dari Tanggal', 'required');
    $this->form_validation->set_rules('SampaiTgl','Sampai Tanggal', 'required');
    
    if ($this->form_validation->run() == FALSE) {
    $this->session->set_flashdata('duplikat','Tidak bisa ekspor data, mohon isi tanggal terlebih dahulu');
        redirect('Pembayaran');
    }else{

    $DariTgl = $this->input->post('DariTgl');
    $SampaiTgl = $this->input->post('SampaiTgl');

    //$trx = $this->M_reporttrx->get_excel()->result();
    $trx = $this->M_pembayaran->excel_exp($DariTgl,$SampaiTgl)->result();
    // $hasil = $trx->trx_id;
    // var_dump($hasil);
    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('Indra Riksa - YPBPI')
    ->setLastModifiedBy('Indra Riksa - YPBPI')
    ->setTitle('Laporan Pembayaran Transaksi AL-KAUTSAR')
    ->setSubject('Laporan Pembayaran AL-KAUTSAR')
    ->setDescription('Laporan AL-KAUTSAR Dari Tangal '.date('d-m-Y', strtotime($DariTgl)).' ~ '.date('d-m-Y', strtotime($SampaiTgl)))
    ->setKeywords('YPBPI')
    ->setCategory('Laporan Transaksi AL-KAUTSAR');

    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
    ->SetCellValue('A1', 'No Faktur')
    ->setCellValue('B1', 'Nama Pemesan')
    ->SetCellValue('C1', 'Telp Pemesan')
    ->SetCellValue('D1', 'Nama Penerima') 
    ->SetCellValue('E1', 'Telp Penerima')  
    ->SetCellValue('F1', 'Tanggal Pemesanan') 
    ->SetCellValue('G1', 'Jumlah Bayar') 
    ->SetCellValue('H1', 'Tanggal Pembayaran');

    // // Miscellaneous glyphs, UTF-8
    $i=2; foreach($trx as $trx) {

    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, $trx->no_faktur)
    // ->setCellValueExplicit('B'.$i, $trx->virtual_account_dtl, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)
    ->SetCellValue('B'.$i, $trx->nama_pemesan)
    ->SetCellValue('C'.$i, $trx->telp_pemesan)
    ->SetCellValue('D'.$i, $trx->nama_penerima)
    ->SetCellValue('E'.$i, $trx->telp_penerima)
    ->SetCellValue('F'.$i, $trx->tgl_pemesanan)
    ->SetCellValue('G'.$i, 'Rp '.$trx->dibayar)
    ->SetCellValue('H'.$i, $trx->tgl_pembayaran);
    // $hasil = $trx->trx_id;
    // var_dump($hasil);
    $i++;
    }

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25); // Set width kolom G
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25); // Set width kolom H

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Report '.date('d-m-Y', strtotime($DariTgl)).' ~ '.date('d-m-Y', strtotime($SampaiTgl)));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Report Pembayaran AL-KAUTSAR.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
    }
    }

}