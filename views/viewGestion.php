<?php $this->_title = 'GESTION'; ?>

<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>DASHBOARDING</h1>
			<hr>
		</div>
	</div>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
		<div class="col-lg-6 col-md-6">
			<h3>USB keys with the most viruses</h3>
			<hr>
		</div>
	</div>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<table class="col-lg-11 col-md-11 table table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">UUID USB</th>
					<th scope="col">Number of viruses</th>
					<th scope="col">USB key owner</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($stats as $stat): ?>
					<tr>
						<td scope="row"><?= $stat['uuidUsb']; ?></td>
						<td><?= $stat['nbVirusSum']; ?></td>
						<td><?= $stat['emailEmployee'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<section class="py-5 bg-light">
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>CONFIGURATION</h1>
			<hr>
		<?php
			if ($informationMessage) {
				echo '<div class="alert alert-success" role="alert">';
				echo $informationMessage;
				echo '</div>';
			}
		?>
		</div>
	</div>
	<form action="" method="POST">
		<div class="row justify-content-lg-center justify-content-md-center mb-5">
			<div class="col-lg-4 col-md-4">
				<button class="btn btn-block btn-info" type="submit" name="viruses">Send viruses report email</button>
			</div>
			<div class="col-lg-4 col-md-4">
				<button class="btn btn-block btn-info" type="submit" name="configuration">Send configuration data to Raspberry</button>
			</div>
		</div>
	</form>
</section>
