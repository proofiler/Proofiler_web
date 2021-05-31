
<?php $this->_title = 'TOP 10 VIRUSES'; ?>

<section>
	<legend>TOP 10 viruses</legend>
	<?php $i = 1; ?>
	<?php foreach ($viruses as $virus): ?>
		<label>Position</label><input type="test" value=<?= $i ?>><br>
		<label>Virus name</label><input type="test" value=<?= $virus['name'] ?>><br>
		<?php $i++; ?>
	<?php endforeach; ?>
</section>
