<?php $this->_title = 'CRUD stations'; ?>

<section>
	<fieldset>
		<legend>CRUD station</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create stations</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>IP : </label><input type="text" name="ip" placeholder="Enter your new IP" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete stations</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($stations as $station): ?>
					<form action="" method="POST">
						<input type="hidden" name="ipNotModified" value="<?= $station->getIp() ?>">
						<label>IP : </label><input type="text" name="ipModified" placeholder="Enter your new IP" value="<?= $station->getIp() ?>" required /><br>
						<label>Hash : </label><input type="text" name="hash" placeholder="Enter your new hash" value="<?= $station->getHash() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($stations) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
