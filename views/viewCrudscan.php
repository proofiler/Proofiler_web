<?php $this->_title = 'CRUD SCANS'; ?>

<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>CRUD SCANS</h1>
			<hr>
		</div>
	</div>
	<form action="" method="POST">
		<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
			<div class="col-lg-6 col-md-6">
				<h3>Create Scans</h3>
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
					<label>Duration : </label>
					<input class="form-control" type="number" name="duration" placeholder="Enter your new duration" required />
				</div>
				<div class="form-group">
					<label>Number of files : </label>
					<input class="form-control" type="number" name="nbFiles" placeholder="Enter your new number of files" required />
				</div>
				<div class="form-group">
					<label>Number of virus : </label>
					<input class="form-control" type="number" name="nbVirus" placeholder="Enter your new number of virus" required />
				</div>
				<div class="form-group">
					<label>Number of errors : </label>
					<input class="form-control" type="number" name="nbErrors" placeholder="Enter your new number of errors" required />
				</div>
				<div class="form-group">
					<label>USB's UUID : </label>
					<input class="form-control" type="text" name="uuidUsb" placeholder="Enter the USB's UUID" required />
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
			<h3>Update/Delete Scans</h3>
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
	<?php foreach ($scans as $scan): ?>
		<form action="" method="POST">
			<input  type="hidden" name="idNotModified" value="<?= $scan->getId() ?>">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label>ID : </label>
						<input class="form-control" type="number" name="idModified" placeholder="Enter your new ID" value="<?= $scan->getId() ?>" required />
					</div>
					<div class="form-group">
						<label>Date scan : </label>
						<input class="form-control" type="text" name="dateScan" placeholder="Enter your new date scan" value="<?= $scan->getDatescan() ?>" required />
					</div>
					<div class="form-group">
						<label>Duration : </label>
						<input class="form-control" type="number" name="duration" placeholder="Enter your new duration" value="<?= $scan->getDuration() ?>" required />
					</div>
					<div class="form-group">
						<label>Number of files : </label>
						<input class="form-control"type="number" name="nbFiles" placeholder="Enter your new number of files" value="<?= $scan->getNbfiles() ?>" required />
					</div>
					<div class="form-group">
						<label>Number of virus : </label>
						<input class="form-control" type="number" name="nbVirus" placeholder="Enter your new number of virus" value="<?= $scan->getNbvirus() ?>" required />
					</div>
					<div class="form-group">
						<label>Number of errors : </label>
						<input class="form-control" type="number" name="nbErrors" placeholder="Enter your new number of errors" value="<?= $scan->getNberros() ?>" required />
					</div>
					<div class="form-group">
						<label>USB's UUID : </label>
						<input class="form-control" type="text" name="uuidUsb" placeholder="Enter the USB's UUID" value="<?= $scan->getUuidUsb() ?>" required />
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
