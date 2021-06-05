<?php

$password = 'Pr00filer';

try {
	$conn = new PDO('mysql:host=localhost', 'root', 'Pr00filer');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = '
		DROP DATABASE IF EXISTS Pr00filer;
		CREATE DATABASE Pr00filer CHARACTER SET utf8 COLLATE utf8_unicode_ci;
	';
	$conn->exec($sql);
	echo '[+] Database created successfully'."\n";

	$conn = new PDO('mysql:host=localhost;dbname=Pr00filer', 'root', 'Pr00filer');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = '
		CREATE TABLE EXTENSIONS (
			name VARCHAR(255) NOT NULL,
			CONSTRAINT EXTENSIONS_primary_key PRIMARY KEY (name)

		);
		CREATE TABLE ADMINS (
			email    VARCHAR(255) NOT NULL,
			password VARCHAR(255) NOT NULL,
			CONSTRAINT USERS_primary_key PRIMARY KEY (email)
		);
		CREATE TABLE STATIONS(
			ip VARCHAR(255) NOT NULL,
			hash VARCHAR(255) NOT NULL,
			CONSTRAINT STATIONS_primary_key PRIMARY KEY (ip)
		);
		CREATE TABLE EMPLOYEES (
			email     VARCHAR(255) NOT NULL,
			firstName VARCHAR(255) NOT NULL,
			lastName  VARCHAR(255) NOT NULL,
			CONSTRAINT EMPLOYEES_primary_key PRIMARY KEY (email)
		);
		CREATE TABLE USBS (
			uuid          VARCHAR(255) NOT NULL,
			brand         VARCHAR(255) NOT NULL,
			registration  DATETIME     NOT NULL,
			emailEmployee VARCHAR(255) NOT NULL,
			CONSTRAINT USBS_primary_key PRIMARY KEY (uuid),
			CONSTRAINT USBS_foreign_key FOREIGN KEY (emailEmployee) REFERENCES EMPLOYEES(email) ON UPDATE CASCADE ON DELETE CASCADE
		);
		CREATE TABLE SCANS (
			id       INT UNSIGNED       NOT NULL AUTO_INCREMENT,
			dateScan DATETIME           NOT NULL,
			duration MEDIUMINT UNSIGNED NOT NULL,
			nbFiles  MEDIUMINT UNSIGNED NOT NULL,
			nbVirus  MEDIUMINT UNSIGNED NOT NULL,
			nbErrors MEDIUMINT UNSIGNED NOT NULL,
			uuidUsb  VARCHAR(255)       NOT NULL,
			CONSTRAINT SCANS_primary_key PRIMARY KEY (id),
			CONSTRAINT SCANS_foreign_key FOREIGN KEY (uuidUsb) REFERENCES USBS(uuid)  ON UPDATE CASCADE ON DELETE CASCADE
		);
		CREATE TABLE VIRUSES (
			id     MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			name   VARCHAR(255)       NOT NULL,
			hash   VARCHAR(255)       NOT NULL,
			idScan INT UNSIGNED       NOT NULL,
			CONSTRAINT VIRUSES_primary_key PRIMARY KEY (id),
			CONSTRAINT VIRUSES_foreign_key FOREIGN KEY (idScan) REFERENCES SCANS(id)  ON UPDATE CASCADE ON DELETE CASCADE
		);
	';
	$conn->exec($sql);
	echo '[+] Tables created successfully'."\n";

	$sql = "
		INSERT INTO EXTENSIONS (name)                                                    VALUES ('exe');
		INSERT INTO EXTENSIONS (name)                                                    VALUES ('ps1');
		INSERT INTO ADMINS     (email, password)                                         VALUES ('pr00filer@pr00filer.com', '".password_hash($password, PASSWORD_DEFAULT)."');
		INSERT INTO ADMINS     (email, password)                                         VALUES ('raspberry@pr00filer.com', '".password_hash($password, PASSWORD_DEFAULT)."');
		INSERT INTO STATIONS   (ip, hash)                                                SELECT '91.167.152.204', HEX(SHA2(CONCAT(NOW(), RAND(), UUID()), 256));
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                              VALUES ('mwalker@pr00filer.com', 'Michael', 'Walker');
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                              VALUES ('alivingston@pr00filer.com', 'Aubrey', 'Livingston');
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                              VALUES ('sgray@pr00filer.com', 'Samantha', 'Gray');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)                VALUES ('D82E-39A1', 'Kingston', '2019-04-20 07:45:23', 'mwalker@pr00filer.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)                VALUES ('3ARV-F24S', 'SanDisk', '2019-09-07 13:12:42', 'alivingston@pr00filer.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)                VALUES ('G6E3-EJRD', 'Patriot', '2020-06-18 17:24:13', 'sgray@pr00filer.com');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2019-04-30 12:10:15', 23, 30, 0, 0, 'D82E-39A1');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2019-09-07 14:28:53', 3, 1, 0, 0, '3ARV-F24S');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2019-10-09 09:36:18', 7, 5, 1, 0, 'D82E-39A1');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2019-10-09 18:17:35', 89, 74, 0, 1, 'G6E3-EJRD');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2020-01-29 11:52:26', 376, 52, 0, 18, '3ARV-F24S');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, uuidUsb) VALUES ('2020-03-14 11:49:45', 134, 18, 0, 4, '3ARV-F24S');
		INSERT INTO VIRUSES    (name, hash, idScan)                                      VALUES ('EICAR', '131f95c51cc819465fa1797f6ccacf9d494aaaff46fa3eac73ae63ffbdfd8267', 3);
	";
	$conn->exec($sql);
	echo '[+] Data inserted successfully'."\n";

} catch(PDOException $e) {
	echo $sql."\n".$e->getMessage()."\n";
}

$conn = null;
