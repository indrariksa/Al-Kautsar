    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Al-Kautsar</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>


<?php
if($jml_hewan)
{
foreach ($jml_hewan as $hewan) 
{ 
?>
<?php
}
}
?>

<?php
if($jml_pesanan)
{
foreach ($jml_pesanan as $pesanan) 
{ 
?>
<?php
}
}
?>

<?php
if($jml_kiriman)
{
foreach ($jml_kiriman as $kiriman) 
{ 
?>
<?php
}
}
?>

<?php
if($jml_bayar)
{
foreach ($jml_bayar as $bayar) 
{ 
?>
<?php
}
}
?>

<?php
  $this->db->where('keterangan','p2hq');
  $this->db->from('pemesanan');
  $total_p2hq = $this->db->count_all_results();
?>

<?php
  $this->db->where('status_kirim','belum');
  $this->db->where('keterangan !=', 'ambil');
  $this->db->from('pemesanan');
  $total_belum_kirim = $this->db->count_all_results();
?>

<?php
  $this->db->where('sisa >', 0);
  $this->db->from('pemesanan');
  $total_belum_lunas = $this->db->count_all_results();
?>

<?php
  $this->db->where('sisa', 0);
  $this->db->from('pemesanan');
  $total_sudah_lunas = $this->db->count_all_results();
?>



      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-paw fa-3x"></i>
            <div class="info">
              <h4>Hewan</h4>
              <p><b><?php echo $hewan->totalhw;?> Ekor</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-shopping-bag fa-3x"></i>
            <div class="info">
              <h4>Pesanan</h4>
              <p><b><?php echo $pesanan->totalps;?> Pesanan</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-ticket fa-3x"></i>
            <div class="info">
              <h4>P2HQ</h4>
              <p><b><?php echo $total_p2hq;?> Transaksi</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-warning fa-3x"></i>
            <div class="info">
              <h4>Belum Dikirim</h4>
              <p><b><?php echo $total_belum_kirim;?> Transaksi</b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-truck fa-3x"></i>
            <div class="info">
              <h4>Sudah Dikirim</h4>
              <p><b><?php echo $kiriman->totalkr;?> Transaksi</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-window-close-o fa-3x"></i>
            <div class="info">
              <h4>Belum Lunas</h4>
              <p><b><?php echo $total_belum_lunas;?> Transaksi</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-check-square-o fa-3x"></i>
            <div class="info">
              <h4>Sudah Lunas</h4>
              <p><b><?php echo $total_sudah_lunas;?> Transaksi</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
            <div class="info">
              <h4>Total Transaksi</h4>
              <p><b>Rp <?php echo number_format($bayar->totalbayar,0,',','.') ?></b></p>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Penjualan Pertahun</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Hewan Kurban</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div>
      </div>
    </main>

<script type="text/javascript">
      var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56]
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
          }
        ]
      };
      var pdata = [
        {
          value: 5,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Sapi"
        },
        {
          value: 3,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Kambing"
        }
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>