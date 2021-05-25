<?php $this->_title = 'Sign in'; ?>

<section>
	<div class="row justify-content-lg-center justify-content-md-center">
		<div class="col-lg-6 col-md-6 bg-light py-5 border">
			<form action="" method="POST">
				<div class="row justify-content-lg-center justify-content-md-center text-center">
					<div class="col-lg-8 col-md-8">
						<?php echo($errorMessage ? '<br>'.$errorMessage.'<br><br>' : ''); ?>
						<div class="form-group">
							<label>Email : </label>
							<input class="form-control" type="email" name="email" placeholder="Enter your email" required />
						</div>
						<div class="form-group">
							<label>Password : </label>
							<input class="form-control" type="password" name="password" placeholder="Enter your password" required />
						</div>
					</div>
				</div>
				<div class="row justify-content-lg-center justify-content-md-center mt-5">
					<div class="col-lg-4 col-md-4">
						<button class="btn btn-block btn-success" type="submit" name="signin">Sign in</button>
					</div>
					<div class="col-lg-4 col-md-4">
						<button class="btn btn-block btn-secondary" type="reset">Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
