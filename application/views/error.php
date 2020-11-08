<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>404 Error</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/error/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>4<span></span>4</h1>
			</div>
			<h2>Oops! Page Tidak Dapat Ditemukan</h2>
			<p>SEPERTINYA ANDA BERUSAHA MENCARI HALAMAN INI</p>
			<?php
                if($this->session->userdata('level_id')){ ?>
                <a href="javascript:history.back()" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Kembali</a> </div>
                <?php
                }else{ ?>
                <a href="<?php echo base_url('Login')?>" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Kembali</a> </div>
                <?php
                } ?>
			<!-- <a href="#">Kembali</a> -->
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
