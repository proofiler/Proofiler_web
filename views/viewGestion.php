<?php $this->_title = 'Gestion'; ?>

<section>
	<h3>Dashboarding</h3>
	<h3>Configuration</h3>
	<?php
		if ($informationMessage) {
			echo $informationMessage;
		}
	?>
	<form action="" method="POST">
		<button type="submit" name="viruses">Send viruses report email</button><button type="submit" name="configuration">Send configuration data to Raspberry</button>
	</form>
</section>
