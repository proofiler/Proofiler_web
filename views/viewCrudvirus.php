<?php $this->_title = 'CRUD viruses'; ?>

<section>
	<fieldset>
		<legend>CRUD viruses</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create viruses</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>Name : </label><input type="text" name="name" placeholder="Enter your new name" required /><br>
				<label>Hash : </label><input type="text" name="hash" placeholder="Enter your new hash" required /><br>
				<label>Scan's ID : </label><input type="number" name="idScan" placeholder="Enter the scan's ID" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete viruses</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($viruses as $virus): ?>
					<form action="" method="POST">
						<input type="hidden" name="idNotModified" value="<?= $virus->getId() ?>">
						<label>ID : </label><input type="number" name="idModified" placeholder="Enter your new ID" value="<?= $virus->getId() ?>" required /><br>
						<label>Name : </label><input type="text" name="name" placeholder="Enter your new name" value="<?= $virus->getName() ?>" required /><br>
						<label>Hash : </label><input type="text" name="hash" placeholder="Enter your new hash" value="<?= $virus->getHash() ?>" required /><br>
						<label>Scan's ID : </label><input type="text" name="idScan" placeholder="Enter your new scan's ID" value="<?= $virus->getIdScan() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($viruses) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>	
		</fieldset>
</section>
