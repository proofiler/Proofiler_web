<?php $this->_title = 'Sign in'; ?>

<section>
	<form action="" method="POST">
		<fieldset>
			<legend>Log in</legend>
			<?php echo($errorMessage ? '<br>'.$errorMessage.'<br><br>' : ''); ?>
			<label>Email : </label><input type="email" name="email" placeholder="Enter your email" required /><br>
			<label>Password : </label><input type="password" name="password" placeholder="Enter your password" required /><br><br>
			<button type="submit" name="signin">Sign in</button><button type="reset">Reset</button>
		</fieldset>
	</form>
</section>
