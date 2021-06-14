<?php

/**
 * AES-256-CBC string encryption
 * @param string $data 
 * @param string $passphrase 
 * @return string
 */
function my_encrypt($data, $passphrase='5cd10f8a394a241beae003415a1b4569672696468c5aec18f880d1eb2043ad0c') {
	$secret_key = hex2bin($passphrase);
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted_64 = openssl_encrypt($data, 'aes-256-cbc', $secret_key, 0, $iv);
	$iv_64 = base64_encode($iv);
	$json = new stdClass();
	$json->iv = $iv_64;
	$json->data = $encrypted_64;
	return base64_encode(json_encode($json));
}

$viruses = [];
$stations = [];
$extensions = [];

$conn = new PDO('mysql:host=localhost;dbname=Pr00filer;charset=utf8', 'root', 'Pr00filer');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$request = $conn->prepare('SELECT hash FROM VIRUSES');
$request->execute();
while($data = $request->fetchColumn()) {
	$viruses[] = $data;
}
$request->closeCursor();

$request = $conn->prepare('SELECT * FROM STATIONS');
$request->execute();
while($data = $request->fetch(PDO::FETCH_ASSOC)) {
	$stations[] = $data;
}
$request->closeCursor();

$request = $conn->prepare('SELECT * FROM EXTENSIONS');
$request->execute();
while($data = $request->fetchColumn()) {
	$extensions[] = $data;
}
$request->closeCursor();

$data = '"extensions": [';
for ($i=0; $i<count($extensions); $i++) {
	$data .= '"'.$extensions[$i].'", ';
}
$data = substr($data, 0, -2);
$data .= '], "viruses": [';
for ($i=0; $i<count($viruses); $i++) {
	$data .= '"'.$viruses[$i].'", ';
}
$data = substr($data, 0, -2);
$data .= ']}';

$ip = trim(shell_exec('ip addr show enp0s3 | awk \'$1 == "inet" {gsub(/\/.*$/, "", $2); print $2}\''));

foreach ($stations as $station) {
	$data = '{"hash": "'.$station['hash'].'", "ip": "'.$ip.'", '.$data;

	$request = curl_init();
	curl_setopt($request, CURLOPT_URL,'http://'.$station['ip'].':32777');
	curl_setopt($request, CURLOPT_POST, 1);
	curl_setopt($request, CURLOPT_POSTFIELDS, 'data='.my_encrypt($data));
	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
	curl_exec($request);
	curl_close ($request);
}
