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
		<section class="mt-5 py-5">
			<?= $content ?>
		</section>
		<footer class="fixed-bottom py-1 text-light bg-secondary text-center font-weight-bold">
			<p class="my-1">© Pr00filer | 2020 - <?= date('Y') ?></p>
		</footer>
		<script src="/Proofiler_web/vendor/jquery/jquery.min.js"></script>
		<script src="/Proofiler_web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
