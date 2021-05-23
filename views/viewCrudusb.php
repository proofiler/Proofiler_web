<?php $this->_title = 'CRUD USBS'; ?>

<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>CRUD USBS</h1>
			<hr>
		</div>
	</div>
	<form action="" method="POST">
		<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
			<div class="col-lg-6 col-md-6">
				<h3>Create USBs</h3>
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
					<label>UUID : </label>
					<input class="form-control" type="text" name="uuid" placeholder="Enter your new UUID" required />
				</div>
				<div class="form-group">
					<label>Brand : </label>
					<input class="form-control" type="text" name="brand" placeholder="Enter your new brand" required />
				</div>
				<div class="form-group">
					<label>Employee's email : </label>
					<input class="form-control" type="email" name="emailEmployee" placeholder="Enter the employee's email" required />
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
				<h3>Update/Delete USBs</h3>
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
		<?php foreach ($usbs as $usb): ?>
		<form action="" method="POST">
			<input type="hidden" name="uuidNotModified" value="<?= $usb->getUuid() ?>">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label>UUID : </label>
						<input class="form-control" type="text" name="uuidModified" placeholder="Enter your new uuid" value="<?= $usb->getUuid() ?>" required />
					</div>
					<div class="form-group">
						<label>Brand : </label>
						<input class="form-control" type="text" name="brand" placeholder="Enter your new brand" value="<?= $usb->getBrand() ?>" required />
					</div>
					<div class="form-group">
						<label>Registration : </label>
						<input class="form-control" type="text" name="registration" placeholder="Enter your new registration" value="<?= $usb->getRegistration() ?>" required />
					</div>
					<div class="form-group">
						<label>Employee's email : </label>
						<input class="form-control" type="text" name="emailEmployee" placeholder="Enter your new employee's email" value="<?= $usb->getEmailEmployee() ?>" required />
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
