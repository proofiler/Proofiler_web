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
		CREATE TABLE EMPLOYEES (
			email     VARCHAR(255) NOT NULL,
			firstName VARCHAR(255) NOT NULL,
			lastName  VARCHAR(255) NOT NULL,
			CONSTRAINT EMPLOYEES_primary_key PRIMARY KEY (email)
		);
		CREATE TABLE USBS (
			id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
			uuid          VARCHAR(255) NOT NULL,
			brand         VARCHAR(255) NOT NULL,
			registration  DATETIME     NOT NULL,
			emailEmployee VARCHAR(255) NOT NULL,
			CONSTRAINT USBS_primary_key PRIMARY KEY (id),
			CONSTRAINT USBS_foreign_key FOREIGN KEY (emailEmployee) REFERENCES EMPLOYEES(email) ON UPDATE CASCADE ON DELETE CASCADE
		);
		CREATE TABLE SCANS (
			id       INT UNSIGNED       NOT NULL AUTO_INCREMENT,
			dateScan DATETIME           NOT NULL,
			duration MEDIUMINT UNSIGNED NOT NULL,
			nbFiles  MEDIUMINT UNSIGNED NOT NULL,
			nbVirus  MEDIUMINT UNSIGNED NOT NULL,
			nbErrors MEDIUMINT UNSIGNED NOT NULL,
			idUSB    INT UNSIGNED       NOT NULL,
			CONSTRAINT SCANS_primary_key PRIMARY KEY (id),
			CONSTRAINT SCANS_foreign_key FOREIGN KEY (idUSB) REFERENCES USBS(id)  ON UPDATE CASCADE ON DELETE CASCADE
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
		INSERT INTO EXTENSIONS (name) VALUES ('txt');
		INSERT INTO EXTENSIONS (name) VALUES ('pdf');
		INSERT INTO EXTENSIONS (name) VALUES ('png');
		INSERT INTO ADMINS     (email, password) VALUES ('pr00filer@pr00filer.com', '".password_hash($password, PASSWORD_DEFAULT)."');
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                            VALUES ('mwalker@proofiler.com', 'Michael', 'Walker');
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                            VALUES ('alivingston@proofiler.com', 'Aubrey', 'Livingston');
		INSERT INTO EMPLOYEES  (email, firstName, lastName)                            VALUES ('sgray@proofiler.com', 'Samantha', 'Gray');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)               VALUES ('3d03ea66-7c32-47c9-981c-556a12d76968', 'Kingston', '2019-04-20 07:45:23', 'mwalker@proofiler.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)               VALUES ('8adb083e-c46e-4e27-bb53-2bb6ee40deaa', 'SanDisk', '2019-09-07 13:12:42', 'mwalker@proofiler.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)               VALUES ('8adb083e-c46e-4e27-bb53-2bb6ee40deaa', 'SanDisk', '2019-12-30 10:57:33', 'alivingston@proofiler.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)               VALUES ('fd04587f-4477-463c-ba42-e388afda75f4', 'Patriot', '2020-06-18 17:24:13', 'sgray@proofiler.com');
		INSERT INTO USBS       (uuid, brand, registration, emailEmployee)               VALUES ('3d03ea66-7c32-47c9-981c-556a12d76968', 'KingSton', '2020-11-01 15:30:02', 'sgray@proofiler.com');
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2019-04-30 12:10:15', 23, 30, 0, 0, 1);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2019-09-07 14:28:53', 3, 1, 0, 0, 2);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2019-10-09 09:36:18', 7, 5, 1, 0, 1);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2019-10-09 18:17:35', 89, 74, 4, 1, 2);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2020-01-29 11:52:26', 376, 52, 0, 18, 3);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2020-03-14 11:49:45', 134, 18, 6, 4, 1);
		INSERT INTO SCANS      (dateScan, duration, nbFiles, nbVirus, nbErrors, idUSB) VALUES ('2020-11-22 14:38:13', 32, 4, 0, 0, 5);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('CryptoLocker', 'b026324c6904b2a9cb4b88d6d61c81d1', 3);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('CryptoLocker', 'b026324c6904b2a9cb4b88d6d61c81d1', 4);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('ILOVEYOU', '26ab0db90d72e28ad0ba1e22ee510510', 4);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('Stuxnet', '6d7fce9fee471194aa8b5b6e47267f03', 4);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('Slammer', '48a24b70a0b376535542b996af517398' ,4);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('Storm Worm', '1dcca23355272056f04fe8bf20edfce0', 6);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('Slammer', '48a24b70a0b376535542b996af517398' ,6);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('ILOVEYOU', '26ab0db90d72e28ad0ba1e22ee510510', 6);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('MyDoom', '9ae0ea9e3c9c6e1b9b6252c8395efdc1', 6);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('Ryuk', '84bc3da1b3e33a18e8d5e1bdd7a18d7a', 6);
		INSERT INTO VIRUSES    (name, hash, idScan)                                    VALUES ('CryptoLocker', 'b026324c6904b2a9cb4b88d6d61c81d1', 6);
	";
	$conn->exec($sql);
	echo '[+] Data inserted successfully'."\n";

} catch(PDOException $e) {
	echo $sql."\n".$e->getMessage()."\n";
}

$conn = null;
