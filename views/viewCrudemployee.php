<?php $this->_title = 'CRUD Employees'; ?>

<section>
	<fieldset>
		<legend>CRUD Employees</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create Employees</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>Email : </label><input type="email" name="email" placeholder="Enter your email" required /><br>
				<label>First name : </label><input type="text" name="firstName" placeholder="Enter your first name" required /><br>
				<label>Last name : </label><input type="text" name="lastName" placeholder="Confirm your last name" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete Employees</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($employees as $employee): ?>
					<form action="" method="POST">
						<input type="hidden" name="emailNotModified" value="<?= $employee->getEmail() ?>">
						<label>Email : </label><input type="email" name="emailModified" placeholder="Enter your new email" value="<?= $employee->getEmail() ?>" required /><br>
						<label>First name : </label><input type="text" name="firstName" placeholder="Enter your new first name" value="<?= $employee->getFirstName() ?>" required /><br>
						<label>Last name : </label><input type="text" name="lastName" placeholder="Enter your new last name" value="<?= $employee->getLastName() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($employees) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
