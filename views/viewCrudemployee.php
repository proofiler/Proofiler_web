<?php $this->_title = 'CRUD EMPLOYEES'; ?>

<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<div class="col-lg-6 col-md-6">
			<h1>CRUD EMPLOYEES</h1>
			<hr>
		</div>
	</div>
	<form action="" method="POST">
		<div class="row text-center justify-content-lg-center justify-content-md-center mb-3">
			<div class="col-lg-6 col-md-6">
				<h3>Create Employees</h3>
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
					<label>Email : </label>
					<input class="form-control" type="email" name="email" placeholder="Enter your email" required />
				</div>
				<div class="form-group">
					<label>First name : </label>
					<input class="form-control" type="text" name="firstName" placeholder="Enter your first name" required />
				</div>
				<div class="form-group">
					<label>Last name : </label>
					<input class="form-control" type="text" name="lastName" placeholder="Confirm your last name" required />
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
			<h3>Update/Delete Employees</h3>
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
	<?php foreach ($employees as $employee): ?>
		<form action="" method="POST">
			<input type="hidden" name="emailNotModified" value="<?= $employee->getEmail() ?>">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label>Email : </label>
						<input class="form-control" type="email" name="emailModified" placeholder="Enter your new email" value="<?= $employee->getEmail() ?>" required />
					</div>
					<div class="form-group">
						<label>First name : </label>
						<input class="form-control" type="text" name="firstName" placeholder="Enter your new first name" value="<?= $employee->getFirstName() ?>" required />
					</div>
					<div class="form-group">
						<label>Last name : </label>
						<input class="form-control" type="text" name="lastName" placeholder="Enter your new last name" value="<?= $employee->getLastName() ?>" required />
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
