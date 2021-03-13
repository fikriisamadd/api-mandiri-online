<?php

// AMBIL API KEY DISINI : 
// https://api.xavi3r.id

$api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$nominal = isset($_GET['nominal']) ? $_GET['nominal'] : '';

function mutasi_mandiri($api_key, $nominal = 0) { // Untuk mengambil data mutasi OVO dengan filter jumlah nominal
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.xavi3r.id/apiv1/mutasi/mandiri");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,'api_key='.$api_key.'&quantity='.$nominal);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec ($ch);
  curl_close ($ch);
  return $result;
}

function info_mandiri($api_key) { // Untuk mengambil data saldo, nama rek, nomor ovo
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.xavi3r.id/apiv1/info");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,'bank=mandiri&api_key='.$api_key);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec ($ch);
  curl_close ($ch);
  return $result;
}

// CONTOH PENGGUNAAN GET SALDO REKENING

$get_info = info_mandiri($api_key);
$data = json_decode($get_info,true);

if ($data['result']==true) {
    $nama_rekening = $data['data']['nama'];
    $no_rekening = $data['data']['rekening'];
    $saldo_rekening = $data['data']['balance'];
    $info = $nama_rekening." - ".$no_rekening." - Rp. ". number_format($saldo_rekening);
} else {
    $info = $data['data'] . " " . $data['ip'];
}

?>

<h3>Info Rekening Mandiri</h3>
<?php echo $info; ?></p>
