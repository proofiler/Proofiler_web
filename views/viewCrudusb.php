<?php $this->_title = 'CRUD USBs'; ?>

<section>
	<fieldset>
		<legend>CRUD USBs</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create USBs</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>UUID : </label><input type="text" name="uuid" placeholder="Enter your new UUID" required /><br>
				<label>Brand : </label><input type="text" name="brand" placeholder="Enter your new brand" required /><br>
				<label>Employee's email : </label><input type="email" name="emailEmployee" placeholder="Enter the employee's email" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete USBs</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($usbs as $usb): ?>
					<form action="" method="POST">
						<input type="hidden" name="uuidNotModified" value="<?= $usb->getUuid() ?>">
						<label>UUID : </label><input type="text" name="uuidModified" placeholder="Enter your new uuid" value="<?= $usb->getUuid() ?>" required /><br>
						<label>Brand : </label><input type="text" name="brand" placeholder="Enter your new brand" value="<?= $usb->getBrand() ?>" required /><br>
						<label>Registration : </label><input type="text" name="registration" placeholder="Enter your new registration" value="<?= $usb->getRegistration() ?>" required /><br>
						<label>Employee's email : </label><input type="text" name="emailEmployee" placeholder="Enter your new employee's email" value="<?= $usb->getEmailEmployee() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($usbs) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
