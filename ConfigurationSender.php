<?php

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
	curl_setopt($request, CURLOPT_POSTFIELDS, 'data='.base64_encode($data));
	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
	curl_exec($request);
	curl_close ($request);
}