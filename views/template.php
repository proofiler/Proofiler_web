<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="/Proofiler_web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<title><?= $title ?></title>
	</head>
	<body>
		<header>
			<?= $menu ?>
		</header>
		<section>
			<?= $content ?>
		</section>
		<footer>
			<p>Pr00filer | 2020 - <?= date('Y') ?></p>
		</footer>
		<script src="/Proofiler_web/vendor/jquery/jquery.min.js"></script>
		<script src="/Proofiler_web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
