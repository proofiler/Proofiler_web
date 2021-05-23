<?php $this->_title = 'CRUD VIRUSES'; ?>

<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>CRUD VIRUSES</h1>
			<hr>
		</div>
	</div>
	<form action="" method="POST">
		<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
			<div class="col-lg-6 col-md-6">
				<h3>Create Viruses</h3>
				<hr>
			</div>
		</div>
		<div class="row justify-content-lg-center justify-content-md-center">
			<div class="col-lg-6 col-md-6">
				<?php
					if ($errorMessageCreate) {
						echo '<div class="alert alert-danger" role="alert">';
						echo $errorMessageCreate;
						echo '</div>';
					}
					if ($informationMessageCreate) {
						echo '<div class="alert alert-success" role="alert">';
						echo $informationMessageCreate;
						echo '</div>';
					}
				?>
				<div class="form-group">
					<label>Name : </label>
					<input class="form-control" type="text" name="name" placeholder="Enter your new name" required />
				</div>
				<div class="form-group">
					<label>Hash : </label>
					<input class="form-control" type="text" name="hash" placeholder="Enter your new hash" required />
				</div>
				<div class="form-group">
					<label>Scan's ID : </label>
					<input class="form-control" type="number" name="idScan" placeholder="Enter the scan's ID" required />
				</div>
			</div>
		</div>
		<div class="row justify-content-lg-center justify-content-md-center mb-5">
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<button class="btn btn-block btn-success" type="submit" name="add">Add</button>
				</div>
			</div>
		</div>
	</form>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
		<div class="col-lg-6 col-md-6">
			<h3>Update/Delete Viruses</h3>
			<hr>
		</div>
	</div>
	<?php
		if ($errorMessageOthers) {
			echo '<div class="row justify-content-lg-center justify-content-md-center">';
			echo '<div class="col-lg-6 col-md-6">';
			echo '<div class="alert alert-danger" role="alert">';
			echo $errorMessageOthers;
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		if ($informationMessageOthers) {
			echo '<div class="row justify-content-lg-center justify-content-md-center">';
			echo '<div class="col-lg-6 col-md-6">';
			echo '<div class="alert alert-success" role="alert">';
			echo $informationMessageOthers;
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	?>
	<?php foreach ($viruses as $virus): ?>
		<form action="" method="POST">
			<input type="hidden" name="idNotModified" value="<?= $virus->getId() ?>">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label>ID : </label>
						<input class="form-control" type="number" name="idModified" placeholder="Enter your new ID" value="<?= $virus->getId() ?>" required />
					</div>
					<div class="form-group">
						<label>Name : </label>
						<input class="form-control" type="text" name="name" placeholder="Enter your new name" value="<?= $virus->getName() ?>" required />
					</div>
					<div class="form-group">
						<label>Hash : </label>
						<input class="form-control" type="text" name="hash" placeholder="Enter your new hash" value="<?= $virus->getHash() ?>" required />
					</div>
					<div class="form-group">
						<label>Scan's ID : </label>
						<input class="form-control" type="text" name="idScan" placeholder="Enter your new scan's ID" value="<?= $virus->getIdScan() ?>" required />
					</div>
				</div>
			</div>
			<div class="row justify-content-lg-center justify-content-md-center mb-5">
				<div class="col-lg-2 col-md-2">
					<button class="btn btn-block btn-warning" type="submit" name="update">Update</button>
				</div>
				<div class="col-lg-2 col-md-2">
					<button class="btn btn-block btn-danger" type="submit" name="delete">Delete</button>
				</div>
				<div class="col-lg-2 col-md-2">
					<button class="btn btn-block btn-secondary" type="reset">Reset</button>
				</div>
			</div>
		</form>
	<?php endforeach; ?>
</section>
