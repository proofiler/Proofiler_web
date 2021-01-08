<?php $this->_title = 'CRUD Extensions'; ?>

<section>
	<fieldset>
		<legend>CRUD Extensions</legend>
		<form action="" method="POST">
			<fieldset>
				<legend>Create Extensions</legend>
				<?php echo($errorMessageCreate ? '<br>'.$errorMessageCreate.'<br><br>' : ''); ?>
				<?php echo($informationMessageCreate ? '<br>'.$informationMessageCreate.'<br><br>' : ''); ?>
				<label>Name : </label><input type="text" name="name" placeholder="Enter a name" required /><br>
				<button type="submit" name="add">Add</button>
			</fieldset>
		</form>
			<fieldset>
				<legend>Update/Delete Extensions</legend>
				<?php echo($errorMessageOthers ? '<br>'.$errorMessageOthers.'<br><br>' : ''); ?>
				<?php echo($informationMessageOthers ? '<br>'.$informationMessageOthers.'<br><br>' : ''); ?>
				<?php $i = 0; ?>
				<?php foreach ($extensions as $extension): ?>
					<form action="" method="POST">
						<input type="hidden" name="id" value="<?= $extension->getName() ?>">
						<label>Name : </label><input type="name" name="name" placeholder="Enter a new name" value="<?= $extension->getName() ?>" required /><br>
						<button type="submit" name="update">Update</button><button type="submit" name="delete">Delete</button><button type="reset">Reset</button>
						<?php 
							if ($i != count($extensions) - 1) {
								echo '<br><br>';
								$i++;
							}
						?>
					</form>
				<?php endforeach; ?>
			</fieldset>
		</fieldset>
</section>
