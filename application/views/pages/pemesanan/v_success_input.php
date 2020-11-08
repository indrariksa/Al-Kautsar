<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Pemesanan Hewan Kurban</h1>
          <p><?php
        $success = $this->session->flashdata('success');
        if ($success) {
            echo '<div class="alert alert-success text-center"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> '.$success.'</div>';
        } ?>
        <p>
        <a class="btn btn-info" href="<?php echo base_url().'Pemesanan/cetak_pemesanan2'?>" target="_blank"><span class="fa fa-print"></span> Cetak</a></p>
        <br />
        <a class="btn btn-danger" href="<?php echo base_url().'Pemesanan/view_table'?>" target=""><span class="fa fa-close"></span> Kembali</a></p>
        </div>
      </div>