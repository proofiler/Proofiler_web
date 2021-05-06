<?php

$message = '';
$someDataScans = [];
$dataEmployee = [];

$conn = new PDO('mysql:host=localhost;dbname=Pr00filer;charset=utf8', 'root', 'Pr00filer');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$request = $conn->prepare('SELECT id, dateScan, nbVirus, uuidUsb FROM SCANS WHERE dateScan > (DATE_SUB(NOW(), INTERVAL 1 HOUR)) AND nbVirus > 0');
$request->execute();
while($data = $request->fetch(PDO::FETCH_ASSOC)) {
	$someDataScans[] = $data;
}
$request->closeCursor();

if ($someDataScans) {
	foreach ($someDataScans as $dataScan) {
		$someDataViruses = [];

		$dateScan  = explode(' ', $dataScan['dateScan']);

		$message .= 'On '.$dateScan[0].' at '.$dateScan[1].', a scan detected '.$dataScan['nbVirus'].' virus(es) on the USB key '.$dataScan['uuidUsb'].'.'."\r\n";

		$request = $conn->prepare('SELECT name, hash FROM VIRUSES WHERE idScan = '.$dataScan['id']);
		$request->execute();
		while($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$someDataViruses[] = $data;
		}
		$request->closeCursor();

		$message .= 'The detected virus(es) is/are the following :'."\r\n";

		foreach ($someDataViruses as $dataVirus) {
			$message .= "\t".'- '.$dataVirus['name'].' ('.$dataVirus['hash'].')'."\r\n";
		}

		$request = $conn->prepare('SELECT * FROM EMPLOYEES WHERE email = (SELECT emailEmployee FROM USBS WHERE uuid = "'.$dataScan['uuidUsb'].'")');
		$request->execute();
		if ($data = $request->fetch(PDO::FETCH_ASSOC)) {
			$dataEmployee = $data;
		}
		$request->closeCursor();

		$message .= 'This USB key is owned by '.ucfirst(strtolower($dataEmployee['firstName'])).' '.strtoupper($dataEmployee['lastName']).' ('.$dataEmployee['email'].').'."\r\n\r\n";
	}
} else {
	$message = 'No viruses have been detected in the last hour.';
}


$to_email = 'pr00filer@localhost';
$subject = 'Virus reporting : '.date("d-m-Y H:i:s");
$headers = 'From: root@localhost';

mail($to_email, $subject, $message, $headers);
