<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once __DIR__ . "/prosesaes.php";

class Aess extends CI_Controller{

	public function __construct(){
        parent::__construct();       
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index(){

	$nama = "INDRA";
    $z = "abcdefghijuklmno0123456789012345";// key
	$aes = new Aes($z);
	$enkrip=$aes->encrypt($nama);
	echo "\n\n Hasil Enkrip:\n" .($enkrip) . "\n";
	$decrypted = $aes->decrypt($enkrip);

	echo "\n\n Hasil Dekrip:\n". $decrypted."\n";
	}

	public function url(){
	$trx = "INV-SPP-1184047-1-0120";
	$va = "9884520201184047";
	$tgl = "16-08-2020";
	$nama = $trx.';'.$va.';'.$tgl;
	$enc  = encrypt_url($nama);
	$url = "https://iteung.ypbpi.or.id/$enc/callback/api/va";
	echo "\n\n Hasil Enkrip:\n" .($url) . "\n";

	$dec = decrypt_url($enc);
	echo "\n\n Hasil Dekrip:\n". $dec."\n";
	}

	public function simple(){
		$simple_string = "INV-SPP-1184047-1-0120;9884520201184047;16-08-2020";
		$ciphering = "AES=256-CBC";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$key = "irc214crotwekwek";
		$iv = "tik313crotwekwek";
		$encryption = openssl_encrypt($simple_string, $ciphering, $key, $options = 0, $iv);
		echo "Encrypted String: " . base64_encode($encryption) . "\n";
	}

	public function iteung(){
		$data_iteung = array(
			'trx_id' => $data_asli['trx_id'], 
			'virtual_account' => $data_asli['virtual_account'],
			'customer_name' => $data_asli['customer_name'],
			'trx_amount' => $data_asli['trx_amount'],
			'payment_amount' => $data_asli['payment_amount'],
			'cumulative_payment_amount' => $data_asli['cumulative_payment_amount'],
			'payment_ntb' => $data_asli['payment_ntb'],
			'datetime_payment' => $data_asli['datetime_payment'],
			'datetime_payment_iso8601' => $data_asli['datetime_payment_iso8601'],
		); 
        $string = $data_asli['trx_id'].';'.$data_asli['virtual_account'].';'.$data_asli['datetime_payment'];
		$enc  = encrypt_url($string);

        $url = "https://iteung.ypbpi.or.id/$enc/callback/api/va";

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_iteung);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
	}

	public function iteung2(){
		$data_iteung = array(
			'trx_id' => $data_asli['trx_id'], 
			'virtual_account' => $data_asli['virtual_account'],
			'customer_name' => $data_asli['customer_name'],
			'trx_amount' => $data_asli['trx_amount'],
			'payment_amount' => $data_asli['payment_amount'],
			'cumulative_payment_amount' => $data_asli['cumulative_payment_amount'],
			'payment_ntb' => $data_asli['payment_ntb'],
			'datetime_payment' => $data_asli['datetime_payment'],
			'datetime_payment_iso8601' => $data_asli['datetime_payment_iso8601'],
		); 
        $string = $data_asli['trx_id'].';'.$data_asli['virtual_account'].';'.$data_asli['datetime_payment'];
		$enc  = encrypt_url($string);

        $url = "https://iteung.ypbpi.or.id/$enc/callback/api/va";

		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded",
		        'method'  => 'POST',
		        'content' => http_build_query($data_iteung)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { /* Handle error */ }
	}
}