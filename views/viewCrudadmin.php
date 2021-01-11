<?php $this->_title = 'CRUD Admins'; ?>

<section>
	<fieldset>
		<legend>CRUD Admins</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create Admins</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>Email : </label><input type="email" name="email" placeholder="Enter your email" required /><br>
				<label>Password : </label><input type="password" name="password" placeholder="Enter your password" required /><br>
				<label>Confirm password : </label><input type="password" name="confirmPassword" placeholder="Confirm your password" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete Admins</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($admins as $admin): ?>
					<form action="" method="POST">
						<input type="hidden" name="emailNotModified" value="<?= $admin->getEmail() ?>">
						<label>Email : </label><input type="email" name="emailModified" placeholder="Enter your new email" value="<?= $admin->getEmail() ?>" required /><br>
						<label>Old password : </label><input type="password" name="oldPassword" placeholder="Enter your old password" /><br>
						<label>New password : </label><input type="password" name="newPassword" placeholder="Enter your new password" /><br>
						<label>Confirm password : </label><input type="password" name="confirmPassword" placeholder="Confirm your password" /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($admins) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
