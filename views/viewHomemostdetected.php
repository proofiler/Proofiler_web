
<?php $this->_title = 'mostdetected'; ?>

<section>
	<fieldset>
		<legend>Most detected viruses</legend>
		<fieldset>
			<?php $i = 1; ?>
			<?php foreach ($viruses as $virus): ?>
			<label>ID</label><input type="id" name="id" value=<?= $i ?>><br>
			<label>Name</label><input type="viruses" name="namevirus" value=<?= $virus['name'] ?>><br>
			<?php $i++; ?>
			<?php endforeach; ?>
		</fieldset>
	</fieldset>
</section>