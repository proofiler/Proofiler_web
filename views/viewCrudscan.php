<?php $this->_title = 'CRUD Scans'; ?>

<section>
	<fieldset>
		<legend>CRUD Scans</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create Scans</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>Duration : </label><input type="number" name="duration" placeholder="Enter your new duration" required /><br>
				<label>Number of files : </label><input type="number" name="nbFiles" placeholder="Enter your new number of files" required /><br>
				<label>Number of virus : </label><input type="number" name="nbVirus" placeholder="Enter your new number of virus" required /><br>
				<label>Number of errors : </label><input type="number" name="nbErrors" placeholder="Enter your new number of errors" required /><br>
				<label>USB's UUID : </label><input type="text" name="uuidUsb" placeholder="Enter the USB's UUID" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete Scans</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($scans as $scan): ?>
					<form action="" method="POST">
						<input type="hidden" name="idNotModified" value="<?= $scan->getId() ?>">
						<label>ID : </label><input type="number" name="idModified" placeholder="Enter your new ID" value="<?= $scan->getId() ?>" required /><br>
						<label>Date scan : </label><input type="text" name="dateScan" placeholder="Enter your new date scan" value="<?= $scan->getDatescan() ?>" required /><br>
						<label>Duration : </label><input type="number" name="duration" placeholder="Enter your new duration" value="<?= $scan->getDuration() ?>" required /><br>
						<label>Number of files : </label><input type="number" name="nbFiles" placeholder="Enter your new number of files" value="<?= $scan->getNbfiles() ?>" required /><br>
						<label>Number of virus : </label><input type="number" name="nbVirus" placeholder="Enter your new number of virus" value="<?= $scan->getNbvirus() ?>" required /><br>
						<label>Number of errors : </label><input type="number" name="nbErrors" placeholder="Enter your new number of errors" value="<?= $scan->getNberros() ?>" required /><br>
						<label>USB's UUID : </label><input type="text" name="uuidUsb" placeholder="Enter the USB's UUID" value="<?= $scan->getUuidUsb() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($scans) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
